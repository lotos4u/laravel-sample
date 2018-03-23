<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        Blade::directive('is_permitted_any', function ($expression) {
            return "<?php if (UserDataHelper::userCanAny({$expression})):  //UserDataHelper::userCanAny?>";

        });

        Blade::directive('end_is_permitted_any', function ($expression) {
            return "<?php endif; // UserDataHelper::userCanAny ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
