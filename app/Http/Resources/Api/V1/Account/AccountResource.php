<?php

namespace App\Http\Resources\Api\V1\Account;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Resource for representing an account.
 */
class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request The request instance
     * @return array<string, mixed> The transformed array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->account_id,
            'account_number' => $this->account_number,
            'type' => $this->type->value,
            'currency' => $this->currency_code->value,
            'balance' => [
                'available' => (float) $this->balance->available_balance,
                'ledger' => (float) $this->balance->ledger_balance,
                'hold' => (float) $this->balance->hold_balance,
            ],
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}