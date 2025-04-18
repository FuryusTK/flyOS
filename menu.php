<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal - Sistema de Manutenção</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include './includes/header.php'; ?>
    <?php include './includes/navbar.php'; ?>

    <div class="d-flex">
        <!-- Menu lateral -->
        <div id="sidebar" class="bg-light p-3">
            <div class="list-group">
                <button class="list-group-item list-group-item-action" onclick="loadContent('cadastrar.php')">Cadastrar Equipamento</button>
                <button class="list-group-item list-group-item-action" onclick="loadContent('agendar.php')">Agendar Manutenção</button>
                <button class="list-group-item list-group-item-action" onclick="loadContent('pendentes.php')">Ver Pendentes</button>
                <button class="list-group-item list-group-item-action" onclick="loadContent('alertas.php')">Alertas</button>
            </div>
        </div>

        <!-- Conteúdo principal -->
        <div id="main-content" class="container-fluid p-4">
            <h1>Bem-vindo ao Sistema de Manutenção</h1>
            <p>Selecione uma opção no menu ao lado para começar.</p>
        </div>
    </div>

    <?php include './includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>
</html>