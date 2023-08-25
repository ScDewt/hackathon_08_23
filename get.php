<?php

require "pdo.php";

$team = $_GET['team'];
if (empty($team)) {
    echo '{error: "team empty"}';
}

$conn = getConnection();

$sql = "select * from main where team=?";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':team', $team);
//$stmt->bindParam(':name', $name);
//$stmt->bindParam(':hash', $hash);
//$stmt->bindParam(':image_url', $imageUrl);
$stmt->execute();

$result = $stmt->fetch(\PDO::FETCH_ASSOC);

var_dump($result);
