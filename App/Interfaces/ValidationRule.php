<?php

declare(strict_types=1);

interface ValidationRule
{
    /**
     * @return array<string, array|string>
     */
    public static function rules(): array;
}
