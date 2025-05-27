<?php

namespace App\Providers;

use App\Models\Admin\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!App::runningInConsole()) {
            //settings
            if (Schema::hasTable('settings')) {
                foreach (Setting::all() as $setting) {
                    Config::set('setting.' . $setting->key, $setting->value);
                }
            }
        }

        // Share permissions with all views
        View::composer('*', function ($view) {
            $user = Auth::user();
            $permissions = $user && $user->role
                ? rolesPermissionGrouped($user->role->id)
                : [];
            $view->with('groupedPermissions', $permissions);
        });
    }
}
