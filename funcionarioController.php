<?php

require_once './vendor/autoload.php';

use dao\FuncionarioDAO;

$params = $_REQUEST;

$action = isset($params['action']) != '' ? $params['action'] : '';
$funciCls = new FuncionarioDAO();

switch ($action) {
    case 'add': {
        $funciCls->insertFuncionario($params);
        break;
    } case 'edit': {
        $funciCls->updateFuncionario($params);
        break;
    } case 'delete': {
        $funciCls->deleteFuncionario($params);
        break;
    } default: {
        $funciCls->getAllFuncionarios($params);
        return;
    }
}