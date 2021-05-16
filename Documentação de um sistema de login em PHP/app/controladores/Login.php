<?php 

require 'app/modelos/Usuario.php';
require 'Controlador.php';

/**
* Classe que gerencia as ações em relação ao usuário 
*/

class LoginController extends Controller  {
    
    /**
    * Instância do usuário que gerencia as informações
    * @var Usuario
    */

    private $loggedUser;
    
    /**
    * Inicia a sessão, verifica se há um usuário já autenticado e carrega na variável $loggedUser se houver
    */

    function __construct() {
        session_start();
        if (isset($_SESSION['user'])) $this->loggedUser = $_SESSION['user'];
    }
    
    /**
    * Recebe a requisição de login, valida os dados e salva
    * o usuário autenticado na Sessão ou retorna uma mensagem
    * de erro caso algum valor esteja incorreto
    */

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['users'])) {
                foreach ($_SESSION['users'] as $user) {
                    if ($user->igual($_POST['email'], $_POST['senha'])) {
                        $_SESSION['user'] = $this->loggedUser = $user;
                        break;
                    }
                }
            }

            if ($this->loggedUser) {
                header('Location: index.php?acao=info');
            } else {
                header('Location: index.php?email=' . $_POST['email'] . '&mensagem=Usuário e/ou senha incorreta!');
            }
        } else {
            if (!$this->loggedUser) {
                $this->view('users/login');
            } else {
                header('Location: index.php?acao=info');
            }
        }
    }

    /**
    * Recebe a requisição de cadastro, valida se já não há um usuário
    * com os mesmos dados, retornando uma mensagem de erro caso haja
    * ou cadastrando o novo usuário
    */

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_SESSION['users'])) $_SESSION['users'] = array();
            
            foreach ($_SESSION['users'] as $user) {
                if ($user->email == $_POST['email']) {
                    header('Location: index.php?acao=cadastrar&mensagem=Email já cadastrado!');
                    return;
                }
            }
            
            $user = new Usuario($_POST['email'], $_POST['senha'], $_POST['nome']);
            array_push($_SESSION['users'], $user);
            
            header('Location: index.php?email=' . $_POST['email'] . '&mensagem=Usuário cadastrado com sucesso!');
            return;
        }
        $this->view('users/cadastrar');
    }

    /**
    * Retorna uma mensagem de erro se o usuário não estiver logado ou
    * libera a visualização das informações caso esteja
    */

    public function info() {
        if (!$this->loggedUser) {
            header('Location: index.php?acao=entrar&mensagem=Você precisa se identificar primeiro');    
            return;
        }
        $this->view('users/info', $this->loggedUser);        
    }

    /**
    * Desloga a sessão caso o usuário esteja logado ou retorna uma
    * mensagem de erro caso não haja uma sessão autenticada
    */

    public function sair() {
        if (!$this->loggedUser) {
            header('Location: index.php?acao=entrar&mensagem=Você precisa se identificar primeiro');
            return;
        }
        unset($_SESSION['user']);
        header('Location: index.php?mensagem=Usuário deslogado com sucesso!');
    }
}

?>