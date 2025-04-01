<?php

namespace App\Services\Generators\Account;

use App\Models\Account\Account;
use Illuminate\Support\Str;

/**
 * Service for generating unique account numbers.
 */
class AccountNumberGenerator
{
    /**
     * Generate a unique account number with the configured prefix.
     *
     * @return string
     */
    public function generate(): string
    {
        $prefix = config('account.number_prefix', '1000');
        
        do {
            $number = $prefix . Str::padLeft(rand(1, 999999999), 9, '0');
        } while (Account::where('account_number', $number)->exists());

        return $number;
    }
} 