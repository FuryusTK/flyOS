// Funções para navegação no sistema
function showEquipmentForm() {
    window.location.href = 'cadastrar.php';
}

function scheduleMaintenance() {
    window.location.href = 'agendar.php';
}

function viewPending() {
    window.location.href = 'pendentes.php';
}

function checkUpcomingMaintenances() {
    window.location.href = 'alertas.php';
}

function loadContent(page) {
    const mainContent = document.getElementById('main-content');
    mainContent.innerHTML = '<p>Carregando...</p>'; // Exibe um indicador de carregamento

    axios.get(page)
        .then(response => {
            mainContent.innerHTML = response.data; // Insere o conteúdo da página no espaço principal
        })
        .catch(error => {
            console.error('Erro ao carregar o conteúdo:', error);
            mainContent.innerHTML = '<p class="text-danger">Erro ao carregar o conteúdo.</p>';
        });
}