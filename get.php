<?php

require "pdo.php";

header('Content-Type: application/json');
$result = [];

$team = $_GET['team'];
if (empty($team)) {
    $result = [
        'status' => 'fail',
        'error' => 'Team is empty',
    ];
    echo json_encode($result);
    return;
}

$conn = getConnection();

$sql = "select * from main where team=:team";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':team', $team);
$stmt->execute();

$result = $stmt->fetch(\PDO::FETCH_ASSOC);

echo json_encode($result);
return;