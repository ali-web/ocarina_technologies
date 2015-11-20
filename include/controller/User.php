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
        
        $responseJson = Http::getRequest('https://graph.facebook.com/v2.3/oauth/access_token', array(
                   'client_id'      => ST_FB_CLIENT_ID,
                   'redirect_uri'   => ST_AUTH_REDIRECT_URI,
                   'client_secret'  => ST_FB_SECRET_ID,
                   'code'           => $code
                ));
        
        $response = json_decode($responseJson);
        if ($response->error) {
            Http::redirect("/User/loginError");
        }
        
        $accessToken = $response->access_token;
        
        $responseJson = Http::getRequest('https://graph.facebook.com/v2.3/debug_token', array(
                    'input_token'   => $accessToken,
                    'access_token'  => ST_FB_CLIENT_ID . "|" . ST_FB_SECRET_ID
                ));
        
        $response = json_decode($responseJson);
        if ($response->error) {
            Http::redirect("/User/loginError");
        }
        
        
        
        require_once ST_MODEL_DIR . 'UserModel.php';
        (new UserModel())->loginOrRegisterUser($response->data->user_id, $accessToken);
        
        Http::redirect('/');
    }
    
    function debug() {
        die("THe user id is " . $_SESSION['user_id']);
    }
    
}

?>