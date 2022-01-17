<?php

namespace App\Providers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->defineUserRoleGate('isSuperadmin', UserRole::SUPERADMIN);
        $this->defineUserRoleGate('isAdmin', UserRole::ADMIN);
        $this->defineUserRoleGate('isModerator', UserRole::MODERATOR);
        $this->defineUserRoleGate('isUser', UserRole::USER);
        $this->defineUserRoleGate('isObserver', UserRole::OBSERVER);
    }
        private function defineUserRoleGate(string $name, string $role):void
        {
            Gate::define($name,function (User $user) use ($role){
                return $user->role ==$role;
        });
    }
}
