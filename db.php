<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$host = "mysql.railway.internal";
$db_name = "railway";
$username = "root";
$password = "SRhQQVbXdGbUUCkqvcrqmkKyTkHFYEem";
$port = "3306";

try {
    $conn = new PDO(
        "mysql:host=$host;port=$port;dbname=$db_name",
        $username,
        $password
    );

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $exception) {
    echo json_encode([
        "status" => "error",
        "message" => "Connection error: " . $exception->getMessage()
    ]);
    exit;
}
?>