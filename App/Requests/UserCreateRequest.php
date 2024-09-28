<?php

declare(strict_types=1);

class UserCreateRequest implements ValidationRule
{
    use Validated;

    /**
     * @return array<string, array|string>
     */
    public static function rules(): array
    {
        return [
            'name' => [
                'required',
                'min_length' => 1,
                'max_length' => 255,
            ],
            'surname' => [
                'required',
                'min_length' => 1,
                'max_length' => 255,
            ],
            'email' => [
                'required',
                'email',
                'min_length' => 6,
                'max_length' => 255,
            ],
            'phone' => [
                'required',
                'phone',
                'min_length' => 10,
                'max_length' => 11,
            ],
            'password' => [
                'required',
                'password_confirm',
                'min_length' => 8,
                'max_length' => 100,
            ],
            'password_confirm' => [
                'required',
                'password_confirm',
                'min_length' => 8,
                'max_length' => 100,
            ],
        ];
    }
}
