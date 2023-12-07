<?php

require_once "init.php";

if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {

    $user_id = htmlspecialchars($_GET['user_id']);

    $user_table = USER_TABLE;
    $user_movie_relation_table = USER_MOVIE_RELATION_TABLE;
    $movie_table = MOVIE_TABLE;
    $reco_history_table = USER_RECOMMENDATION_HISTORY_TABLE;
    $reco_form_log_table = USER_RECOMMENDATION_FORM_LOGS_TABLE;

    $limit = "";

    if (isset($_GET['limit']) && !empty($_GET['limit'])) {
        $limit = "LIMIT " . intval($_GET['limit']);
    }
    /*
    $sql = "SELECT m.movie_is_from_API, m.id_API, form_log.* from $reco_form_log_table AS form_log
        LEFT JOIN $reco_history_table AS reco_history
        ON form_log.id = reco_history.form_log_id 
        LEFT JOIN $movie_table AS m
        ON m.id = reco_history.movie_id
        WHERE form_log.user_id = $user_id
        ORDER BY form_log.form_submission_date DESC
        $limit";
*/
    $sql = "
SELECT 
    m.movie_is_from_API, 
    m.id_API, 
    form_log.*, 
    relation_table.favourite
FROM $reco_form_log_table AS form_log
LEFT JOIN $reco_history_table AS reco_history ON form_log.id = reco_history.form_log_id 
LEFT JOIN $movie_table AS m ON m.id = reco_history.movie_id
LEFT JOIN $user_movie_relation_table AS relation_table ON form_log.user_id = relation_table.user_id AND m.id = relation_table.movie_id
WHERE form_log.user_id = $user_id
ORDER BY form_log.form_submission_date DESC
$limit";

    $query = $db->prepare($sql);

    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(array(
        'success' => true,
        'result' => $result
    ));
} else {
    echo json_encode(array(
        'success' => false,
    ));
}
