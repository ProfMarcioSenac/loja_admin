<?php
    session_start();
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
        require_once('../model/Usuario.php');
        $usuario = new Usuario();
        $usuario->consultaID($_GET['id']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container my-5">
        <div class="painel-admin-box" style="max-width: 600px; margin: auto;">
            <h2 class="fw-bold mb-4"><i class="fas fa-user-edit text-success me-2"></i>Editar Usuário</h2>
            <form method="post" action="../controller/usuarioController.php?action=editarUsuario">
                <input type="hidden" name="meuid" value="<?php echo $usuario->getIdUsuario(); ?>">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Login do Usuário</label>
                    <input required type="text" name="usuario" class="form-control" value="<?php echo $usuario->getUsuario(); ?>">
                </div>
                <div class="mb-4">
                    <label class="form-label fw-semibold">Nova Senha (deixe em branco para manter a atual)</label>
                    <input type="password" name="senha" class="form-control" placeholder="Nova senha opcional">
                </div>
                <div class="d-flex justify-content-between">
                    <a href="usuarios.php" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-success fw-semibold px-4">Salvar Alterações</button>
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
