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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function($user){ //Cette gate s'appelle manage-users et verifie si l'utilisateur actuel possède le role admin ou auteur avant de le laisser poursuivre la gestion des utilisateurs
            return $user->hasAnyRoles(['admin', 'auteur']);
        });

        Gate::define('edit-users', function($user){ //Cette gate s'appelle edit-users et verifie si l'utilisateur actuel possède le role admin avant de le laisser poursuivre l'édition des utilisateurs
        return $user->hasAnyRoles(['admin','auteur']);
        });

        Gate::define('delete-users', function($user){ //Cette gate s'appelle edit-users et verifie si l'utilisateur actuel possède le role admin avant de le laisser poursuivre la supression des utilisateurs
            return $user->hasRole('admin');
        });

        Gate::define('create-users', function($user){ //Cette gate s'appelle edit-users et verifie si l'utilisateur actuel possède le role admin avant de le laisser poursuivre la supression des utilisateurs
            return $user->hasRole('admin');
        });

        Gate::define('delete-products', function($user){ //Cette gate s'appelle edit-users et verifie si l'utilisateur actuel possède le role admin avant de le laisser poursuivre la supression des utilisateurs
            return $user->hasRole('admin');
        });

        Gate::define('create-products', function($user){ //Cette gate s'appelle edit-users et verifie si l'utilisateur actuel possède le role admin avant de le laisser poursuivre la supression des utilisateurs
            return $user->hasAnyRoles(['admin', 'auteur']);
        });
        Gate::define('manage-products', function($user){ //Cette gate s'appelle manage-users et verifie si l'utilisateur actuel possède le role admin ou auteur avant de le laisser poursuivre la gestion des utilisateurs
            return $user->hasAnyRoles(['admin', 'auteur']);
        });


        //
    }
}
