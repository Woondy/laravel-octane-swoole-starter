<?php

namespace App\Services\Actions\Account;

use App\Models\Account\Account;
use App\Repositories\AccountRepository;

/**
 * Action class for retrieving an account by user ID.
 */
class GetAccountAction
{
    public function __construct(
        private AccountRepository $accountRepository
    ) {}

    /**
     * Execute the action to get an account by user ID.
     *
     * @param string $userId The ID of the user to retrieve account for
     * @return Account
     */
    public function execute(string $userId): Account
    {
        return $this->accountRepository->findByUserIdOrFail($userId);
    }
} 