<?php
session_start();
include 'db_conn.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE username = ?");
    $stmt->execute([$userId]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => 'User not found or deletion failed.'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request.'));
}



?>