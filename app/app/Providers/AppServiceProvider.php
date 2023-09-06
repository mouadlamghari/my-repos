<?php

namespace App\Providers;

use App\Models\Employe;
use App\Models\Consultation;
use Spatie\Permission\Models\Role;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Observers\ConsultationObserver;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;

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


        Consultation::observe(ConsultationObserver::class);
        Paginator::useBootstrap();
    }
}
