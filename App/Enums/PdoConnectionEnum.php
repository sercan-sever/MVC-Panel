<?php

declare(strict_types=1);

enum PdoConnectionEnum: string
{
    case HOST = 'mysql8.1';
    case NAME = 'karecode_test';
    case CHARSET = 'utf8';
    case USER = 'root';
    case PASSWORD = 'root '; // Aynı değerde hata verdiği için boşluk bıraktım.
}
