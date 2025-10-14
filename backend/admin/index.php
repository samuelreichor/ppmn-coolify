<?php
declare(strict_types=1);

$host = getenv('DB_HOST') ?: 'db';
$db   = getenv('DB_NAME') ?: 'db';
$user = getenv('DB_USER') ?: 'db';
$pass = getenv('DB_PASS') ?: 'db';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $stmt = $pdo->prepare("SELECT v FROM settings WHERE k = :k LIMIT 1");
    $stmt->execute([':k' => 'welcome']);
    $row = $stmt->fetch();

    header('Content-Type: text/plain; charset=utf-8');
    echo $row ? $row['v'] : "Nothing found";
} catch (Throwable $e) {
    http_response_code(500);
    echo "DB-Error: " . $e->getMessage();
}
