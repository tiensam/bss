<?php

use Illuminate\Database\Seeder;
use App\User;
use \App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();//permet de vider la table
        DB::table('role_user')->truncate();//permet de viser les element relatif dans la table role_user

        $admin = User::create(['name'=>'admin', // la variable admin recois l'entité créer par la méthode create. Il s'agit de l'instance du model User
                      'email'=>'admin@admin.com',
                      'password'=> Hash::make('password')
                    ]);
        $auteur = User::create(['name'=>'auteur',
            'email'=>'auteur@auteur.com',
            'password'=> Hash::make('password')
                    ]);
        $utilisateur = User::create(['name'=>'utilisateur',
            'email'=>'utilisateur@utilisateur.com',
            'password'=> Hash::make('password')
        ]);

        $adminRole = Role::where('name','admin')->first();//la variable $admin recois le premier enregistrement du role ou le name est admin
        $auteurRole = Role::where('name','auteur')->first();
        $utilisateurRole = Role::where('name','utilisateur')->first();

        $admin->roles()->attach($adminRole);// Permet d'attacher $admin au role adminRole par la fonction roles présente dans le mode User histoire de créer la relation dans la table pivot liant les utilisateurs et les roles
        $auteur->roles()->attach($auteurRole);
        $utilisateur->roles()->attach($utilisateurRole);





    }
}
