<?php

require_once "init.php";

// Récupération des données POST en JSON
$rawData = file_get_contents("php://input");

// Tentative de décodage des données JSON
$formData = json_decode($rawData, true);


// Vérification des données requises
if (
    isset($formData['form_log_id']) && !empty($formData['form_log_id']) &&
    isset($formData['movie_id']) && !empty($formData['movie_id'])
) {



    // Nom de la table des films
    $movie_table = MOVIE_TABLE;

    // Recherche du film dans la base de données par son ID API
    $find_movie_query = "SELECT * FROM $movie_table WHERE id_API = :id_API";
    $find_movie_statement = $db->prepare($find_movie_query);
    $find_movie_statement->bindParam(':id_API', $formData['movie_id']);
    $find_movie_statement->execute();

    // Check if the movie is found
    if ($find_movie_statement->rowCount() == 0) {

        // If the movie is not found, add it to the database
        $insert_movie_query = "INSERT INTO $movie_table ( movie_is_from_API,id_API) VALUES ( 1,:id_API)";
        $insert_movie_statement = $db->prepare($insert_movie_query);
        $insert_movie_statement->bindParam(':id_API', $formData['movie_id']);
        $insert_movie_statement->execute();

        // Retrieve the ID of the last inserted record
        $movie_inserted_id = $db->lastInsertId();

        // Set $movie_id to the inserted ID
        $movie_id = $movie_inserted_id;
    } else {
        // If the movie is found, fetch its ID
        $movie_data = $find_movie_statement->fetch(PDO::FETCH_ASSOC);
        $movie_id = $movie_data['id'];
    }
    /*
    echo json_encode(array(
        'success' => true,
        'message' => "Film ajouté avec succès",
        '$movie_id' => $movie_id
    ));
    */


    // verifier si le form existe
    $form_log_table = USER_RECOMMENDATION_FORM_LOGS_TABLE;

    $find_form_log_query = "SELECT id FROM $form_log_table WHERE id = :id";

    $find_form_log_statement = $db->prepare($find_form_log_query);
    $find_form_log_statement->bindParam(':id', $formData['form_log_id']);
    $find_form_log_statement->execute();

    // si le log est trouvé 
    if ($find_form_log_statement->rowCount() > 0) {

        $movie_history_table = USER_RECOMMENDATION_HISTORY_TABLE;

        // requete d'insertion 
        $insert_sql = "INSERT INTO $movie_history_table (form_log_id, movie_id) VALUES (:form_log_id, :movie_id)";

        $stmt = $db->prepare($insert_sql);
        $stmt->bindParam(':form_log_id', $formData['form_log_id']);
        $stmt->bindParam(':movie_id', $movie_id); // Replace with actual value

        if ($stmt->execute()) {
            echo json_encode(array(
                'success' => true,
                'message' => "Film ajouté avec succès",
                "movieId" => $movie_id
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'message' => "Échec de l'ajout du film"
            ));
        }
    }
} else {
    echo json_encode(array(
        'success' => false,
        'message' => "Données manquantes"
    ));
}
