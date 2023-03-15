<?php

namespace App\Providers;


use App\Contracts\Services\AdminContract;
use App\Contracts\Services\AdminDashboardContract;
use App\Contracts\Services\AdminSettingContract;
use App\Contracts\Services\UserBalanceLimitContract;
use App\Contracts\Services\UserContract;
use App\Contracts\Services\TaskContract;
use App\Contracts\Services\UserDashboardContract;
use App\Contracts\Services\WebAppContract;
use App\Services\AdminDashboardService;
use App\Services\AdminService;
use App\Services\AdminSettingService;
use App\Services\UserBalanceLimitService;
use App\Services\UserDashboardService;
use App\Services\UserService;
use App\Services\TaskService;
use App\Services\WebAppService;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserContract::class, UserService::class);
        $this->app->bind(TaskContract::class, TaskService::class);
        $this->app->bind(AdminContract::class, AdminService::class);
        $this->app->bind(UserBalanceLimitContract::class, UserBalanceLimitService::class);
        $this->app->bind(WebAppContract::class, WebAppService::class);
        $this->app->bind(AdminDashboardContract::class, AdminDashboardService::class);
        $this->app->bind(WebAppContract::class, WebAppService::class);
        $this->app->bind(AdminSettingContract::class, AdminSettingService::class);
        $this->app->bind(UserDashboardContract::class, UserDashboardService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') != 'local') {
            $this->app['request']->server->set('HTTPS', true);
        }

        DB::whenQueryingForLongerThan(env('WHEN_QUERY_FOR_LONGER_THEN_MILLI_SECOND'), function (Connection $connection) {
            Log::warning("Database queries exceeded 5 seconds on {$connection->getName()}");

            // or notify the development team...
        });
    }
}
