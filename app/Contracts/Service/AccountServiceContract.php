<?php

namespace App\Contracts\Service;

use App\DTOs\Account\AccountCreateDTO;
use App\DTOs\Account\AccountRetrieveDTO;
use App\DTOs\Account\AccountBalanceDTO;
use App\Models\Account\Account;

/**
 * Contract for the AccountService.
 */
interface AccountServiceContract
{
    /**
     * Create a new account
     *
     * @param AccountCreateDTO $accountDTO
     * @return Account
     */
    public function create(AccountCreateDTO $accountDTO): Account;

    /**
     * Get an account by ID
     *
     * @param AccountRetrieveDTO $accountDTO
     * @return Account
     */
    public function get(AccountRetrieveDTO $accountDTO): Account;

    /**
     * Get account balance
     *
     * @param AccountBalanceDTO $accountDTO
     * @return float
     */
    public function getBalance(AccountBalanceDTO $accountDTO): float;
} 