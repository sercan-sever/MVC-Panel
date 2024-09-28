<?php

declare(strict_types=1);

class LoginRequest implements ValidationRule
{
    use Validated;

    /**
     * @return array<string, array|string>
     */
    public static function rules(): array
    {
        return [
            'email' => [
                'required',
                'min_length' => 6,
                'max_length' => 255,
                'email',
            ],
            'password' => [
                'required',
                'min_length' => 8,
                'max_length' => 100,
            ],
        ];
    }
}
