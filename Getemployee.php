<?php
include 'config.php';

$search = $_GET['search']['value'] ?? '';
$start = $_GET['start'] ?? 0;
$length = $_GET['length'] ?? 10;
$orderColumn = $_GET['order'][0]['column'] ?? 'id';
$orderDir = $_GET['order'][0]['dir'] ?? 'ASC';

$sql = "SELECT e.id, e.name, d.department_name, p.position_name 
        FROM employees e 
        JOIN departments d ON e.department_id = d.id 
        JOIN positions p ON e.position_id = p.id 
        WHERE e.name LIKE :search 
        ORDER BY $orderColumn $orderDir 
        LIMIT :start, :length";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
$stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
$stmt->bindValue(':length', (int)$length, PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["data" => $data]);
?>
