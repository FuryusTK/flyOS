<!-- filepath: c:\wamp64\www\flyOS\alertas.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alertas de Manutenção</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include './includes/header.php'; ?>
    <?php include './includes/navbar.php'; ?>

    <div class="container mt-5">
        <h4 class="text-center">Alertas de Manutenção</h4>
        <div id="alerts-list" class="mt-4">
            <!-- Lista de alertas será carregada aqui -->
        </div>
    </div>

    <script>
        // Carregar alertas via API
        document.addEventListener('DOMContentLoaded', function () {
            axios.get('./api/api.php/alerts')
                .then(response => {
                    const alertsList = document.getElementById('alerts-list');
                    if (response.data.status === 'success') {
                        const alertas = response.data.data;
                        if (alertas.length > 0) {
                            let html = '<ul class="list-group">';
                            alertas.forEach(item => {
                                html += `<li class="list-group-item">
                                    <strong>Equipamento:</strong> ${item.equipment_name} <br>
                                    <strong>Data:</strong> ${item.maintenance_date}
                                </li>`;
                            });
                            html += '</ul>';
                            alertsList.innerHTML = html;
                        } else {
                            alertsList.innerHTML = '<p class="text-center">Nenhum alerta encontrado.</p>';
                        }
                    } else {
                        alertsList.innerHTML = `<p class="text-danger text-center">${response.data.message}</p>`;
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar alertas:', error);
                    document.getElementById('alerts-list').innerHTML = '<p class="text-danger text-center">Erro ao carregar alertas.</p>';
                });
        });
    </script>

    <?php include './includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>