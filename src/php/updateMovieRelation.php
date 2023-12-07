<?php

require_once "init.php";

// Récupération des données POST en JSON
$rawData = file_get_contents("php://input");

// Tentative de décodage des données JSON
$formData = json_decode($rawData, true);

// Vérification des données requises
if (
    isset($formData['user_id']) && !empty($formData['user_id']) &&
    isset($formData['innerMovieId']) && !empty($formData['innerMovieId']) &&
    isset($formData['addedFavorites'])
) {
    //  1- verifier si l'addociation existe
    $relation_table = USER_MOVIE_RELATION_TABLE;

    // Recherche du film dans la base de données par son ID API
    $find_relation_query = "SELECT * FROM $relation_table WHERE user_id = :user_id AND movie_id = :movie_id";
    $find_relation_statement = $db->prepare($find_relation_query);
    $find_relation_statement->bindParam(':user_id', $formData['user_id']);
    $find_relation_statement->bindParam(':movie_id', $formData['innerMovieId']);
    $find_relation_statement->execute();

    $currentTimestamp = date('Y-m-d H:i:s'); // Get the current timestamp in MySQL format

    if ($find_relation_statement->rowCount() == 0) {
        // - Creer la relation + MAJ etat favoris
        $add_relation_query = "INSERT INTO $relation_table (user_id, movie_id, favourite, favourite_timestamp) VALUES (:user_id, :movie_id, :favourite, :timestamp)";
        $add_relation_statement = $db->prepare($add_relation_query);
        $add_relation_statement->bindParam(':user_id', $formData['user_id']);
        $add_relation_statement->bindParam(':movie_id', $formData['innerMovieId']);
        $add_relation_statement->bindParam(':favourite', $formData['addedFavorites']);
        $add_relation_statement->bindParam(':timestamp', $currentTimestamp);
        $add_relation_statement->execute();

        echo json_encode(array(
            'success' => true,
            'message' => "Relation créée avec succès"
        ));
    } else {
        // SINON MAJ etat et timestamp
        $update_relation_query = "UPDATE $relation_table SET favourite = :favourite, favourite_timestamp = :timestamp WHERE user_id = :user_id AND movie_id = :movie_id";
        $update_relation_statement = $db->prepare($update_relation_query);
        $update_relation_statement->bindParam(':user_id', $formData['user_id']);
        $update_relation_statement->bindParam(':movie_id', $formData['innerMovieId']);
        $update_relation_statement->bindParam(':favourite', $formData['addedFavorites']);
        $update_relation_statement->bindParam(':timestamp', $currentTimestamp);
        $update_relation_statement->execute();

        echo json_encode(array(
            'success' => true,
            'message' => "État favori mis à jour avec succès"
        ));
    }
} else {
    echo json_encode(array(
        'success' => false,
        'message' => "Données manquantes"
    ));
}
