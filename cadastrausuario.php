<?php
    require_once './vendor/autoload.php';
    
    use dao\UsuarioDAO;
    
    $params = $_REQUEST;
    
    if (isset($params['nome']) && isset($params['email']) && isset($params['pwdCadastro'])
        && isset($params['pwdComfirmCadastro'])) {
        $usuarioDAO = new UsuarioDAO();
        $resultado = $usuarioDAO->incUsuario($params['email'], $params['pwdCadastro']);
        echo json_encode($resultado);
    } else 
        echo json_encode(false);

?>