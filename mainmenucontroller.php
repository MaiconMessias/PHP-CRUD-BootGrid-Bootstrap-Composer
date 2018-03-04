<?php

    session_start();
    
    $params = $_REQUEST;
    
    if ($params['login'] == "true") {
        if ( isset($_SESSION['usuario']) ) {
            $data = array(
                            "usuario" => $_SESSION['usuario'],
                           );
            echo json_encode($data);
        } else {
            echo json_encode(-1);
        }
    } else {
        if ( isset($_SESSION['usuario']) ) {
            unset($_SESSION['usuario']);
            echo json_encode(-1);
        }
    }