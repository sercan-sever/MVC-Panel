<?php

declare(strict_types=1);

class UserUpdateRequest implements ValidationRule
{
    use Validated;

    /**
     * @return array<string, array|string>
     */
    public static function rules(): array
    {
        return [
            'id' => [
                'required',
                'min' => 1,
            ],
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
                'nullable',
                'password_confirm',
                'min_length' => 8,
                'max_length' => 100,
            ],
            'password_confirm' => [
                'nullable',
                'password_confirm',
                'min_length' => 8,
                'max_length' => 100,
            ],
        ];
    }
}
