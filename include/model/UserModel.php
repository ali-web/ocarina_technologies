<?php
session_start();

class UserModel extends ST_Model {
    
    private $error;
    private $errorMessage;
    
    public function __construct() {
        parent::__construct();
        
        $this->error = false;
        $this->errorMessage = "";
    }
    
    function getError() {
        return $this->error;
    }
    
    function getErrorMessage() {
        return $this->errorMessage;
    }
    
    function clearError() {
        $this->error = false;
        $this->errorMessage = "";
    }
    
    private function _loginOrRegisterUser($fbId, $accessToken) {
        
        $users = $this->db->rawQuery("SELECT * FROM `user` WHERE `user`.`fb_id` = ? LIMIT 1", array($fbId));
        
        if (empty($users)) {
            $result = $this->db->rawQuery("INSERT INTO `user` (`fb_id`, `access_token`) VALUES (?, ?)", array($fbId, $accessToken));
            $users = $this->db->rawQuery("SELECT * FROM `user` WHERE `user`.`fb_id` = ? LIMIT 1", array($fbId));
        } else {
            if ($accessToken != $users[0]['access_token']) {
               $this->db->rawQuery("UPDATE `user` SET `access_token`=? WHERE `fb_id`=?", array($accessToken, $fbId));
            }
        }
        
        $_SESSION['user_id'] = $users[0]['id'];
        
        $this->_ensureUserDetails($users[0]);
        return $users[0];
    }
    
    private function _ensureUserDetails($user) {
        if ($user['name'] == null) {
            $responseJson = Http::getRequest('https://graph.facebook.com/v2.5/me', array(
                        'access_token' => $user['access_token']
                    ));
                    
            $response = json_decode($responseJson);
            if ($response->error) {
                $this->error = true;
                $this->errorMessage = "Unable to get user name for user id: " . $user['id'] . " . Facebook returned: " . $response->error->message;
                return false;
            }
            
            $user['name'] = $response->name;
            $this->db->rawQuery("UPDATE `user` SET `name`=? WHERE `id`=?", array($response->name, $user['id']));
        }
        
        return true;
    }
    
    private function _getUser($id) {
        $users = $this->db->rawQuery("SELECT * FROM `user` WHERE `user`.`id` = ? LIMIT 1", array($id));
        
        if (!$users || empty($users)) {
            return null;
        }
        
        return $users[0];
    }
    
    private function _getUserExists($id) {
        return !!$this->_getUser($id);
    }
    
    function getLoggedInUser() {
        $userId = $_SESSION['user_id'];
        
        if ($userId) {
            $user = $this->_getUser($userId);
            if (!$user) {
                return null;
            }
            
            return $user;
        } else {
            return null;
        }
    }
   
    function loginOrRegisterUserByCode($code) {
        $code = g('code');
        
        $responseJson = Http::getRequest('https://graph.facebook.com/v2.5/oauth/access_token', array(
                   'client_id'      => ST_FB_CLIENT_ID,
                   'redirect_uri'   => ST_AUTH_REDIRECT_URI,
                   'client_secret'  => ST_FB_SECRET_ID,
                   'code'           => $code
                ));
        
        $response = json_decode($responseJson);
        if ($response->error) {
            $this->error = true;
            $this->errorMessage = "Unable to exchange code for access token with facebook. Facebook gave: " . $response->error->message;
            return false;
        }
        
        $accessToken = $response->access_token;
        
        $responseJson = Http::getRequest('https://graph.facebook.com/v2.5/debug_token', array(
                    'input_token'   => $accessToken,
                    'access_token'  => ST_FB_CLIENT_ID . "|" . ST_FB_SECRET_ID
                ));
        
        $response = json_decode($responseJson);
        if ($response->error) {
            $this->error = true;
            $this->errorMessage = "Unable to check access token state for user. Facebook gave: " . $response->error->message;
            return false;
        }
        
        $user = $this->_loginOrRegisterUser($response->data->user_id, $accessToken);
        
        return $user;
    }
    
}

?>