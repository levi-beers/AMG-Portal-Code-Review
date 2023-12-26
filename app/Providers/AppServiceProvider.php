<?php

namespace AMGPortal\Providers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use AMGPortal\Repositories\Country\CountryRepository;
use AMGPortal\Repositories\Country\EloquentCountry;
use AMGPortal\Repositories\Permission\EloquentPermission;
use AMGPortal\Repositories\Permission\PermissionRepository;
use AMGPortal\Repositories\Role\EloquentRole;
use AMGPortal\Repositories\Role\RoleRepository;
use AMGPortal\Repositories\Session\DbSession;
use AMGPortal\Repositories\Session\SessionRepository;
use AMGPortal\Repositories\User\EloquentUser;
use AMGPortal\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
        config(['app.name' => setting('app_name')]);
        \Illuminate\Database\Schema\Builder::defaultStringLength(191);

        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Database\Factories\\'.class_basename($modelName).'Factory';
        });

        \Illuminate\Pagination\Paginator::useBootstrap();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepository::class, EloquentUser::class);
        $this->app->singleton(RoleRepository::class, EloquentRole::class);
        $this->app->singleton(PermissionRepository::class, EloquentPermission::class);
        $this->app->singleton(SessionRepository::class, DbSession::class);
        $this->app->singleton(CountryRepository::class, EloquentCountry::class);

        if ($this->app->environment('local')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
