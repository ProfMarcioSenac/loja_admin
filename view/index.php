<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Administração</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <div class="card card-login-admin bg-white">
            <div class="bg-dark text-white text-center py-4">
                <i class="fas fa-shield-alt fa-3x text-warning mb-2"></i>
                <h4 class="mb-0 fw-bold">Painel Administrativo</h4>
            </div>
            <div class="card-body p-4">
                <form method="post" action="../controller/usuarioController.php?action=logar">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-semibold">USUÁRIO ADMIN</label>
                        <input required type="text" name="usuario" id="usuario" class="form-control form-control-lg" placeholder="Usuário">
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted small fw-semibold">SENHA</label>
                        <input required type="password" name="senha" id="senha" class="form-control form-control-lg" placeholder="Senha">
                    </div>
                    <button type="submit" id="submit" class="btn btn-warning btn-lg w-100 fw-semibold">Entrar no Sistema</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <?php
        if (isset($_GET['erro']) && $_GET['erro'] == 'login') {
            echo "<script src='js/erro-login.js'></script>";
        }
        if (isset($_GET['user']) && $_GET['user'] == 'deslogado') {
            echo "<script src='js/deslogado.js'></script>";
        }
    ?>
    <script>
        const erroLoginScript = document.createElement('script');
        erroLoginScript.text = `
            Swal.fire({
                title: "Erro!",
                text: "Usuário ou senha inválidos!",
                icon: "error",
                confirmButtonText: "OK"
            });
        `;
        <?php if(isset($_GET['erro']) && $_GET['erro'] == 'login') echo "document.body.appendChild(erroLoginScript);"; ?>

        const deslogadoScript = document.createElement('script');
        deslogadoScript.text = `
            Swal.fire({
                title: "Deslogado!",
                text: "Você saiu do painel com sucesso!",
                icon: "info",
                confirmButtonText: "OK"
            });
        `;
        <?php if(isset($_GET['user']) && $_GET['user'] == 'deslogado') echo "document.body.appendChild(deslogadoScript);"; ?>
    </script>
</body>
</html>
