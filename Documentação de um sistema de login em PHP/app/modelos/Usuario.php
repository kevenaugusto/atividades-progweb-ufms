<?php

/**
* Classe que cria um novo usuário e valida os dados recebidos
* na hora de efetuar o login
*/

class Usuario {

    /**
    * @var string $email E-mail cadastrado pelo usuário
    */

    private $email;

    /**
    * @var string $senha Hash da senha cadastrada pelo usuário
    */

    private $senha;

    /**
    * @var string $nome Nome do usuário
    */

    private $nome;

    /**
    * Método construtor que inicia os atributos da classe
    * com os valores recebidos do usuário
    */

    function __construct(string $email, string $senha, string $nome) {
        $this->email = $email;
        $this->senha = hash('sha256', $senha);
        $this->nome = $nome;
    }

    /**
    * Getter do atributo $campo
    */

    public function __get($campo) {
        return $this->$campo;
    }

    /**
    *  Setter do atributo $campo
    */

    public function __set($campo, $valor) {
        return $this->$campo = $valor;
    }

    /**
    * Método que valida se os valores recebidos são iguais aos cadastrados
    *
    * @param string $email E-mail recebido pelo formulário
    * @param string $senha Hash da senha recebida pelo formulário
    */

    public function igual(string $email, string $senha) {
        return $this->email === $email && $this->senha === hash('sha256', $senha);
    }
}

?>