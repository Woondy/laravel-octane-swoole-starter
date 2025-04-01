<?php

namespace App\Contracts\Repositories;

use App\Models\Account\Account;
use Illuminate\Database\Eloquent\Collection;

/**
 * Contract for the AccountRepository.
 */
interface AccountRepositoryContract extends BaseRepositoryContract
{
    /**
     * Find account by account number
     *
     * @param string $accountNumber
     * @return Account|null
     */
    public function findByAccountNumber(string $accountNumber): ?Account;

    /**
     * Find accounts by user ID
     *
     * @param string $userId
     * @return Collection
     */
    public function findByUserId(string $userId): Collection;

    /**
     * Find active accounts
     *
     * @return Collection
     */
    public function findActive(): Collection;
} 