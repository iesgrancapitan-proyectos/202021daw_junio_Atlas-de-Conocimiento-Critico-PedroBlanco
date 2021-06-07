<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

use App\Models\User;


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

        // Modificado de https://stackoverflow.com/questions/31204093/laravel-registration-register-only-users-that-own-an-email-from-a-specific-doma
        Validator::extend('allowed_domain', function($attribute, $value, $parameters, $validator) {
            return in_array(explode('@', $value)[1], config('misc.valid_register_domains'));
        }, __('messages.invalid_register_domain') );

        Gate::define( 'admin-users', function (User $user) {
            // Se podría hacer un str_contains( $user->role()->first()->nombre, 'Administrador' ), pero no me gusta la idea
            // return ( null !== $user->role()->first() )
            //     && ( ( $user->role()->first()->nombre == 'SuperAdministrador' )
            //             || ( $user->role()->first()->nombre == 'Administrador' ) );
            return in_array ( $user->role()->first()->nombre, ['SuperAdministrador', 'Administrador'], true );
        });

        Gate::define( 'show-users', function (User $user) {
            // Se podría hacer un str_contains( $user->role()->first()->nombre, 'Administrador' ), pero no me gusta la idea
            return ( null !== $user->role()->first() );
        });
    }
}
