<?php

require_once "init.php";

/**
 * 
 * TODO : Login 
 *  - 1 : verifier les champs (user/pass) - regex + ! empty
 *  - 2 : crypter mdp
 *  - 3 : GET user
 *  - 4 : init SESSION
 *  - 5 : retour rep client
 * 
 * 
 */

if (isset($_POST['username']) && !empty($_POST['username']) && isset($_POST['password']) && !empty($_POST['password'])) {

    $user = htmlspecialchars($_POST['username']);
    $pass = $_POST['password'];

    $table = USER_TABLE;
    $sql = "SELECT * FROM $table WHERE username = :username";
    $query = $db->prepare($sql);
    $query->bindParam(':username', $user);
    $query->execute();
    $result = $query->fetch();

    if ($result != false) {
        if (password_verify($pass, $result['password'])) {
            // Démarrer la session
            session_start();

            // Stocker l'identifiant de l'utilisateur dans la session
            $_SESSION['user_id'] = $result['id'];

            $response = array(
                'success' => true,
                'user_id' => $result['id']
            );
        } else {
            $response = array(
                'success' => false,
                'message' => "Mot de passe incorrect",
            );
        }
    } else {
        $response = array(
            'success' => false,
            'message' => "Utilisateur non trouvé",
        );
    }

    echo json_encode($response);
}
