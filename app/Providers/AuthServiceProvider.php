<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
        //here i am registering the policis and which model is it refering to like:
        //Post::class => PostPolicy::class
        //but i don't need to do that as long as i am following the convention PostPolicy or UserPolicy
        //like that laravel will find it automatically if i mentain naming the policy like that so i don't have to register
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
