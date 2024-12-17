<?php
require 'connect.php';

$query = "SELECT Name, Location FROM randomnum";
$stmt = $pdo->query($query);

$namesArray = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $namesArray[] = $row;
}

echo json_encode($namesArray);
?>
