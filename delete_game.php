<?php
session_start();
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gameId'])) {
    $gameId = $_POST['gameId'];
    $stmt = $pdo->prepare("DELETE FROM game WHERE game_id = ?");
    $stmt->execute([$gameId]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'message' => 'User not found or deletion failed.'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request.'));
}
?>