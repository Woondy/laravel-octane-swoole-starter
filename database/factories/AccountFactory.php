<?php

namespace Database\Factories;

use App\Domain\Enums\AccountType;
use App\Enums\Account\AccountStatus;
use App\Enums\Currency\CurrencyCode;
use App\Domain\Account\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => Uuid::uuid4(),
            'account_number' => '1000' . $this->faker->unique()->numerify('########'),
            'type' => $this->faker->randomElement(AccountType::cases()),
            'status' => $this->faker->randomElement(AccountStatus::cases()),
            'currency_code' => $this->faker->randomElement(CurrencyCode::values()),
            'minimum_balance' => 0,
            'overdraft_limit' => 0,
            'interest_rate' => 0
        ];
    }
}
