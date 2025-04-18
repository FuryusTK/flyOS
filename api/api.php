<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db.php';

$method = $_SERVER['REQUEST_METHOD'];

// Logs para depuração
error_log("REQUEST_URI: " . $_SERVER['REQUEST_URI']);
error_log("Método: " . $method);

switch ($method) {
    case 'POST':
        $url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
        $scriptName = basename($_SERVER['SCRIPT_NAME']);
        $endpointIndex = array_search($scriptName, $url) + 1;
        $endpoint = $url[$endpointIndex] ?? '';

        error_log("URL parts: " . json_encode($url));
        error_log("Endpoint index: " . $endpointIndex);
        error_log("Endpoint: " . $endpoint);

        if ($endpoint === 'login') {
            login();
        } elseif ($endpoint === 'logout') {
            logout();
        } elseif ($endpoint === 'equipment') {
            registerEquipment();
        } elseif ($endpoint === 'schedule') {
            scheduleMaintenance();
        } elseif ($endpoint === 'pending') {
            viewPending();
        } elseif ($endpoint === 'alerts') {
            checkUpcomingMaintenances();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Endpoint not found.']);
        }
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
        break;
}

function login() {
    global $pdo;
    error_log("Função login() foi chamada");
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';

    error_log("Dados recebidos: " . json_encode($data));

    if (empty($username) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Usuário e senha são obrigatórios.']);
        return;
    }

    try {
        // Consulta para verificar o usuário no banco de dados
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        error_log("Consulta SQL: SELECT * FROM users WHERE username = '$username'");

        if ($user && password_verify($password, $user['password'])) {
            echo json_encode(['status' => 'success', 'message' => 'Login bem-sucedido!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Usuário ou senha inválidos.']);
            error_log("Resposta do login: " . json_encode(['status' => 'error', 'message' => 'Usuário ou senha inválidos.']));
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erro no servidor: ' . $e->getMessage()]);
    }
}

function logout() {
    // Lógica para logout
    echo json_encode(['status' => 'success', 'message' => 'Logout realizado com sucesso!']);
}

function registerEquipment() {
    global $pdo;
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Aqui você deve implementar a lógica para registrar o equipamento
    // Exemplo de validação simples
    if (empty($data['name']) || empty($data['serial_number'])) {
        echo json_encode(['status' => 'error', 'message' => 'Nome e número de série são obrigatórios.']);
        return;
    }

    // Simulação de sucesso no cadastro
    echo json_encode(['status' => 'success', 'message' => 'Equipamento cadastrado com sucesso!']);
}

function scheduleMaintenance() {
    global $pdo;
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['equipment_id']) || empty($data['maintenance_date'])) {
        echo json_encode(['status' => 'error', 'message' => 'ID do equipamento e data da manutenção são obrigatórios.']);
        return;
    }

    try {
        // Simulação de inserção no banco de dados
        $stmt = $pdo->prepare('INSERT INTO maintenance (equipment_id, maintenance_date) VALUES (:equipment_id, :maintenance_date)');
        $stmt->bindParam(':equipment_id', $data['equipment_id']);
        $stmt->bindParam(':maintenance_date', $data['maintenance_date']);
        $stmt->execute();

        echo json_encode(['status' => 'success', 'message' => 'Manutenção agendada com sucesso!']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao agendar manutenção: ' . $e->getMessage()]);
    }
}

function viewPending() {
    global $pdo;

    try {
        // Consulta para buscar manutenções pendentes
        $stmt = $pdo->query('SELECT e.name AS equipment_name, m.maintenance_date 
                             FROM maintenance m 
                             JOIN equipment e ON m.equipment_id = e.id 
                             WHERE m.maintenance_date >= CURDATE() 
                             ORDER BY m.maintenance_date ASC');
        $pendentes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['status' => 'success', 'data' => $pendentes]);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao buscar pendentes: ' . $e->getMessage()]);
    }
}

function checkUpcomingMaintenances() {
    global $pdo;

    try {
        // Consulta para buscar manutenções próximas (exemplo: próximas 7 dias)
        $stmt = $pdo->query('SELECT e.name AS equipment_name, m.maintenance_date 
                             FROM maintenance m 
                             JOIN equipment e ON m.equipment_id = e.id 
                             WHERE m.maintenance_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY) 
                             ORDER BY m.maintenance_date ASC');
        $alertas = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['status' => 'success', 'data' => $alertas]);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao buscar alertas: ' . $e->getMessage()]);
    }
}
?>