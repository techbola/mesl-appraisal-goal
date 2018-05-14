<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Only Sender & Recipients
        Gate::define('view-message', function ($user, $message) {
          return ( $user->id == $message->FromID || in_array($user->id, $message->recipients->pluck('id')->toArray()) );
        });

        // Only Creator and Admin
        Gate::define('edit-event', function ($user, $event) {
          return ( $user->id == $event->Initiator || ($user->staff->CompanyID == $event->CompanyID && in_array('admin', $user->roles->pluck('name')->toArray())) );
        });

        // Super admins
        Gate::define('superadmin', function ($user) {
          return $user->is_superadmin;
        });

        // Company admins
        Gate::define('company-admin', function ($user) {
          return $user->hasRole('admin');
        });
    }
}
