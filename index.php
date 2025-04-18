<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Manutenção - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include './includes/navbar.php'; ?>

    <!-- Login -->
    <div id="login" class="container mt-5" style="display:block;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-center">Login</h4>
                    </div>
                    <div class="card-body">
                        <form id="login-form">
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuário</label>
                                <input type="text" class="form-control" id="username" placeholder="Digite seu usuário" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" placeholder="Digite sua senha" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script>
        // Função de Login - Agora em bloco script correto
        document.getElementById('login-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // Use um caminho absoluto começando da raiz do projeto
            axios.post('./api/api.php/login', { username, password })
                .then(response => {
                    console.log('Resposta recebida:', response.data); // Para depuração
                    if (response.data.status === 'success') {
                        alert('Login bem-sucedido!');
                        window.location.href = 'menu.php';
                    } else {
                        alert('Login falhou: ' + (response.data.message || 'Erro desconhecido.'));
                    }
                })
                .catch(error => {
                    console.error('Erro durante o login:', error);
                    alert('Erro ao tentar fazer login.');
                });
        });
    </script>
</body>
</html>