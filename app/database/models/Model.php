<?php

namespace app\database\models;

use app\database\Connect;

abstract class Model
{
    protected string $table;

    public function findBy(string $field, mixed $value)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("select * from $this->table where $field = :$field");
            $prepare->execute([
                $field => $value,
            ]);

            return $prepare->fetchObject();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
        }
    }
}
