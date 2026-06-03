<?php

declare(strict_types=1);

namespace App\Support;

final class LeadFormValidator
{
    public static function normalizedPhone(string $phone): ?string
    {
        $digits = preg_replace('/\D+/', '', $phone) ?? '';

        if (strlen($digits) < 11) {
            return null;
        }

        return $digits;
    }

    public static function phoneErrorMessage(): string
    {
        return 'Укажите корректный номер телефона';
    }

    public static function consentErrorMessage(): string
    {
        return 'Подтвердите согласие с политикой конфиденциальности';
    }
}
