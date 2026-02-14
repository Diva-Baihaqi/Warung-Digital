<?php
include '../../config/database.php';
checkAdmin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['order_id']) || !isset($input['status'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid parameters']);
    exit;
}

$id = $conn->real_escape_string($input['order_id']);
$status = $conn->real_escape_string($input['status']);

// Validate status
$valid_statuses = ['pending', 'paid', 'shipped', 'completed', 'cancelled'];
if (!in_array($status, $valid_statuses)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid status']);
    exit;
}

$sql = "UPDATE pesanan SET status = '$status' WHERE id = '$id'";

if ($conn->query($sql)) {
    // Return display color based on new status
    $colors = [
        'pending' => 'bg-yellow-200', 
        'paid' => 'bg-blue-200', 
        'shipped' => 'bg-purple-200', 
        'completed' => 'bg-green-200', 
        'cancelled' => 'bg-red-200'
    ];
    
    echo json_encode([
        'success' => true, 
        'new_status' => $status,
        'new_color' => $colors[$status] ?? 'bg-gray-200'
    ]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Database update failed']);
}
?>
