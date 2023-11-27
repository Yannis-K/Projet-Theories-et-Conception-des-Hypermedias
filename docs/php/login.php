<?php

require_once "init.php";

/**
 * 
 * TODO : Login 
 *  - 1 : verifier les champs (user/pass) - regex + ! empty
 *  - 2 : crypter mdp
 *  - 3 : GET user
 *  - 4 : retour rep client
 * 
 * 
 */

if (
    isset($_POST['username']) &&
    !empty($_POST['username']) &&
    isset($_POST['password']) &&
    !empty($_POST['password'])
) {

    //
    $user = htmlspecialchars($_POST['username']);
    $pass = htmlspecialchars($_POST['username']);

    $encrypt_pass = password_hash($pass, PASSWORD_BCRYPT);

    // GET
    $table = USER_TABLE;
    $sql = "SELECT * FROM $table WHERE username =:username AND password=:password";

    $query = $db->prepare($sql);

    $query->bindParam(':username', $user);
    $query->bindParam(':password', $encrypt_pass);

    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);
}
