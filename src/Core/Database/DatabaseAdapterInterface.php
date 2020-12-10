<?php

declare(strict_types=1);

namespace App\Core\Database;

interface DatabaseAdapterInterface
{
    public function insert(string $table, array $values): string;

    public function update(string $table, array $values, array $where = []);

    public function exists(string $table, array $where);

    public function findOneBy(string $table, array $where);

    public function execute(string $query, array $bind = []);
}
