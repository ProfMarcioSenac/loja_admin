<?php
require_once('../model/Produto.php');

class produtoController {

    public function consultar() {
        $produtoModel = new Produto();
        return $produtoModel->consulta();
    }

    public function consultaID($id) {
        $produtoModel = new Produto();
        $produtoModel->consultaID($id);
        return $produtoModel;
    }

    public function inserir(Produto $produto) {
        if (strlen($produto->getNome()) == 0 || strlen($produto->getPreco()) == 0) {
            header("Location: ../view/produtos.php?campoVazio");
            exit();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produtoModel = new Produto();
            $produtoModel->inserir($produto);
            header('Location: ../view/produtos.php?cadastro=ok');
            exit();
        } else {
            header("Location: ../view/produtos.php?erro");
            exit();
        }
    }

    public function editar(Produto $produto) {
        if (strlen($produto->getNome()) == 0 || strlen($produto->getPreco()) == 0) {
            header("Location: ../view/produtos.php?campoVazio");
            exit();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produtoModel = new Produto();
            $produtoModel->editar($produto, $produto->getId());
            header("Location: ../view/produtos.php?edit=ok");
            exit();
        } else {
            header("Location: ../view/produtos.php?erro=erro");
            exit();
        }
    }

    public function excluir($id) {
        $produtoModel = new Produto();
        $produtoModel->excluir($id);
        header("Location: ../view/produtos.php?delete=ok");
        exit();
    }

    public function handleRequest() {
        if (isset($_GET['action']) && $_GET['action'] == 'cadastrarProduto') {
            $produto = new Produto();
            $produto->setNome($_POST['nome']);
            $produto->setDescricao($_POST['descricao']);
            $produto->setPreco($_POST['preco']);
            $produto->setImagem($_POST['imagem']);
            $this->inserir($produto);
        }
        if (isset($_GET['action']) && $_GET['action'] == 'editarProduto') {
            $produto = new Produto();
            $produto->setId($_POST['meuid']);
            $produto->setNome($_POST['nome']);
            $produto->setDescricao($_POST['descricao']);
            $produto->setPreco($_POST['preco']);
            $produto->setImagem($_POST['imagem']);
            $this->editar($produto);
        }
        if (isset($_GET['action']) && $_GET['action'] == 'excluirProduto') {
            $this->excluir($_GET['id']);
        }
    }
}

$ProdutoController = new produtoController();
$ProdutoController->handleRequest();
?>
