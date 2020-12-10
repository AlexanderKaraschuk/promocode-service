<?php

declare(strict_types=1);

namespace App\Core\Database;

use PDO;

class MysqlDatabaseAdapter implements DatabaseAdapterInterface
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(string $table, array $values): string
    {
        $columns = array_keys($values);

        $bind = array_map(function ($column) {
            return ':' . $column;
        }, $columns);

        $statement = $this->pdo->prepare(
            sprintf("INSERT INTO %s (%s) VALUES (%s);", $table, implode(', ', $columns), implode(', ', $bind))
        );

        foreach ($values as $column => $value) {
            $statement->bindValue(':' . $column, $value);
        }

        $statement->execute();

        return $this->pdo->lastInsertId();
    }

    public function update(string $table, array $values, array $where = [])
    {
        $columns = array_keys($values);
        $setBind = $bind = array_map(function ($column) {
            return $column . ' = :' . $column;
        }, $columns);

        $whereBind = array_map(function ($column) {
            return $column . " = :where_" . $column;
        }, array_keys($where));

        $base = "UPDATE %s SET %s WHERE %s;";

        $statement = $this->pdo->prepare(
            sprintf(
                $base,
                $table,
                implode(', ', $setBind),
                implode(', ', $whereBind)
            )
        );

        foreach ($values as $column => $value) {
            $statement->bindValue(':' . $column, $value);
        }

        foreach ($where as $column => $value) {
            $statement->bindValue(':where_' . $column, $value);
        }

        $statement->execute();
    }

    public function exists(string $table, array $where)
    {
        $result = $this->findOneBy($table, $where);

        return !($result === false);
    }

    public function findOneBy(string $table, array $where)
    {
        $bind = array_map(function ($column) {
            return $column . " = :" . $column;
        }, array_keys($where));


        $statement = $this->pdo->prepare(
            sprintf("SELECT * FROM %s WHERE %s LIMIT 1;", $table, implode(', ', $bind))
        );

        foreach ($where as $column => $value) {
            $statement->bindValue(':' . $column, $value);
        }

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function execute(string $query, array $bind = [])
    {
        $statement = $this->pdo->prepare($query);

        foreach ($bind as $key => $value) {
            $statement->bindValue(':' . $key, $value);
        }

        $statement->execute();
    }
}
