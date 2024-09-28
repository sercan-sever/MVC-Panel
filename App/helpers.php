<?php

declare(strict_types=1);

if (!function_exists('htmlHideCode')) {
    /**
     * @param string $code
     *
     * @return string
     */
    function htmlHideCode(string $code): string
    {
        $data = trim($code);
        $data = stripslashes($data);

        return htmlspecialchars($data);
    }
}

if (!function_exists('flattenedData')) {
    /**
     * @param array $data
     * 
     * @return array
     */
    function flattenedData(array $data): array
    {
        $flattened = [];

        foreach ($data as $item) {
            foreach ($item as $key => $value) {
                $flattened[$key] = $value;
            }
        }

        return $flattened;
    }
}

if (!function_exists('authCheck')) {
    /**
     * @return bool
     */
    function authCheck(): bool
    {
        return (isset($_SESSION['auth']) && (time() - $_SESSION['auth']['auth_time'] < 1800));
    }
}

if (!function_exists('auth')) {
    /**
     * @return array
     */
    function auth(): array
    {
        return authCheck() ? $_SESSION['auth'] : [];
    }
}

if (!function_exists('authFirstName')) {
    /**
     * @return string
     */
    function authFirstName(): string
    {
        $first = auth()['name'] ?? '';
        return mb_substr($first, 0, 1, "UTF-8");
    }
}

if (!function_exists('authName')) {
    /**
     * @return string
     */
    function authName(): string
    {
        $name = auth()['name'] ?? '';
        return mb_substr($name, 0, 120, "UTF-8");
    }
}
