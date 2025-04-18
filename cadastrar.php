<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Equipamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include './includes/header.php'; ?>
    <?php include './includes/navbar.php'; ?>

    <div id="equipment-form" class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="text-center">Cadastrar Equipamento</h4>
            </div>
            <div class="card-body">
                <form id="equipment-form-data">
                    <div class="mb-3">
                        <label for="equipment-name" class="form-label">Nome do Equipamento</label>
                        <input type="text" class="form-control" id="equipment-name" placeholder="Digite o nome do equipamento" required>
                    </div>
                    <div class="mb-3">
                        <label for="equipment-model" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="equipment-model" placeholder="Digite o modelo do equipamento" required>
                    </div>
                    <div class="mb-3">
                        <label for="equipment-serial" class="form-label">Número de Série</label>
                        <input type="text" class="form-control" id="equipment-serial" placeholder="Digite o número de série" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('equipment-form-data').addEventListener('submit', function (e) {
            e.preventDefault();

            const data = {
                name: document.getElementById('equipment-name').value,
                model: document.getElementById('equipment-model').value,
                serial_number: document.getElementById('equipment-serial').value,
                installation_date: document.getElementById('equipment-date').value
            };

            axios.post('./api/api.php/equipment', data)
                .then(response => {
                    alert(response.data.message);
                })
                .catch(error => {
                    console.error('Erro ao cadastrar equipamento:', error);
                    alert('Erro ao tentar cadastrar o equipamento.');
                });
        });
    </script>

    <?php include './includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>