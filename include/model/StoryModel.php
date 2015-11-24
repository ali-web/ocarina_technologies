<?php
class UserModel extends ST_Model {
    
    function moveForwardStories() {
        
        $stories = $this->db->rawQuery("
    SELECT
        t.`id`,
        FLOOR(TIMESTAMPDIFF(SECOND, turn_start, NOW()) / 1000) AS turns_over,
        t.`current_turn` AS current_turn,
        t.`max_turns` AS max_turns
    FROM
        (SELECT 
            `story`.`id` AS id,
            (CASE
                WHEN `story`.`current_turn` > 0 THEN
                    (SELECT MAX(`turn`.`timestamp`) FROM `turn` WHERE `turn`.`FK_story_id` = `story`.`id`)
                ELSE
                    `story`.`started_at`
            END) AS turn_start,
            `story`.`time_limit` as time_limit,
            `story`.`current_turn` as current_turn,
            `story`.`max_turns` as max_turns
        FROM 
            `story`) AS t
    WHERE
        TIMESTAMPDIFF(SECOND, turn_start, NOW()) >= t.`time_limit`
                            ", array());
                            
        for ($i = 0; $i < count($stories); $i++) {
            $story = $stories[i];
            
            $turn = $story['current_turn'];
            $turnsOver = $story['turns_over'];
            $maxTurns = $story['max_turns'];
            
            $setFinished = $turn + $turnsOver >= $maxTurns;
            
            while ($turnOver > 0 && $turn < $maxTurns) {
                $this->db->rawQuery("
                                    INSERT INTO `turn` 
                                        (FK_story_id, FK_user_id, words, timestamp) 
                                    VALUES 
                                        (?,           0,          '',    NOW())
                                    ", array($story['id']));
                $turnOver--;
                $turn++;
            }
            
            if ($setfinished) {
                $this->db->rawQuery("UPDATE `story` SET current_turn = ?, finished_at = NOW()", array($turn));
            } else {
                $this->db->rawQuery("UPDATE `story` SET current_turn = ?", array($turn));
            }
            
        }
        
    }
    
}
?>