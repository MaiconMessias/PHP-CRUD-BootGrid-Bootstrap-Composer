<?php
    require_once './vendor/autoload.php';
    
    use dao\UsuarioDAO;
    
    $params = $_REQUEST;
    
    if (isset($params['usr']) && isset($params['pwd'])) {
        $usuarioDAO = new UsuarioDAO();
        $resultado = $usuarioDAO->validaLogin($params['usr'], $params['pwd']);
        echo json_encode($resultado);
    } else
        echo json_encode(-1);
?>