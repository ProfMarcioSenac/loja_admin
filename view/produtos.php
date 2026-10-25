<?php
    session_start();
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos - Admin</title>
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
                <a href="vendas.php" class="btn btn-outline-info me-3"><i class="fas fa-receipt me-1"></i> Vendas</a>
                <a href="#" onclick="confirmSair()" class="btn btn-danger"><i class="fas fa-sign-out-alt me-1"></i> Sair</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="painel-admin-box">
            <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                <h2 class="fw-bold m-0"><i class="fas fa-box text-success me-2"></i>Gerenciamento de Produtos</h2>
                <a href="cadastrarProduto.php" class="btn btn-success fw-semibold"><i class="fas fa-plus me-1"></i> Novo Produto</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>FOTO</th>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>DESCRIÇÃO</th>
                            <th>PREÇO</th>
                            <th class="text-center">EDITAR</th>
                            <th class="text-center">EXCLUIR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once('../controller/produtoController.php');
                            $produto = new Produto();
                            $consulta = $produto->consulta();

                            foreach ($consulta as $linha) {
                                $id = $linha['id'];
                                $nome = $linha['nome'];
                                $descricao = $linha['descricao'];
                                $preco = number_format($linha['preco'], 2, ',', '.');
                                $imagem = $linha['imagem'];
                        ?>
                        <tr>
                            <td>
                                <?php if (!empty($imagem)) { ?>
                                    <img src="<?php echo htmlspecialchars($imagem); ?>" class="img-admin-preview" alt="Foto">
                                <?php } else { ?>
                                    <span class="badge bg-secondary">Sem Foto</span>
                                <?php } ?>
                            </td>
                            <td>#<?php echo $id; ?></td>
                            <td class="fw-semibold"><?php echo $nome; ?></td>
                            <td class="text-muted small"><?php echo $descricao; ?></td>
                            <td class="fw-bold text-success">R$ <?php echo $preco; ?></td>
                            <td class="text-center"><a class='btn btn-success btn-sm' href='editarProduto.php?id=<?php echo $id; ?>'><i class='fas fa-edit'></i></a></td>
                            <td class="text-center"><a class='btn btn-danger btn-sm' onclick='confirmDelete(<?php echo $id; ?>)' href='#'><i class='fas fa-trash'></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: "Você tem certeza?",
                text: "Não será possível reverter essa ação!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#c00",
                cancelButtonColor: "#aaa",
                cancelButtonText: "Cancelar!",
                confirmButtonText: "Apagar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `../controller/produtoController.php?id=${id}&action=excluirProduto`;
                }
            });
        }

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
