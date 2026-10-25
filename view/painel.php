<?php
    session_start();
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-admin py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="painel.php">
                <i class="fas fa-tools text-warning me-2"></i>ADMINISTRAÇÃO
            </a>
            <div class="d-flex align-items-center">
                <a href="usuarios.php" class="btn btn-outline-light me-2"><i class="fas fa-users me-1"></i> Usuários</a>
                <a href="produtos.php" class="btn btn-outline-light me-2"><i class="fas fa-box me-1"></i> Produtos</a>
                <a href="vendas.php" class="btn btn-outline-info me-3"><i class="fas fa-receipt me-1"></i> Vendas</a>
                <a href="#" onclick="confirmSair()" class="btn btn-danger"><i class="fas fa-sign-out-alt me-1"></i> Sair</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="painel-admin-box text-center py-5">
            <h1 class="fw-bold mb-3">Bem-vindo ao Painel de Controle</h1>
            <p class="text-muted fs-5 mb-4">Utilize o menu superior para gerenciar usuários, controlar produtos e acompanhar as vendas da loja.</p>
            <div class="row g-4 justify-content-center mt-3">
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 py-4">
                        <div class="card-body">
                            <i class="fas fa-users fa-3x text-primary mb-3"></i>
                            <h4 class="fw-bold">Gerenciar Usuários</h4>
                            <p class="text-muted small">Adicione ou controle acessos.</p>
                            <a href="usuarios.php" class="btn btn-primary btn-sm px-4">Acessar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 py-4">
                        <div class="card-body">
                            <i class="fas fa-box fa-3x text-success mb-3"></i>
                            <h4 class="fw-bold">Gerenciar Produtos</h4>
                            <p class="text-muted small">Cadastre preços e imagens web.</p>
                            <a href="produtos.php" class="btn btn-success btn-sm px-4">Acessar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 py-4">
                        <div class="card-body">
                            <i class="fas fa-receipt fa-3x text-info mb-3"></i>
                            <h4 class="fw-bold">Visualizar Vendas</h4>
                            <p class="text-muted small">Acompanhe os pedidos realizados.</p>
                            <a href="vendas.php" class="btn btn-info btn-sm px-4 text-dark fw-semibold">Acessar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <?php
        if (isset($_GET['logado']) && $_GET['logado'] == 'true') {
            echo "<script>
                Swal.fire({
                    title: 'Bem-vindo!',
                    text: 'Login administrativo realizado com sucesso!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    ?>
    <script>
        function confirmSair() {
            Swal.fire({
                title: "DESLOGAR!",
                text: "VOCÊ TEM CERTEZA?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#060",
                cancelButtonColor: "#aaa",
                cancelButtonText: "Não Deslogar!",
                confirmButtonText: "Deslogar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `../controller/usuarioController.php?action=sair`;
                }
            });
        }
    </script>
</body>
</html>
<?php
    } else {
        header('Location: index.php');
        exit();
    }
?>
