<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use PDOException;
use RuntimeException;

class CLIModel extends Model
{
    /**
     * @throws RuntimeException
     */
    public function __construct(array $attributes = [])
    {
        try {
            Schema::getConnection()->getPdo();
        } catch (PDOException $e) {
            throw new RuntimeException('Unable to connect to the database. Please check your database configuration.');
        }

        if (! Schema::hasTable($this->getTable())) {
            throw new RuntimeException("Table {$this->getTable()} does not exist. Please run migrations.");
        }

        parent::__construct($attributes);
    }
}
