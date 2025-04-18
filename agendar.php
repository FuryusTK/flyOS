<!-- filepath: c:\wamp64\www\flyOS\agendar.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Manutenção</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include './includes/header.php'; ?>
    <?php include './includes/navbar.php'; ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h4 class="text-center">Agendar Manutenção</h4>
            </div>
            <div class="card-body">
                <form id="schedule-form">
                    <div class="mb-3">
                        <label for="equipment-id" class="form-label">ID do Equipamento</label>
                        <input type="text" class="form-control" id="equipment-id" placeholder="Digite o ID do equipamento" required>
                    </div>
                    <div class="mb-3">
                        <label for="maintenance-date" class="form-label">Data da Manutenção</label>
                        <input type="date" class="form-control" id="maintenance-date" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Agendar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('schedule-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const data = {
                equipment_id: document.getElementById('equipment-id').value,
                maintenance_date: document.getElementById('maintenance-date').value
            };

            axios.post('./api/api.php/schedule', data)
                .then(response => {
                    alert(response.data.message);
                })
                .catch(error => {
                    alert('Erro ao tentar agendar a manutenção.');
                });
        });
    </script>

    <?php include './includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>