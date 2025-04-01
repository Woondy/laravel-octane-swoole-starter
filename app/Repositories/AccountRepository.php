<?php

namespace App\Repositories;

use App\Contracts\Repositories\AccountRepositoryContract;
use App\Models\Account\Account;
use App\Enums\Account\AccountStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AccountRepository extends BaseRepository implements AccountRepositoryContract
{
    /**
     * AccountRepository constructor.
     *
     * @param Account $model
     */
    public function __construct(Account $model)
    {
        parent::__construct($model);
    }

    /**
     * Find account by account number
     *
     * @param string $accountNumber
     * @return Account|null
     */
    public function findByAccountNumber(string $accountNumber): ?Account
    {
        return $this->model->where('account_number', $accountNumber)->first();
    }

    /**
     * Find accounts by user ID
     *
     * @param string $userId
     * @return Collection
     */
    public function findByUserId(string $userId): Collection
    {
        return $this->model->where('user_id', $userId)->get();
    }

    /**
     * Find an account by user ID or throw an exception if not found.
     *
     * @param string $userId The ID of the user to find account for
     * @return Account
     * @throws ModelNotFoundException
     */
    public function findByUserIdOrFail(string $userId): Account
    {
        return $this->model->where('user_id', $userId)->firstOrFail();
    }

    /**
     * Find active accounts
     *
     * @return Collection
     */
    public function findActive(): Collection
    {
        return $this->model->where('status', AccountStatus::ACTIVE)->get();
    }
} 