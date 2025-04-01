<?php

namespace App\Exceptions\Account;

use App\Enums\Account\AccountType;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * Exception thrown when attempting to create an account that already exists
 * for a user with the same type and currency code.
 */
class AccountAlreadyExistsException extends Exception
{
    /**
     * Error code for duplicate account
     */
    public const ERROR_CODE = 'ACCOUNT_ALREADY_EXISTS';

    /**
     * Create a new account already exists exception instance.
     *
     * @param string $userId The ID of the user attempting to create the account
     * @param AccountType $type The type of account being created
     * @param string $currencyCode The currency code of the account
     */
    public function __construct(
        private readonly string $userId,
        private readonly AccountType $type,
        private readonly string $currencyCode
    ) {
        parent::__construct(
            "An account of type '{$type->value}' with currency '{$currencyCode}' already exists for user '{$userId}'."
        );
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function render($request): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'code' => self::ERROR_CODE,
            'message' => $this->getMessage(),
            'data' => [
                'user_id' => $this->userId,
                'account_type' => $this->type->value,
                'currency_code' => $this->currencyCode,
            ],
            'timestamp' => now()->toIso8601String(),
        ], 409);
    }
} 