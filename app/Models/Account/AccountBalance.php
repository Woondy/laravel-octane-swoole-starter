<?php

namespace App\Models\Account;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccountBalance extends BaseModel
{
    protected $table = 'account_balances';
    protected $primaryKey = 'balance_id';

    protected $fillable = [
        'account_id',
        'available_balance',
        'ledger_balance',
        'hold_balance',
        'version'
    ];

    protected $casts = [
        'available_balance' => 'decimal:7',
        'ledger_balance' => 'decimal:7',
        'hold_balance' => 'decimal:7',
        'version' => 'integer',
        'as_of_time' => 'datetime'
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}