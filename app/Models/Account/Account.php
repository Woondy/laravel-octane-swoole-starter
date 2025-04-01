<?php

namespace App\Models\Account;

use App\Enums\Account\AccountStatus;
use App\Enums\Account\AccountType;
use App\Enums\Currency\CurrencyCode;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Account extends BaseModel
{
    use HasFactory;

    protected $table = 'accounts';
    protected $primaryKey = 'account_id';

    protected $fillable = [
        'user_id',
        'account_number',
        'type',
        'status',
        'currency_code',
        'minimum_balance',
        'overdraft_limit',
        'interest_rate'
    ];

    protected $casts = [
        'type' => AccountType::class,
        'status' => AccountStatus::class,
        'currency_code' => CurrencyCode::class,
        'minimum_balance' => 'decimal:7',
        'overdraft_limit' => 'decimal:7',
        'interest_rate' => 'decimal:2',
        'opened_at' => 'datetime',
        'closed_at' => 'datetime'
    ];

    public function balance(): HasOne
    {
        return $this->hasOne(AccountBalance::class, 'account_id', 'account_id');
    }
}