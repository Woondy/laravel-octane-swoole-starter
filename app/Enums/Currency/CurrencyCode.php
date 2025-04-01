<?php

namespace App\Enums\Currency;

/**
 * Enum representing different currency codes.
 */
enum CurrencyCode: string
{
    /**
     * Malaysian Ringgit
     * - Country: Malaysia
     * - Numeric code: 458
     * - Symbol: RM
     * - Central Bank: Bank Negara Malaysia
     */
    case MYR = 'MYR';

    /**
     * Gets all possible values for database storage and validation.
     * 
     * @return array<string> Array of all enum values
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get currency symbol
     */
    public function symbol(): string
    {
        return match($this) {
            self::MYR => 'RM',
        };
    }

    /**
     * Get numeric ISO code
     */
    public function numericCode(): int
    {
        return match($this) {
            self::MYR => 458,
        };
    }
}
