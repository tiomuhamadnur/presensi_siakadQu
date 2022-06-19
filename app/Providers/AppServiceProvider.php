<?php

namespace App\Providers;

use App\Models\Sactum\PersonalAccessToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Carbon::setLocale('id');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        Carbon::setLocale('id');
        Schema::defaultStringLength(191);
        date_default_timezone_set('Asia/Jakarta');
    }
}
