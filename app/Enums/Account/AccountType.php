<?php

namespace App\Enums\Account;

/**
 * Enum representing different account types.
 */
enum AccountType: string
{
    /**
     * Standard checking account for daily transactions
     * - Designed for frequent deposits/withdrawals
     * - Typically offers debit card and check-writing capabilities
     * - May have minimum balance requirements
     * - Usually earns little to no interest
     */
    case CHECKING = 'checking';

    /**
     * Interest-bearing savings account
     * - Optimized for growing funds over time
     * - May limit withdrawals (e.g., 6 per month)
     * - Often has higher interest rates than checking
     * - May require minimum balance to avoid fees
     */
    case SAVINGS = 'savings';

    /**
     * Trust holding account for secured transactions
     * - Temporarily holds funds until contract conditions are met
     * - Common for real estate, online marketplaces, and service deposits
     * - Requires third-party verification for fund release
     * - Typically has restricted withdrawal permissions
     */
    case ESCROW = 'escrow';

    /**
     * Business merchant services account
     * - Designed for commercial payment processing
     * - Supports high transaction volumes
     * - May include special features like batch settlements
     * - Requires business registration documents for verification
     * - Often subject to transaction fees
     */
    case MERCHANT = 'merchant';

    /**
     * Gets all possible values for database storage and validation.
     * 
     * @return array<string> Array of all enum values
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}