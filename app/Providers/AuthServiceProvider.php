<?php

namespace App\Providers;

use App\Models\Board;
use App\Models\Bug;
use App\Models\Column;
use App\Policies\BoardPolicy;
use App\Policies\BugPolicy;
use App\Policies\ColumnPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Column::class => ColumnPolicy::class,
        Bug::class => BugPolicy::class,
        Board::class => BoardPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
