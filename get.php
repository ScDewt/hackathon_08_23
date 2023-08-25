<?php

require "pdo.php";

header('Content-Type: application/json');
$result = [];

try {
    $team = $_GET['team'];
    if (empty($team)) {
        throw new  Exception('Not found team in query');
    }

    $conn = getConnection();

    $sql = "select * from main where team=:team";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':team', $team);
    $stmt->execute();

    $data = $stmt->fetch(\PDO::FETCH_ASSOC);

    if (empty($result)) {
        throw new  Exception('Not found team in db');
    }

    $result = [
        'status' => 'ok',
        'data' => $data,
    ];

} catch (\Throwable $e) {
    $result = [
        'status' => 'fail',
        'error' => $e->getMessage(),
    ];
}
echo json_encode($result);
return;