<?php

/**
 * Récuperer la liste des films en favoris pour un utilisateur donné
 * - jointure table de relation + user + movie
 */

require_once "init.php";

if (
    isset($_GET['user_id']) &&
    !empty($_GET['user_id'])
) {

    $user_id = htmlspecialchars($_GET['user_id']);
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : null; // Limite par défaut à null
    $orderByFavTimeDesc = isset($_GET['order_by_fav_time_desc']) && $_GET['order_by_fav_time_desc'] == 1 ? true : false; // Tri par ID décroissant par défaut à false

    $user_table = USER_TABLE;
    $user_movie_relation_table = USER_MOVIE_RELATION_TABLE;
    $movie_table = MOVIE_TABLE;

    $sql = "SELECT u.username, r.id AS relation_id, r.rating, r.favourite, r.rating_timestamp, m.* 
            FROM $user_table AS u
            LEFT JOIN $user_movie_relation_table AS r ON r.user_id = u.id 
            LEFT JOIN $movie_table AS m ON r.movie_id = m.id
            WHERE u.id = :user_id";

    // Ajout de la clause ORDER BY si le tri par ID décroissant est demandé
    if ($orderByFavTimeDesc) {
        $sql .= " ORDER BY r.favourite_timestamp DESC";
    }
    // Ajout de la clause LIMIT si la limite est spécifiée
    if (!is_null($limit)) {
        $sql .= " LIMIT :limit";
    }



    $query = $db->prepare($sql);
    $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    // Liaison du paramètre LIMIT s'il est spécifié
    if (!is_null($limit)) {
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
    }

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
