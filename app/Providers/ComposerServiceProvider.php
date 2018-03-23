<?php

namespace App\Providers;

use App\Helpers\UserDataHelper;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $views = ['basic.pages.logged'];
        View::composer($views, function ($view) {
            $data = UserDataHelper::getUserSharedData(false);
            $key = config('settings.key');
            View::share($key, $data);
        });

        $views = ['basic.parts.tables-scripts'];
        View::composer($views, function ($view) {
            $data = UserDataHelper::getUserSharedData(false);
            $key = config('settings.key');
            View::share('user_grid_settings', $data['user_settings']);
            View::share('rows_per_page_options', $data['rows_per_page_options']);
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
