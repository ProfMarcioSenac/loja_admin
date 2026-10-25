<?php
    session_start();
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Vendas - Admin</title>
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
                <a href="painel.php" class="btn btn-outline-light me-2"><i class="fas fa-home me-1"></i> Painel</a>
                <a href="usuarios.php" class="btn btn-outline-light me-2"><i class="fas fa-users me-1"></i> Usuários</a>
                <a href="produtos.php" class="btn btn-outline-light me-3"><i class="fas fa-box me-1"></i> Produtos</a>
                <a href="#" onclick="confirmSair()" class="btn btn-danger"><i class="fas fa-sign-out-alt me-1"></i> Sair</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="painel-admin-box">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                <h2 class="fw-bold m-0"><i class="fas fa-receipt text-info me-2"></i>Relatório Geral de Vendas</h2>
                <a href="painel.php" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Voltar ao Painel</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>PEDIDO</th>
                            <th>CLIENTE</th>
                            <th>PRODUTO</th>
                            <th>QUANTIDADE</th>
                            <th>VALOR TOTAL</th>
                            <th>DATA DA VENDA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once('../controller/vendaController.php');
                            $venda = new Venda();
                            $consulta = $venda->consulta();

                            foreach ($consulta as $linha) {
                                $id = $linha['id'];
                                $usuario = $linha['usuario'];
                                $produto = $linha['produto'];
                                $qtd = $linha['quantidade'];
                                $total = number_format($linha['valor_total'], 2, ',', '.');
                                $data = $linha['data_criado'];

                                echo "
                                <tr>
                                    <td>#$id</td>
                                    <td class='fw-semibold'>$usuario</td>
                                    <td>$produto</td>
                                    <td>$qtd</td>
                                    <td class='fw-bold text-success'>R$ $total</td>
                                    <td class='text-muted'>$data</td>
                                </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
