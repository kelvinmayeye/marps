<?php

namespace App\Providers;

use App\Models\Admin\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
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
    }
}
