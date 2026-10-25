<?php
require_once('../config/conexao.php');

class Usuario extends Conexao {
    private $id_usuario;
    private $usuario;
    private $senha;
    private $tabela = 'usuarios';

    public function __construct() {
        parent::__construct();
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function consulta() {
        $sql = "SELECT id_usuario, usuario, data_criado, data_editado FROM $this->tabela";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultaID($id_usuario) {
        $sql = "SELECT id_usuario, usuario FROM $this->tabela WHERE id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->setIdUsuario($result['id_usuario']);
            $this->setUsuario($result['usuario']);
        }
    }

    public function inserir(Usuario $usuario) {
        try {
            $sql = "INSERT INTO $this->tabela (usuario, senha) VALUES (:usuario, :senha)";
            $stmt = $this->conn->prepare($sql);
            $user = $usuario->getUsuario();
            $pass = $usuario->getSenha();
            $stmt->bindParam(':usuario', $user, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $pass, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            header('Location: ../view/usuarios.php?cadastro=erro');
            exit();
        }
    }

    public function editar(Usuario $usuario, $id_usuario) {
        try {
            if (!empty($usuario->getSenha())) {
                $sql = "UPDATE $this->tabela SET usuario = :usuario, senha = :senha WHERE id_usuario = :id_usuario";
                $stmt = $this->conn->prepare($sql);
                $pass = $usuario->getSenha();
                $stmt->bindParam(':senha', $pass, PDO::PARAM_STR);
            } else {
                $sql = "UPDATE $this->tabela SET usuario = :usuario WHERE id_usuario = :id_usuario";
                $stmt = $this->conn->prepare($sql);
            }
            $user = $usuario->getUsuario();
            $stmt->bindParam(':usuario', $user, PDO::PARAM_STR);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            header('Location: ../view/usuarios.php?cadastro=erro');
            exit();
        }
    }

    public function excluir($id_usuario) {
        try {
            $sql = "DELETE FROM $this->tabela WHERE id_usuario = :id_usuario";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            header('Location: ../view/usuarios.php?cadastro=erro');
            exit();
        }
    }

    public function logar($usuario, $senha) {
        $sql = "SELECT id_usuario, usuario, senha FROM $this->tabela WHERE usuario = :usuario AND senha = :senha";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = $result['usuario'];
            header('Location: ../view/painel.php?logado=true');
            exit();
        } else {
            header('Location: ../view/index.php?erro=login');
            exit();
        }
    }
}
?>
