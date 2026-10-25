<?php
require_once('../config/conexao.php');

class Produto extends Conexao {
    private $id;
    private $nome;
    private $descricao;
    private $preco;
    private $imagem;
    private $tabela = 'produtos';

    public function __construct() {
        parent::__construct();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function consulta() {
        $sql = "SELECT id, nome, descricao, preco, imagem FROM $this->tabela";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultaID($id) {
        $sql = "SELECT id, nome, descricao, preco, imagem FROM $this->tabela WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $this->setId($result['id']);
            $this->setNome($result['nome']);
            $this->setDescricao($result['descricao']);
            $this->setPreco($result['preco']);
            $this->setImagem($result['imagem']);
        }
    }

    public function inserir(Produto $produto) {
        try {
            $sql = "INSERT INTO $this->tabela (nome, descricao, preco, imagem) VALUES (:nome, :descricao, :preco, :imagem)";
            $stmt = $this->conn->prepare($sql);
            $nome = $produto->getNome();
            $desc = $produto->getDescricao();
            $preco = $produto->getPreco();
            $img = $produto->getImagem();
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $desc, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
            $stmt->bindParam(':imagem', $img, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            header('Location: ../view/produtos.php?cadastro=erro');
            exit();
        }
    }

    public function editar(Produto $produto, $id) {
        try {
            $sql = "UPDATE $this->tabela SET nome = :nome, descricao = :descricao, preco = :preco, imagem = :imagem WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $nome = $produto->getNome();
            $desc = $produto->getDescricao();
            $preco = $produto->getPreco();
            $img = $produto->getImagem();
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $desc, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
            $stmt->bindParam(':imagem', $img, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            header('Location: ../view/produtos.php?cadastro=erro');
            exit();
        }
    }

    public function excluir($id) {
        try {
            $sql = "DELETE FROM $this->tabela WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            header('Location: ../view/produtos.php?cadastro=erro');
            exit();
        }
    }
}
?>
