<!-- filepath: c:\wamp64\www\flyOS\pendentes.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Pendentes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include './includes/header.php'; ?>
    <?php include './includes/navbar.php'; ?>

    <div class="container mt-5">
        <h4 class="text-center">Manutenções Pendentes</h4>
        <div id="pending-list" class="mt-4">
            <!-- Lista de pendentes será carregada aqui -->
        </div>
    </div>

    <script>
        // Carregar pendentes via API
        document.addEventListener('DOMContentLoaded', function () {
            axios.get('./api/api.php/pending')
                .then(response => {
                    const pendingList = document.getElementById('pending-list');
                    if (response.data.status === 'success') {
                        const pendentes = response.data.data;
                        if (pendentes.length > 0) {
                            let html = '<ul class="list-group">';
                            pendentes.forEach(item => {
                                html += `<li class="list-group-item">
                                    <strong>Equipamento:</strong> ${item.equipment_name} <br>
                                    <strong>Data:</strong> ${item.maintenance_date}
                                </li>`;
                            });
                            html += '</ul>';
                            pendingList.innerHTML = html;
                        } else {
                            pendingList.innerHTML = '<p class="text-center">Nenhuma manutenção pendente encontrada.</p>';
                        }
                    } else {
                        pendingList.innerHTML = `<p class="text-danger text-center">${response.data.message}</p>`;
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar pendentes:', error);
                    document.getElementById('pending-list').innerHTML = '<p class="text-danger text-center">Erro ao carregar pendentes.</p>';
                });
        });
    </script>

    <?php include './includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>