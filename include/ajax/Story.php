<?php

function storyInfo() {
    $uri = g('uri');
    $userId = g('userId');
    
    st_db_object()->rawQuery("CALL MOVESTORIESFORWARD()");
    
    $db_data = st_db_object()->rawQuery("
                            SELECT 
                                (SELECT COUNT(*) FROM `story_user` WHERE `story_user`.`FK_story_id` = `story`.`id`) AS num_players,
                                `story`.`time_limit` AS time_limit,
                                (CASE
                                    WHEN `story`.`current_turn` > 0 THEN
                                        (SELECT MAX(`turn`.`timestamp`) FROM `turn` WHERE `turn`.`FK_story_id` = `story`.`id`)
                                    ELSE
                                        `story`.`started_at`
                                END) AS turn_start,
                                NOW() AS now_time,
                                `story`.`current_turn` AS current_turn,
                                (SELECT `story_user`.`turn_order` FROM `story_user` WHERE `story_user`.`FK_user_id` = ? AND `story_user`.`FK_story_id` = `story`.`id` LIMIT 1) AS turn_order
                            FROM 
                                `story`  
                            WHERE 
                                `story`.`uri` = ?
                                ", array($userId, $uri));
    
    
    echo json_encode($db_data[0]);
    
}

?>