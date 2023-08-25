<?php

// by default
use App\Lib\PDOConnection;

$status = STATUS_ACTIVE;
$conn = PDOConnection::getConnection();

$sql = "INSERT INTO user (created, updated, status, name, hash, image_url) 
                VALUES (now(), now(), :status, :name, :hash, :image_url)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':hash', $hash);
$stmt->bindParam(':image_url', $imageUrl);
$stmt->execute();
