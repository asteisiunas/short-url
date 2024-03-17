<?php

declare(strict_types=1);

namespace App\Services;

class NumberBaseConverter
{
    private static string $characters = '0123456789abcdefghijklmnopqrstuvwxyz';

    public function convertDecimal(int $decimalNumber): string
    {
        $base = strlen(self::$characters); // hard-coded just for simplicity. This way I don't need to validate $base argument value here

        if ($decimalNumber === 0) {
            return self::$characters[0];
        }

        return sprintf(
            '%s%s',
            $this->convertDecimal(intdiv($decimalNumber, $base)),
            self::$characters[$decimalNumber % $base]
        );
    }
}
