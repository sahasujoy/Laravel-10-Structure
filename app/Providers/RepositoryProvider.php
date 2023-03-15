<?php

namespace App\Providers;

use App\Contracts\Repositories\AdminRepository;
use App\Contracts\Repositories\DefaultLimitRepository;
use App\Contracts\Repositories\GatewayProviderRepository;
use App\Contracts\Repositories\ResetPasswordRepository;
use App\Contracts\Repositories\UserBalanceLimitsRepository;
use App\Contracts\Repositories\UserRepository;
use App\Contracts\Repositories\TaskRepository;
use App\Contracts\Repositories\WebAppRepository;
use App\Repositories\AdminRepositoryEloquent;
use App\Repositories\DefaultLimitRepositoryEloquent;
use App\Repositories\GatewayProviderRepositoryEloquent;
use App\Repositories\ResetPasswordRepositoryEloquent;
use App\Repositories\UserBalanceLimitsRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use App\Repositories\TaskRepositoryEloquent;
use App\Repositories\WebAppRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(TaskRepository::class, TaskRepositoryEloquent::class);
        $this->app->bind(AdminRepository::class, AdminRepositoryEloquent::class);
        $this->app->bind(ResetPasswordRepository::class, ResetPasswordRepositoryEloquent::class);
        $this->app->bind(GatewayProviderRepository::class, GatewayProviderRepositoryEloquent::class);
        $this->app->bind(WebAppRepository::class, WebAppRepositoryEloquent::class);
        $this->app->bind(DefaultLimitRepository::class, DefaultLimitRepositoryEloquent::class);
        $this->app->bind(UserBalanceLimitsRepository::class, UserBalanceLimitsRepositoryEloquent::class);
        $this->app->bind(WebAppRepository::class, WebAppRepositoryEloquent::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
