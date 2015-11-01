<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 15-10-30
 * Time: 8:10 AM
 */

class Main extends ST_Controller{

    function index(){
        $stories = $this->db->rawQuery("SELECT * FROM story WHERE ended_at is null");

        load_template('header', array('title' => 'home'));
        load_view('home', array('stories' => $stories));
        load_template('footer');
    }

    function new_story()
    {
        $title = StoryTime::titleGenerator();
        $uri = StoryTime::URIGenerator();

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
            Http::redirect('/Main/story/' . $uri);
        }
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