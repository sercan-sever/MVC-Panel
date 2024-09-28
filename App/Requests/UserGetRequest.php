<?php

declare(strict_types=1);

class UserGetRequest implements ValidationRule
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
        ];
    }
}
