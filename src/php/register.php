<?php

require_once "init.php";

/**
 * 
 * TODO : Inscription 
 *  - 1 : verifier les champs (user/pass) - regex + ! empty
 *  - 2 : verifier la "confirmation du mdp"
 *  - 3 : crupter le mdp
 *  - 4 : insertion dans la bdd
 * 
 * 
 */

if (
    isset($_POST['username']) &&
    !empty($_POST['username']) &&
    isset($_POST['password']) &&
    !empty($_POST['password']) &&
    isset($_POST['password_confirmation']) &&
    !empty($_POST['password_confirmation'])
) {

    $user = htmlspecialchars($_POST['username']);
    $pass = htmlspecialchars($_POST['password']);
    $pass_confirm = htmlspecialchars($_POST['password_confirmation']);

    $encrypt_pass = password_hash($pass, PASSWORD_BCRYPT);

    $table = USER_TABLE;

    if (mb_strlen($user) > 4) {

        if (mb_strlen($pass) > 4) {

            if ($pass === $pass_confirm) {
                try {
                    // Requête SQL avec une requête préparée
                    $sql = "INSERT INTO $table (username, password) VALUES (:username, :password)";
                    $stmt = $db->prepare($sql);

                    // Liaison des paramètres
                    $stmt->bindParam(':username', $user);
                    $stmt->bindParam(':password', $encrypt_pass);

                    // Exécution de la requête
                    $stmt->execute();

                    echo json_encode(array(
                        'success' => true,
                        'message' => "Inscription réussie"
                    ));
                } catch (PDOException $e) {
                    echo json_encode(array(
                        'success' => false,
                        'message' => "Erreur lors de l'inscription. Veuillez réessayer."
                    ));
                }
            } else {
                echo json_encode(array(
                    'success' => false,
                    'message' => "La confirmation de mot de passe est incorrecte"
                ));
            }
        } else {
            echo json_encode(array(
                'success' => false,
                'message' => "Mot de passe trop court"
            ));
        }
    } else {
        echo json_encode(array(
            'success' => false,
            'message' => "Nom d'utilisateur trop court"
        ));
    }
} else {
    echo json_encode(array(
        'success' => false,
        'message' => "Des champs sont vides"
    ));
}
