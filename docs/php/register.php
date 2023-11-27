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

require_once "connection.php";

$table = USER_TABLE;
