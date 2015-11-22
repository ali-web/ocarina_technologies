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
}