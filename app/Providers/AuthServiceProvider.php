<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Report;
use App\Models\ReportFile;
use App\Models\Role;
use App\Policies\OrderPolicy;
use App\Policies\ProductPolicy;
use App\Policies\ReportFilePolicy;
use App\Policies\ReportPolicy;
use App\Policies\RolePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Product::class => ProductPolicy::class,
        Order::class => OrderPolicy::class,
        Report::class => ReportPolicy::class,
        ReportFile::class => ReportFilePolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
