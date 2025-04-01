<?php

namespace App\Providers;

use App\Contracts\Account\AccountServiceContract;
use App\Contracts\Repositories\AccountRepositoryContract;
use App\Repositories\AccountRepository;
use App\Services\AccountService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register Services
        $this->app->bind(AccountServiceContract::class, AccountService::class);

        // Register Repositories
        $this->app->bind(AccountRepositoryContract::class, AccountRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
