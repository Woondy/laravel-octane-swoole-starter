<?php

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
        Schema::create('account_balances', function (Blueprint $table) {
            $table->uuid('balance_id')->primary();
            $table->uuid('account_id')->unique();
            $table->decimal('available_balance', 25, 7)->default(0);
            $table->decimal('ledger_balance', 25, 7)->default(0);
            $table->decimal('hold_balance', 25, 7)->default(0);
            $table->timestamp('as_of_time')->useCurrent();
            $table->unsignedBigInteger('version')->default(1);
            $table->timestamps();

            $table->foreign('account_id')
                  ->references('account_id')
                  ->on('accounts')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_balances');
    }
};
