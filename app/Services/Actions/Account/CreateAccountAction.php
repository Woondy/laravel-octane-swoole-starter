<?php

namespace App\Services\Actions\Account;

use App\Contracts\Repositories\AccountRepositoryContract;
use App\DTOs\Account\AccountCreateDTO;
use App\Events\Account\AccountCreated;
use App\Exceptions\Account\AccountAlreadyExistsException;
use App\Models\Account\Account;
use App\Services\Generators\Account\AccountNumberGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

/**
 * Action class for creating a new account.
 * 
 * This class handles the business logic for creating a new account,
 * including balance initialization and event dispatching.
 */
class CreateAccountAction
{
    /**
     * Create a new account creation action instance.
     *
     * @param AccountNumberGenerator $numberGenerator
     * @param AccountRepositoryContract $accountRepository
     */
    public function __construct(
        private readonly AccountNumberGenerator $numberGenerator,
        private readonly AccountRepositoryContract $accountRepository
    ) {}

    /**
     * Execute the account creation action.
     *
     * @param AccountCreateDTO $accountDTO
     * @return Account
     * @throws AccountAlreadyExistsException
     * @throws QueryException
     */
    public function execute(AccountCreateDTO $accountDTO): Account
    {
        try {
            return DB::transaction(function () use ($accountDTO): Account {
                $account = $this->accountRepository->create([
                    'user_id' => $accountDTO->user_id,
                    'account_number' => $this->numberGenerator->generate(),
                    'type' => $accountDTO->type,
                    'currency_code' => $accountDTO->currency_code,
                    'minimum_balance' => $accountDTO->minimum_balance,
                    'overdraft_limit' => $accountDTO->overdraft_limit,
                    'interest_rate' => $accountDTO->interest_rate,
                    'opened_at' => now(),
                ]);

                $account->balance()->create([
                    'available_balance' => 0.0,
                    'ledger_balance' => 0.0,
                    'hold_balance' => 0.0,
                    'version' => 1,
                ]);

                AccountCreated::dispatch($account);

                return $account;
            });
        } catch (QueryException $e) {
            if ($this->isDuplicateAccountError($e)) {
                Log::warning('Duplicate account creation attempt', [
                    'user_id' => $accountDTO->user_id,
                    'type' => $accountDTO->type,
                    'currency_code' => $accountDTO->currency_code,
                ]);

                throw new AccountAlreadyExistsException(
                    $accountDTO->user_id,
                    $accountDTO->type,
                    $accountDTO->currency_code
                );
            }
            throw $e;
        }
    }

    /**
     * Check if the query exception is due to a duplicate account.
     *
     * @param QueryException $e
     * @return bool
     */
    private function isDuplicateAccountError(QueryException $e): bool
    {
        return $e->getCode() === '23000' 
            && str_contains($e->getMessage(), 'UNIQUE constraint failed: accounts.user_id, accounts.type, accounts.currency_code');
    }
} 