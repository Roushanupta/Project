<?php
include 'config.php';

$data = json_decode(file_get_contents("php://input"), true);
$name = $data['name'];
$department_id = $data['department_id'];
$position_id = $data['position_id'];

$sql = "INSERT INTO employees (name, department_id, position_id) VALUES (:name, :department_id, :position_id)";
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':name' => $name,
    ':department_id' => $department_id,
    ':position_id' => $position_id
]);

echo json_encode(["message" => "Employee added successfully"]);
?>
