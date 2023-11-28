<?php

require_once "init.php";

if (
    isset($_GET['user_id']) &&
    !empty($_GET['user_id'])
) {

    $user_id = htmlspecialchars($_GET['user_id']);

    $user_table = USER_TABLE;
    $user_movie_relation_table = USER_MOVIE_RELATION_TABLE;
    $movie_table = MOVIE_TABLE;
    $user_recommmendation_form_logs_table = USER_RECOMMENDATION_FORM_LOGS_TABLE;
    $user_recommendation_history_table = USER_RECOMMENDATION_HISTORY_TABLE;

    /*
    $sql = "SELECT u.*,relation.*,m.*,form_logs.* from $user_table  AS u
    LEFT JOIN $user_movie_relation_table AS relation 
    ON u.id = relation.user_id
    LEFT JOIN $movie_table AS m
    ON m.id = relation.movie_id
    LEFT JOIN $user_recommmendation_form_logs_table AS form_logs
    ON u.id = form_logs.user_id
    LEFT JOIN $user_recommendation_history_table AS reco_history
    ON form_logs.id = reco_history.form_log_id	
    WHERE u.id = $user_id
    ";
*/

    $sql = "SELECT u.* from $user_table  AS u
            WHERE u.id = $user_id
        ";


    $query = $db->prepare($sql);

    $query->execute();
    $result = $query->fetchAll();

    echo json_encode(array(
        'success' => true,
        'userAllInfos' => $result
    ));
} else {
    echo json_encode(array(
        'success' => false,
    ));
}
