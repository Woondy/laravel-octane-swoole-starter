<?php

namespace App\Events\Account;

use App\Models\Account\Account;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

/**
 * Event class for when an account is created.
 */
class AccountCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param Account $account The account that was created
     */
    public function __construct(
        public Account $account
    ) {
        Log::info('Account created', ['account' => $this->account]);
    }
}