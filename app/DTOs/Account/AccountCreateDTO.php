<?php

namespace App\DTOs\Account;

use App\Enums\Account\AccountType;
use App\Enums\Currency\CurrencyCode;

/**
 * Data Transfer Object for creating a new account.
 */
readonly class AccountCreateDTO
{
    /**
     * @param string $user_id The ID of the user creating the account
     * @param AccountType $type The type of account
     * @param CurrencyCode $currency_code The currency code for the account
     * @param float $minimum_balance The minimum balance required (default: 0.0)
     * @param float $overdraft_limit The overdraft limit allowed (default: 0.0)
     * @param float $interest_rate The interest rate for the account (default: 0.0)
     */
    public function __construct(
        public string $user_id,
        public AccountType $type,
        public CurrencyCode $currency_code,
        public float $minimum_balance = 0.0,
        public float $overdraft_limit = 0.0,
        public float $interest_rate = 0.0,
    ) {
    }

    /**
     * Create a new DTO instance from a request array.
     *
     * @param array<string, mixed> $request The request data
     * @return static
     */
    public static function fromRequest(array $request): static
    {
        return new self(
            user_id: $request['user_id'],
            type: AccountType::from($request['type'] ?? AccountType::CHECKING->value),
            currency_code: CurrencyCode::from($request['currency_code'] ?? CurrencyCode::MYR->value),
        );
    }

    /**
     * Get validation rules for the DTO.
     *
     * @return array<string, array<int, string>>
     */
    public static function validationRules(): array
    {
        return [
            'user_id' => ['required', 'string'],
            'type' => ['sometimes', 'string', 'in:' . implode(',', AccountType::values())],
            'currency_code' => ['sometimes', 'string', 'in:' . implode(',', CurrencyCode::values())],
        ];
    }
}