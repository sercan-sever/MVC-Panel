<?php

declare(strict_types=1);

final readonly class Route
{
    /**
     * @return array|string
     */
    private static function parse_url(): array|string
    {
        $dirname = dirname($_SERVER['SCRIPT_NAME']);
        $dirname = $dirname != '/' ? $dirname : null;
        $basename = basename($_SERVER['SCRIPT_NAME']);
        return str_replace([$dirname, $basename], [], $_SERVER['REQUEST_URI']);
    }

    /**
     * @param string $url
     * @param string $controller
     * @param string $function
     * @param SchemeEnum $method
     *
     * @return void
     */
    public static function run(string $url, string $controller, string $function, SchemeEnum $method): void
    {
        try {
            $method = explode('|', strtoupper($method->value));

            if (in_array($_SERVER['REQUEST_METHOD'], $method)) {
                self::process(url: $url, controller: $controller, function: $function);
            }
        } catch (Exception $exception) {
            require_once __DIR__ . '/../../views/404.php';
            exit();
        }
    }

    /**
     * @param string $url
     * @param string $controller
     * @param string $function
     *
     * @return void
     */
    public static function get(string $url, string $controller, string $function): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == SchemeEnum::GET->value) {
                self::process(url: $url, controller: $controller, function: $function);
            }

        } catch (Exception $exception) {
            require_once __DIR__ . '/../../views/404.php';
            exit();
        }
    }

    /**
     * @param string $url
     * @param string $controller
     * @param string $function
     *
     * @return void
     */
    public static function post(string $url, string $controller, string $function): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == SchemeEnum::POST->value) {
                self::process(url: $url, controller: $controller, function: $function);
            }
        } catch (Exception $exception) {
            require_once __DIR__ . '/../../views/404.php';
            exit();
        }
    }

    /**
     * @param string $url
     * @param string $controller
     * @param string $function
     *
     * @return void
     */
    private static function process(string $url, string $controller, string $function): void
    {
        $patterns = [
            '{url}' => '([0-9a-zA-Z]+)',
            '{id}' => '([0-9]+)'
        ];

        $url = str_replace(array_keys($patterns), array_values($patterns), $url);
        $request_uri = self::parse_url();

        if (preg_match('@^' . $url . '$@', $request_uri, $parameters)) {
            unset($parameters[0]);

            $className = ucfirst($controller) . 'Controller';
            $controllerFile = __DIR__ . '/../Controller/' . $className . '.php';

            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                call_user_func_array([new $className, $function], $parameters);
                exit();
            } else {
                require_once __DIR__ . '/../../views/404.php';
            }
        }
    }
}
