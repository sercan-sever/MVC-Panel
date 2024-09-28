<?php

declare(strict_types=1);

class Model extends Database
{
    /**
     * @param string $model
     */
    public function model(string $model): object
    {
        require_once __DIR__ . '/../Model/' . ucfirst($model) . '.php';

        return new $model();
    }
}
