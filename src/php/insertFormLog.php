<?php

session_start();


require_once "init.php";

// Récupération des données POST en JSON
$rawData = file_get_contents("php://input");

// Tentative de décodage des données JSON
$formData = json_decode($rawData, true);

// Vérification de la présence des données nécessaires
if (
    isset($formData['user_id']) && !empty($formData['user_id']) &&
    isset($formData['user_humor']) && !empty($formData['user_humor']) &&
    isset($formData['user_location_lat']) && !empty($formData['user_location_lat']) &&
    isset($formData['user_location_long']) && !empty($formData['user_location_long']) &&
    isset($formData['user_location_weather_label']) && !empty($formData['user_location_weather_label']) &&
    isset($formData['user_location_weather_temperature']) && !empty($formData['user_location_weather_temperature'])
) {
    // Récupération des données du formulaire
    $user_id = $formData['user_id'];
    $user_humor = $formData['user_humor'];
    $user_location_lat = $formData['user_location_lat'];
    $user_location_long = $formData['user_location_long'];
    $user_location_weather_label = $formData['user_location_weather_label'];
    $user_location_weather_temperature = $formData['user_location_weather_temperature'];

    // Utilisation d'une requête préparée pour éviter les failles de sécurité
    $table = USER_RECOMMENDATION_FORM_LOGS_TABLE;
    $sql = "INSERT INTO $table (user_id, user_humor, user_location_lat, user_location_long, user_location_weather_label, user_location_weather_temperature)
            VALUES (?, ?, ?, ?, ?, ?)";

    try {
        // Préparation de la requête
        $stmt = $db->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(1, $user_id);
        $stmt->bindParam(2, $user_humor);
        $stmt->bindParam(3, $user_location_lat);
        $stmt->bindParam(4, $user_location_long);
        $stmt->bindParam(5, $user_location_weather_label);
        $stmt->bindParam(6, $user_location_weather_temperature);

        // Exécution de la requête
        $stmt->execute();

        // Récupération de l'ID du tuple inséré
        $lastInsertedId = $db->lastInsertId();

        echo json_encode(array(
            'success' => true,
            'message' => "Insertion réussie",
            'inserted_id' => $lastInsertedId
        ));
    } catch (PDOException $e) {
        echo json_encode(array(
            'success' => false,
            'message' => $e->getMessage()
        ));
    }
} else {
    echo json_encode(array(
        'success' => false,
        'message' => "Données manquantes"
    ));
}
