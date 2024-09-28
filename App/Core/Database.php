<?php

declare(strict_types=1);

class Database
{
    /**
     * @var PDO
     */
    protected PDO $pdo;
    
    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                "mysql:host=" . PdoConnectionEnum::HOST->value . ";
                dbname=" . PdoConnectionEnum::NAME->value . ";
                charset=" . PdoConnectionEnum::CHARSET->value . "",
                PdoConnectionEnum::USER->value,
                trim(PdoConnectionEnum::PASSWORD->value)
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        } catch (\PDOException $exception) {
            die($exception->getMessage());
        }
    }
}
