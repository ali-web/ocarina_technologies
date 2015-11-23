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
        
        
        $stories = $this->db->rawQuery("SELECT * FROM story 
                                        INNER JOIN 
                                            story_user ON story.id=story_user.FK_story_id
                                        WHERE 
                                            ended_at IS NULL
                                            AND story_user.FK_user_id = ?
                                            AND story_user.turn_order = story.current_turn % 
                                                                        (SELECT COUNT(*) FROM story_user WHERE story_user.FK_story_id = story.id)
                                       ", array($user['id']));
        
        load_template('header', array('user' => $user, 'title' => 'StoryTime With Friends'));
        load_view('Home', array('stories' => $stories));
        load_template('footer');
    }

    function new_story()
    {
        $title = StoryTime::titleGenerator();
        $uri = StoryTime::URIGenerator();
        
        require_once ST_MODEL_DIR . "UserModel.php";
        $user = (new UserModel())->getLoggedInuser();
        if (!$user) {
            Http::redirect('/User/index');
        }

        $story = array(
            'uri' => $uri,
            'title' => $title,
            'body'=> '',
            'max_turns' => 15,
            'time_limit' => 1000,
            'started_at' => $this->db->now()
        );
        $storyId = $this->db->insert('story', $story);
        

        if (!$storyId){
            echo $this->db->getLastError();
        } else {
            $users = $this->db->rawQuery('SELECT * FROM user');
            $userIds = array();
            for ($i = 0; $i < count($users); $i++) {
                $userIds[$i] = $users[$i]['id'];
            }
            shuffle($userIds);
            for ($i = 0; $i < count($users); $i++) {
                $storyuser = array(
                    'FK_user_id' => $userIds[$i],
                    'FK_story_id' => $storyId,
                    'turn_order' => $i
                );
                l(print_r($storyuser, true), '\n');
                $storyuserid = $this->db->insert('story_user', $storyuser);
            }
            
            
            
            Http::redirect('/Main/story/' . $uri);
            Http::redirect('/Main/CreateStory');
        }
    }
    
    function createStory() {
        //include '../view/CreateStory.php';
        load_view('CreateStory');
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
    
    function gamePlay($uri) {
        $uri_array = array("uri" => $uri);
        load_view('GamePlay', $uri_array);
    }
    
    function waitTurn() {
        load_view('WaitTurn');
    }
    
    function completedStories() {
        load_view('CompletedStories');
    }
    
    function story($uri)
    {
        $phrase = g('phrase'); 
        $user = (new UserModel())->getLoggedInUser();
        
        l("Running the SQL query \n");
        $story = DBUtil::getOne($this->db->rawQuery('   
                            SELECT 
                                * 
                            FROM 
                                `story`  
                            INNER JOIN `story_user`
                                ON `story_user`.`FK_story_id` = `story`.`id`
                            WHERE 
                                `story`.`uri` = ?
                                AND `story_user`.`FK_user_id` = ?
                                AND `story_user`.`turn_order` = `story`.`current_turn` % 
                                                        (SELECT COUNT(*) FROM `story_user` WHERE `story_user`.`FK_story_id` = `story`.`id`)
                    ', array($uri, $user['id'])));
        
        l(print_r($story, true) . " for story($uri)\n");
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
            if ($story['current_turn'] === $story['max_turs'] - 1) {
                $this->db->rawQuery("UPDATE story SET body = CONCAT(body, ?), current_turn = current_turn + 1, ended_at = ? WHERE uri = ?", array($phrase, $this->db->now(), $uri));
            } else {
                $this->db->rawQuery("UPDATE story SET body = CONCAT(body, ?), current_turn = current_turn + 1 WHERE uri = ?", array($phrase, $uri));
            }
        }


        load_template('header', array('title' => 'New Story', 'user' => $user));
        load_view('new_story', $story);
        load_template('footer');
    }
}