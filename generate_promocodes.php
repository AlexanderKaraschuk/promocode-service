<?php

function generate_promocode($length = 10)
{
    $bytes = random_bytes(ceil($length / 2));

    return strtoupper(substr(bin2hex($bytes), 0, $length));
}

$dsn = sprintf(
    'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
    getenv('DB_HOST'),
    getenv('DB_PORT'),
    getenv('DB_DATABASE')
);

$pdo = new PDO(
    $dsn,
    getenv('DB_USERNAME'),
    getenv('DB_PASSWORD'),
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]
);

function insert(PDO $pdo, $promocode)
{

    $query = "INSERT INTO promocodes (value) VALUES (:promocode)";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':promocode', $promocode);

    $statement->execute();
}

$count = (int) ($argv[1] ?? 1000);

for ($i = 1; $i <= $count; $i++) {
    $promocode = generate_promocode();

    $maxAttempts = 5;
    while (true) {
        try {
            insert($pdo, $promocode);
            break;
        } catch (PDOException $exception) {
            if ($maxAttempts !== 0 && $exception->getCode() === 1062) {
                $maxAttempts--;
                $promocode = generate_promocode();
            } else {
                throw $exception;
            }
        }
    }
}
