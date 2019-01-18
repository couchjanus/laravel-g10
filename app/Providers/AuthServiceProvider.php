<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Post;
use App\Policies\PostPolicy;
use App\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define(
            'update-post',
            function ($user, $post) {
                return $user->id == $post->user_id;
            }
        );

        Gate::define('super-admin', function ($user) {
            if($user->is_admin)
            {
                return true;
            }
            return false;
        });

        Gate::define(
            'is-admin', function ($user) {
                foreach ($user->roles as $role) {
                    if ($role->name == 'admin') {
                        return true;
                    }
                }
            }
        );

        Gate::define(
            'add-post', function ($user) {
                foreach ($user->roles as $role) {
                    if ($role->name == 'writer') return true;
                }
                return false;
            }
        );

        // foreach ($this->getPermissions() as $permission) {
        //     Gate::define(
        //         $permission->slug, 
        //         function ($user) use ($permission) {
        //             return $user->hasRole($permission->roles);
        //         }
        //     );
        // }
 
    }

    private function getPermissions()
    {
        return Permission::all();
    }
}
