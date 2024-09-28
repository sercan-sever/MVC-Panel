<?php

declare(strict_types=1);

enum FormValidationTypeEnum: string
{
    use EnumValue;

    case REQUIRED = 'required';
    case NULLABLE = 'nullable';
    case MIN = 'min';
    case MIN_LENGTH = 'min_length';
    case MAX = 'max';
    case MAX_LENGTH = 'max_length';
    case EMAIL = 'email';
    case PHONE = 'phone';
    case PASSWORD_CONFIRM = 'password_confirm';
}
