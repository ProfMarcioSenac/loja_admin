<?php
    session_start();
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container my-5">
        <div class="painel-admin-box" style="max-width: 600px; margin: auto;">
            <h2 class="fw-bold mb-4"><i class="fas fa-plus-circle text-success me-2"></i>Cadastrar Novo Produto</h2>
            <form method="post" action="../controller/produtoController.php?action=cadastrarProduto">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nome do Produto</label>
                    <input required type="text" name="nome" class="form-control" placeholder="Nome">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Descrição</label>
                    <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Preço (R$)</label>
                    <input required type="number" step="0.01" name="preco" class="form-control" placeholder="0.00">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Link da Imagem (URL da Internet)</label>
                    <input type="url" name="imagem" class="form-control" placeholder="https://exemplo.com/foto.jpg">
                </div>
                <div class="d-flex justify-content-between">
                    <a href="produtos.php" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-success fw-semibold px-4">Cadastrar Produto</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        header('Location: index.php');
        exit();
    }
?>
