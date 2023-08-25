<?php

require "pdo.php";

$conn = getConnection();

$sql = "select * from main";

$stmt = $conn->prepare($sql);
//$stmt->bindParam(':status', $status);
//$stmt->bindParam(':name', $name);
//$stmt->bindParam(':hash', $hash);
//$stmt->bindParam(':image_url', $imageUrl);
$stmt->execute();

$result = $stmt->fetch(\PDO::FETCH_ASSOC);

var_dump($result);
