<?php

declare(strict_types=1);

trait Validated
{
    /**
     * @var bool
     */
    private static bool $nullable = false;

    /**
     * @var array
     */
    private static array $validatedData = [
        'success' => true,
        'message' => 'İşlem Başarıyla Gerçekleştirildi.',
        'data' => [],
    ];

    /**
     * @var array
     */
    private static array $ruleData = [
        'success' => true,
        'message' => '',
    ];

    /**
     * @param array $data
     *
     * @return array
     */
    public static function validated(array $data): array
    {
        $rules = self::rules();

        foreach ($data as $dataKey => $dataValue) {
            foreach ($rules as $ruleKey => $ruleValue) {

                if ($dataKey == $ruleKey) {
                    foreach ($ruleValue as $key => $value) {

                        if (in_array($key, FormValidationTypeEnum::values())) {
                            $result = self::{$key}($ruleKey, $dataValue, $value);
                        }

                        if (in_array($value, FormValidationTypeEnum::values())) {

                            if (FormValidationTypeEnum::PASSWORD_CONFIRM->value === $value) {
                                $result = self::{$value}($ruleKey, $data['password'] ?? '', $data['password_confirm'] ?? '');
                            } else {
                                $result = self::{$value}($ruleKey, $dataValue);
                            }
                        }

                        if (FormValidationTypeEnum::NULLABLE->value === $value) {
                            if (!self::$nullable) {
                                break;
                            }
                        }

                        if (!$result['success']) return $result;
                    }

                    unset($result['success']);
                    self::$validatedData['data'][] = $result;
                }
            }
        }

        return self::$validatedData;
    }

    /**
     * @param string $key
     * @param string|null $field
     *
     * @return array
     */
    private static function required(string $key, ?string $field): array
    {
        self::$ruleData = !empty($field)
            ? ['success' => true, $key => $field]
            : ['success' => false, 'message' => $key . ' Alanı Zorunludur !!!'];

        return self::$ruleData;
    }

    /**
     * @param string $key
     * @param string|null $field
     *
     * @return array
     */
    private static function nullable(string $key, ?string $field): array
    {
        $result = self::required(key: $key, field: $field);
        self::$nullable = (bool)$result['success'];

        return self::$ruleData = ['success' => true];
    }


    /**
     * @param string $key
     * @param int|string|null $field
     * @param int $min
     *
     * @return array
     */
    private static function min(string $key, int|string|null $field, int $min): array
    {
        self::$ruleData = (!empty((int)$field) && (int)$field >= $min)
            ? ['success' => true, $key => $field]
            : ['success' => false, 'message' => $key . ' Alanı En Az ' . $min . ' Olmalıdır !!!'];

        return self::$ruleData;
    }


    /**
     * @param string $key
     * @param int|string|null $field
     * @param int $max
     *
     * @return array
     */
    private static function max(string $key, int|string|null $field, int $max): array
    {
        self::$ruleData = (!empty((int)$field) && (int)$field <= $max)
            ? ['success' => true, $key => $field]
            : ['success' => false, 'message' => $key . ' Alanı ' . $max . ' Değerinden Büyük Olmamalıdır !!!'];

        return self::$ruleData;
    }


    /**
     * @param string $key
     * @param string|null $field
     * @param int $min
     *
     * @return array
     */
    private static function min_length(string $key, ?string $field, int $min): array
    {
        self::$ruleData = !empty($field) && strlen($field) >= $min
            ? ['success' => true, $key => $field]
            : ['success' => false, 'message' => $key . ' Alanı En Az ' . $min . ' Karakter Uzunluğunda Olmalıdır !!!'];

        return self::$ruleData;
    }


    /**
     * @param string $key
     * @param string|null $field
     * @param int $max
     *
     * @return array
     */
    private static function max_length(string $key, ?string $field, int $max): array
    {
        self::$ruleData = (!empty($field) && strlen($field) <= $max)
            ? ['success' => true, $key => $field]
            : ['success' => false, 'message' => $key . ' Alanı ' . $max . ' Karakterden Büyük Olmamalıdır !!!'];

        return self::$ruleData;
    }


    /**
     * @param string $key
     * @param string|null $field
     *
     * @return array
     */
    public static function email(string $key, ?string $field): array
    {
        self::$ruleData = (filter_var($field, FILTER_VALIDATE_EMAIL))
            ? ['success' => true, $key => $field]
            : ['success' => false, 'message' => $key . ' Alanı Geçerli Bir E-Posta Adresi Olmalıdır !!!'];

        return self::$ruleData;
    }


    /**
     * @param string $key
     * @param string|null $field
     *
     * @return array
     */
    public static function phone(string $key, ?string $field): array
    {
        self::$ruleData = (preg_match('/^[0-9]{11}+$/', $field))
            ? ['success' => true, $key => $field]
            : ['success' => false, 'message' => $key . ' Alanı Geçerli Bir Telefon Numarası Olmalıdır !!!'];

        return self::$ruleData;
    }


    /**
     * @param string $key
     * @param string|null $fieldOne
     * @param string|null $fieldTwo
     *
     * @return array
     */
    public static function password_confirm(string $key, ?string $fieldOne, ?string $fieldTwo): array
    {
        self::$ruleData = ((!empty($fieldOne) && !empty($fieldTwo)) && ($fieldOne === $fieldTwo))
            ? ['success' => true, $key => $fieldOne]
            : ['success' => false, 'message' => 'Şifreler Eşleşmiyor !!!'];

        return self::$ruleData;
    }
}
