<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 15-10-30
 * Time: 8:10 AM
 */

class Main extends ST_Controller{
    
    function index() {
        $user = (new UserModel())->getLoggedInUser();
        
        
        $yourTurnStories = $this->db->rawQuery("
                                        SELECT * FROM story 
                                        INNER JOIN 
                                            story_user ON story.id=story_user.FK_story_id
                                        WHERE 
                                            ended_at IS NULL
                                            AND story_user.FK_user_id = ?
                                            AND story_user.turn_order = story.current_turn % 
                                                                        (SELECT COUNT(*) FROM story_user WHERE story_user.FK_story_id = story.id)
                                       ", array($user['id']));
                                       
        $waitingTurnStories = $this->db->rawQuery("
                                        SELECT * FROM story 
                                        INNER JOIN 
                                            story_user ON story.id=story_user.FK_story_id
                                        WHERE 
                                            ended_at IS NULL
                                            AND story_user.FK_user_id = ?
                                            AND story_user.turn_order != story.current_turn % 
                                                                        (SELECT COUNT(*) FROM story_user WHERE story_user.FK_story_id = story.id)
                                        ", array($user['id']));
        
        $completedStories = $this->db->rawQuery("
                                        SELECT * FROM story 
                                        INNER JOIN 
                                            story_user ON story.id=story_user.FK_story_id
                                        WHERE 
                                            ended_at IS NOT NULL
                                            AND story_user.FK_user_id = ?
                                        ", array($user['id']));
        
        load_template('header', array('user' => $user, 'title' => 'StoryTime With Friends'));
        load_view('Home', array('yourTurnStories' => $yourTurnStories, 'waitingTurnStories' => $waitingTurnStories, 'completedStories' => $completedStories));
        load_template('footer');
    }

    function new_story()
    {
        $uri = $_POST["game_uri"];
        require_once ST_MODEL_DIR . "UserModel.php";
        $user = (new UserModel())->getLoggedInuser();

        if (!$user) {
            Http::redirect('/User/index');
        }

        $invited_friends = $_POST["myFriends"];
        
        $story = array(
            'uri' => $uri,
            'title' => $_POST["game_title"],
            'body'=> '',
            'max_turns' => $_POST["numturns"] * (count($invited_friends) + 1),
            'time_limit' => 1000,
            'started_at' => $this->db->now()
        );
        $storyId = $this->db->insert('story', $story);
        
        if (!$storyId){
            echo $this->db->getLastError();
        } else {
            //$users = $this->db->rawQuery('SELECT * FROM user');
            $userIds = array();
            foreach($invited_friends as $person) {
                $userId = $this->db->rawQuery('SELECT * FROM user WHERE name = ?', array($person));
                $userIds[] = $userId[0]['id'];
            }
            
            shuffle($userIds);
            array_unshift($userIds, $user['id']); //game creator gets first turn
            for ($i = 0; $i < count($userIds); $i++) {
                $storyuser = array(
                    'FK_user_id' => $userIds[$i],
                    'FK_story_id' => $storyId,
                    'turn_order' => $i
                );
                $storyuserid = $this->db->insert('story_user', $storyuser);
            }
            
            Http::redirect('/Main/gamePlay/' . $uri);
            //Http::redirect('/Main/CreateStory');
        }
    }

    function createStory() {
        $user = (new UserModel())->getLoggedInUser();
        if(!$user) {
            echo "not logged in";
        }
        
        $title = StoryTime::titleGenerator();
        $uri = StoryTime::URIGenerator();
        $title_array = array(
            'uri' => $uri,
            'title' => $title);
        load_template('header', array('user' => $user, 'title' => 'Create Story'));
        load_view('CreateStory', $title_array);
        load_template('footer');
    }
        
    function friends() {
        load_view('Friends');
    }
    
    function settings() {
        load_view('Settings');
    }
    
    function help() {
        load_view('Help');
    }
    
    function waitTurn($uri) {
        $user = (new UserModel())->getLoggedInUser();
        $stories = $this->db->rawQuery("SELECT * FROM `story` WHERE `story`.`uri` = ? LIMIT 1", array($uri));
        $story = $stories[0];
        
        load_template('header', array('title' => 'Waiting for Turn', 'user' => $user));
        load_view('WaitTurn', array('story' => $story));
        load_template('footer');
        
    }
    
    function completedStories($uri) {
        $user = (new UserModel())->getLoggedInUser();
        $stories = $this->db->rawQuery("SELECT * FROM `story` WHERE `story`.`uri` = ? LIMIT 1", array($uri));
        $story = $stories[0];
        
        load_template('header', array('title' => 'Waiting for Turn', 'user' => $user));
        load_view('CompletedStories', array('story' => $story));
        load_template('footer');
    }
    
    function gamePlay($uri)
    {
        l("Gameplay called\n");
        $phrase = g('words'); 
        $user = (new UserModel())->getLoggedInUser();
        
        $story = DBUtil::getOne($this->db->rawQuery('   
                            SELECT 
                                *,
                                `story`.`id` AS id
                            FROM 
                                `story`  
                            INNER JOIN `story_user` AS story_user
                                ON `story_user`.`FK_story_id` = `story`.`id`
                            WHERE 
                                `story`.`uri` = ?
                                AND `story_user`.`FK_user_id` = ?
                                AND `story_user`.`turn_order` = `story`.`current_turn` % 
                                                        (SELECT COUNT(*) FROM `story_user` WHERE `story_user`.`FK_story_id` = `story`.`id`)
                    ', array($uri, $user['id'])));
        
        if (!$story) {
            //Not this users turn.
            Http::redirect('/Main/index'); 
        }

        if ($phrase){
            
            $this->db->insert('turn', array(
                'FK_story_id' => $story['id'],
                'FK_user_id' => $user['id'],
                'words' => $phrase,
                'timestamp' => $this->db->now()
            ));
            
            $phrase = " " . $phrase;
            if ($story['current_turn'] === $story['max_turns'] - 1) {
                $this->db->rawQuery("UPDATE story SET body = CONCAT(body, ?), current_turn = current_turn + 1, ended_at = NOW() WHERE uri = ?", array($phrase, $uri));
            } else {
                $this->db->rawQuery("UPDATE story SET body = CONCAT(body, ?), current_turn = current_turn + 1 WHERE uri = ?", array($phrase, $uri));
            }
            
            Http::redirect('/Main/index');
            return;
        }


        load_template('header', array('title' => 'New Story', 'user' => $user));
        load_view('GamePlay', $story);
        load_template('footer');
    }
}

?>
