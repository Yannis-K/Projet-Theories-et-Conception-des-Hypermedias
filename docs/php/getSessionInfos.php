<?php

session_start();

if (isset($_SESSION) && !empty($_SESSION)) {
    echo json_encode(
        array(
            'success' => true,
            'session' => $_SESSION
        )
    );
} else {
    echo json_encode(
        array(
            'success' => false,
            'message' => "session pas init"
        )
    );
}
