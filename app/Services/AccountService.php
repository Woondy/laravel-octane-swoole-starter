<?php

namespace App\Services;

use App\Contracts\Service\AccountServiceContract;
use App\DTOs\Account\AccountCreateDTO;
use App\DTOs\Account\AccountRetrieveDTO;
use App\DTOs\Account\AccountBalanceDTO;
use App\Models\Account\Account;
use App\Services\Actions\Account\CreateAccountAction;
use App\Services\Actions\Account\GetAccountAction;

/**
 * Service for managing accounts.
 */
class AccountService implements AccountServiceContract
{
    public function __construct(
        private CreateAccountAction $createAccountAction,
        private GetAccountAction $getAccountAction
    ) {}

    public function create(AccountCreateDTO $accountDTO): Account
    {
        return $this->createAccountAction->execute($accountDTO);
    }

    public function get(AccountRetrieveDTO $accountDTO): Account
    {
        return $this->getAccountAction->execute($accountDTO->user_id);
    }

    public function getBalance(AccountBalanceDTO $accountDTO): float
    {
        $account = $this->getAccountAction->execute($accountDTO->user_id);
        return $account->balance->available_balance;
    }
} 