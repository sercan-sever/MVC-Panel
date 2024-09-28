<?php

declare(strict_types=1);

class Controller extends Model
{
    /**
     * @param string $view
     * @param array $params
     *
     * @return void
     */
    public function view(string $view, array $params = []): void
    {
        extract($params);

        require_once __DIR__ . '/../../views/' . strtolower($view) . '.php';
    }
}
