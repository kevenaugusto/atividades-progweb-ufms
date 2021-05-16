<?php
error_reporting(E_ERROR | E_PARSE);

/**
* Cria uma instância do controlador para uso
*/

include_once('app/controladores/Login.php');
$controller = new LoginController();

/**
* Chama o método adequado do controlador de acordo com
* a requisição GET recebida
*/

switch ($_GET['acao']) {
    case 'cadastrar':
        $controller->cadastrar();
        break;
    case 'info':
        $controller->info();
        break;
    case 'sair':
        $controller->sair();
        break;
    default:
        $controller->login();
}
