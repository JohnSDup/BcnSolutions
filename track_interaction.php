<?php
// track_interaction.php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Basic validation
    if (!isset($input['action'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing action']);
        exit;
    }
    
    // Get client info
    $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $timestamp = date('Y-m-d H:i:s');
    
    // Prepare data for database
    $action = $input['action'];
    $label = $input['label'] ?? '';
    $page = $input['page'] ?? $_SERVER['REQUEST_URI'];
    $additional_data = json_encode($input['data'] ?? []);
    
    // Insert into database (you'll need to set up your PDO connection)
    try {
        $stmt = $pdo->prepare("INSERT INTO user_interactions (ip, user_agent, action, label, page, additional_data, timestamp) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$ip, $user_agent, $action, $label, $page, $additional_data, $timestamp]);
        
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        error_log("Tracking error: " . $e->getMessage());
        echo json_encode(['success' => false, 'error' => 'Database error']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
}
?>