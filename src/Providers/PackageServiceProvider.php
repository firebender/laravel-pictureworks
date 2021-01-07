<?php

namespace FireBender\Laravel\PictureWorks\Providers;

use Illuminate\Support\ServiceProvider;
use FireBender\Laravel\PictureWorks\Services\UserService;
use FireBender\Laravel\PictureWorks\Console\Commands\GetUserCommand;
use FireBender\Laravel\PictureWorks\Console\Commands\AddUserCommand;
use FireBender\Laravel\PictureWorks\Console\Commands\ModifyUserCommand;
use FireBender\Laravel\PictureWorks\Console\Commands\GetUsersCommand;
use FireBender\Laravel\PictureWorks\Console\Commands\SeedUsersCommand;
use FireBender\Laravel\PictureWorks\Console\Commands\ModifyCommentsCommand;
use FireBender\Laravel\PictureWorks\Console\Commands\JsonHelperCommand;

class PackageServiceProvider extends ServiceProvider

{
    /**
     * 
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../../routes/users.php');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'users');        
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        if ($this->app->runningInConsole()) 
        {
            $this->commands([
                GetUserCommand::class,
                AddUserCommand::class,
                ModifyUserCommand::class,
                GetUsersCommand::class,
                SeedUsersCommand::class,
                ModifyCommentsCommand::class,
                JsonHelperCommand::class,
            ]);
        }

    }

    /**
     * 
     */
    public function register()
    {
        $this->app->singleton(UserService::class, function ($app) {
            return new UserService();
        });
    }

}
