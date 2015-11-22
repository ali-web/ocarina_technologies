<?php

class User extends ST_Controller {
    
    function index() {
        Http::redirect("https://www.facebook.com/dialog/oauth?client_id=" . ST_FB_CLIENT_ID ."&redirect_uri=" . ST_AUTH_REDIRECT_URI);
    }
    
    function loginError() {
        load_template('header', array('title' => 'Login Error'));
        load_view('user/login_error');
        load_template('footer');
    }
    
    function auth() {
        $code = g('code');
        
        require_once ST_MODEL_DIR . 'UserModel.php';
        $userModel = new UserModel();
        $user = $userModel->loginOrRegisterUserByCode($code);
        
        if ($userModel->getError()) {
            die($userModel->getErrorMessage());
        }
        
        if ($user) {
            Http::redirect('/');
        } else {
            Http::redirect('loginError');
        }
    }
    
    function debug() {
        die("The user id is " . $_SESSION['user_id']);
    }
    
    function logout() {
        session_unset();
        Http::redirect('/');
    }
    
}

?>