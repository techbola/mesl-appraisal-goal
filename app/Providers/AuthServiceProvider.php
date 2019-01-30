<?php

namespace MESL\Providers;

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
        'MESL\Model' => 'MESL\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Edit Documents
        Gate::define('edit-doc', function ($user, $doc) {
          return ( $user->id == $doc->Initiator || in_array($user->staff->StaffRef, $doc->assignees->pluck('StaffID')->toArray()) );
        });

        // Only Sender & Recipients
        Gate::define('view-message', function ($user, $message) {
          return ( $user->id == $message->FromID || in_array($user->id, $message->recipients->pluck('id')->toArray()) );
        });

        Gate::define('manage-bulletins', function ($user) {
          return ( $user->hasRole('Corporate Communications Officer') || $user->staff->DepartmentID == '16' || $user->hasRole('admin') );
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
          return ($user->hasRole('admin') || $user->is_superadmin);
        });
        // HR admins
        Gate::define('hr-admin', function ($user) {
          return ($user->hasRole('admin') || $user->hasRole('hr admin') || $user->is_superadmin);
        });

        // Task owner (assignee)
        Gate::define('task-owner', function ($user, $task) {
          return ($user->staff->StaffRef == $task->StaffID || $user->staff->StaffRef == $task->project->SupervisorID);
        });

        // Project supervisor & company admins
        Gate::define('project-supervisor', function ($user, $project) {
          return ($user->staff->StaffRef == $project->SupervisorID || $user->hasRole('admin'));
        });

        Gate::define('see-contact', function ($user, $contact) {
          return ($user->id == $contact->InputterID || in_array($user->id, explode(',', $contact->Attendees)) || $user->hasRole('admin') || $user->hasRole('exco'));
        });

        // Company admins
        Gate::define('edit-company', function ($user, $company) {
          return ($user->is_superadmin || $company->CompanyRef == $user->CompanyID);
        });
        // Company admins
        Gate::define('edit-profile', function ($user, $profile_user) {
          return ($user->is_superadmin || $user->hasRole('admin') || $user->hasRole('hr admin') || $user->id == $profile_user->id);
        });
    }
}
