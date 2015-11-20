<?php
session_start();

class UserModel extends ST_Model {
    
    function loginOrRegisterUser($fbId, $accessToken) {
        
        $user = $this->db->rawQuery("SELECT `id`, `access_token` FROM `user` WHERE `user`.`fb_id` = ? LIMIT 1", array($fbId));
        
        if (empty($user)) {
            $result = $this->db->rawQuery("INSERT INTO `user` (`fb_id`, `access_token`) VALUES (?, ?)", array($fbId, $accessToken));
            $user = $this->db->rawQuery("SELECT `id`, `access_token` FROM `user` WHERE `user`.`fb_id` = ? LIMIT 1", array($fbId));
        } else {
            if ($accessToken != $user['access_token']) {
               $this->db->rawQuery("UPDATE `user` SET `access_token`=? WHERE `fb_id`=?", array($accessToken, $fbId));
            }
        }
        
        echo "We have setup the session variable";
        $_SESSION['user_id'] = $user[0]['id'];
        
        return $user;
    }
    
    
}

?>