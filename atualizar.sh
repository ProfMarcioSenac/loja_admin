cat << 'EOF' > controller/usuarioController.php
<?php
require_once('../model/Usuario.php');

class usuarioController {

    public function logar() {
        $usuario = new Usuario();
        $user = $_POST['usuario'];
        $senha = $_POST['senha'];
        $senha = hash('sha256', $senha);
        $usuario->logar($user, $senha);
    }

    public function sair() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: ../view/index.php?user=deslogado');
        exit();
    }

    public function inserir(Usuario $usuario) {
        if (strlen($usuario->getUsuario()) == 0 || strlen($usuario->getSenha()) == 0) {
            header("Location: ../view/usuarios.php?campoVazio");
            exit();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioModel = new Usuario();
            $usuarioModel->inserir($usuario);
            header('Location: ../view/usuarios.php?cadastro=ok');
            exit();
        } else {
            header("Location: ../view/usuarios.php?erro");
            exit();
        }
    }

    public function editar(Usuario $usuario) {
        if (strlen($usuario->getUsuario()) == 0) {
            header("Location: ../view/usuarios.php?campoVazio");
            exit();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioModel = new Usuario();
            $usuarioModel->editar($usuario, $usuario->getIdUsuario());
            header('Location: ../view/usuarios.php?edit=ok');
            exit();
        } else {
            header("Location: ../view/usuarios.php?erro=erro");
            exit();
        }
    }

    public function excluir($id) {
        $usuarioModel = new Usuario();
        $usuarioModel->excluir($id);
        header("Location: ../view/usuarios.php?delete=ok");
        exit();
    }

    public function handleRequest() {
        if (isset($_GET['action']) && $_GET['action'] == 'logar') {
            $this->logar();
        }
        if (isset($_GET['action']) && $_GET['action'] == 'sair') {
            $this->sair();
        }
        if (isset($_GET['action']) && $_GET['action'] == 'cadastrarUsuario') {
            $usuario = new Usuario();
            $usuario->setUsuario($_POST['usuario']);
            $usuario->setSenha(hash('sha256', $_POST['senha']));
            $this->inserir($usuario);
        }
        if (isset($_GET['action']) && $_GET['action'] == 'editarUsuario') {
            $usuario = new Usuario();
            $usuario->setIdUsuario($_POST['meuid']);
            $usuario->setUsuario($_POST['usuario']);
            $senhaPost = $_POST['senha'];
            if (!empty($senhaPost)) {
                $usuario->setSenha(hash('sha256', $senhaPost));
            } else {
                $usuario->setSenha('');
            }
            $this->editar($usuario);
        }
        if (isset($_GET['action']) && $_GET['action'] == 'excluirUsuario') {
            $this->excluir($_GET['id']);
        }
    }
}

$UsuarioController = new usuarioController();
$UsuarioController->handleRequest();
?>
EOF

cat << 'EOF' > controller/produtoController.php
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
            header('Location: ../view/produtos.php?edit=ok');
            exit();
        } else {
            header('Location: ../view/produtos.php?erro=erro');
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
EOF

cat << 'EOF' > controller/vendaController.php
<?php
require_once('../model/Venda.php');

class vendaController {
    public function consultar() {
        $vendaModel = new Venda();
        return $vendaModel->consulta();
    }

    public function handleRequest() {
    }
}
$VendaController = new vendaController();
$VendaController->handleRequest();
?>
EOF

echo "Controllers atualizados com sucesso!"