<?php

use App\Enums\Account\AccountType;
use App\Enums\Account\AccountStatus;
use App\Enums\Currency\CurrencyCode;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->uuid('account_id')->primary();
            $table->uuid('user_id');
            $table->string('account_number', 20)->unique();
            $table->enum('type', AccountType::values());
            $table->enum('status', AccountStatus::values())->default(AccountStatus::ACTIVE);
            $table->enum('currency_code', CurrencyCode::values());
            $table->decimal('minimum_balance', 25, 7)->default(0);
            $table->decimal('overdraft_limit', 25, 7)->default(0);
            $table->decimal('interest_rate', 5, 2)->default(0);
            $table->timestamp('opened_at')->useCurrent();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'type', 'currency_code'], 'user_currency_wallet_unique');
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
