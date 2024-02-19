<?php

namespace App\Providers;

use App\Models\JobApplication;
use App\Policies\JobApplicationPolicy;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    protected $policies = [
        JobApplication::class => JobApplicationPolicy::class,
    ];
}
