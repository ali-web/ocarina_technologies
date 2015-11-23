<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 15-10-30
 * Time: 8:10 AM
 */

class Main extends ST_Controller{
    
    function index() {
        require_once ST_MODEL_DIR . "UserModel.php";
        $user = (new UserModel())->getLoggedInUser();
        $stories = $this->db->rawQuery("SELECT * FROM story 
                                        INNER JOIN 
                                            story_user ON story.id=story_user.FK_story_id
                                        WHERE 
                                            ended_at IS NULL
                                            AND story_user.FK_user_id = ?
                                       ", array($user['id']));
        
        
        load_view('Home', array('stories' => $stories, 'user' => $user));
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
            'started_at' => $this->db->now()
        );
        $id = $this->db->insert('story', $story);
        

        if (!$id){
            echo $this->db->getLastError();
        } else {
            $storyuser = array(
                'FK_user_id' => $user['id'],
                'FK_story_id' => $id
            );
            
            $storyuserid = $this->db->insert('story_user', $storyuser);
            
            Http::redirect('/Main/story/' . $uri);
            Http::redirect('/Main/CreateStory');
        }
    }

    function createStory() {
        $title = StoryTime::titleGenerator();
        $uri = StoryTime::URIGenerator();
        $title_array = array(
            'uri' => $uri,
            'title' => $title);
        load_view('CreateStory', $title_array);
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
        //just created a story...put in it's uri into the database & num of turns for that game
        if(isset($_POST["create_story"]) && isset($_POST["numturns"]) && isset($_POST["game_uri"]) && isset($_POST["game_title"])) {
            $max_turns = $_POST["numturns"];
            $game_uri =  $_POST["game_uri"];
            $started_at = $this->db->now();
            $title = $_POST["game_title"];
            $body = "";
            $this->db->insert('story', array("max_turns"=>$max_turns, "uri"=>$game_uri, "started_at"=>$started_at, "title"=>$title, "body"=>$body));
        }
        
        $game_info = $this->db->rawQuery('SELECT title,body FROM story WHERE uri = ?', array($uri));
        load_view('GamePlay', $game_info[0]);
    }
    
    function waitTurn() {
        load_view('WaitTurn');
    }
    
    function completedStories() {
        load_view('CompletedStories');
    }
    
    /*
    function story($uri)
    {
        $phrase = g('phrase');

        if ($phrase){
            $phrase = " " . $phrase;
            $this->db->rawQuery("UPDATE story SET body = CONCAT(body, ?) WHERE uri = ?", array($phrase, $uri));
        }

        $story = DBUtil::getOne($this->db->rawQuery('SELECT title,body,started_at FROM story WHERE uri = ?', array($uri)));

        if (!$story){
            Http::notFound();
        } else {
            load_template('header', array('title' => 'New Story'));
            load_view('new_story', $story);
            load_template('footer');
        }
    }
    */
}