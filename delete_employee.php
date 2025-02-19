<?php
include 'config.php';

$id = $_GET['id'];
$sql = "DELETE FROM employees WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);

echo json_encode(["message" => "Employee deleted"]);
?>
