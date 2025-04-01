<?php

namespace App\DTOs\Account;

/**
 * Data Transfer Object for retrieving account information.
 */
readonly class AccountRetrieveDTO
{
    /**
     * @param string $user_id The ID of the user to retrieve account for
     */
    public function __construct(
        public string $user_id,
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
        ];
    }
} 