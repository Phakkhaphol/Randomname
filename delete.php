<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';

    if ($name) {
        $stmt = $pdo->prepare("DELETE FROM randomnum WHERE Name = :name");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No name provided']);
    }
}
?>
