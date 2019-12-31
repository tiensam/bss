<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Gate;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;

class UsersController extends Controller
{
    //la fonction __construct permet de s'assurer que l'utilisateur qui a access a ce controller est bien authentifié
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->UserRepository = $userRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index')->with ('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {

        //$input = $request->all();
        $user = $this->userRepository;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;


        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
                //dd($user);
        if(Gate::denies('edit-users')){
            return redirect(route('admin.users.index'));
        }
        $roles = Role::all();
        return view('admin.users.edit')->with([
            'user'=> $user,
            'roles'=> $roles //renvoie une erreur si on oublie le s du role's'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)//le $user a été collecté depuis le formulaire d'édiion dans l'action du formulaire
    {
        //dd($request);
        //pour le user collecté depuis le user.edit on utilise la méthode ou fonction roles() déclaré dans le model User disant qu'utilisateur peux avoir plusieur role
        $user->roles()->sync($request->roles);  // La méthode sync est la méthode attach appliquée à un tableau ( array). Nous avons utiliser attch dans le seeder.
                                                // Il synchronise tous les rolesque l'utilisateur a choisi dan le formulaire d'édition au roles de l'utilisateur édité.
        $user->name = $request->name;
        $user->email = $request->email;
        if($user->save()) {
        $request->session()->flash('success', $user->name.' a été modifié avec succès');
        } else{
        $request->session()->flash('success', 'Erreur survenue lors de la modification de l\'utilisateur' . $user->name );
        }
        return redirect()->route('admin.users.index'); // Redirige vers la section sur la vue index des utilisateurs
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //dd($user);
        if(Gate::denies('delete-users')){ //cette gate verifie si l'utilisateur actuel est admin avant de lui donner accès à la supression
            return redirect(route('admin.users.index'));
        }
        // Avant de supprimer l'utilisateur, il faut détacher les relation de cet utilisateur avec les roles dans la table role_user par la méthode detach
        //qui annule la methode atach de cet utilisaateur dans la fonction roles() du Usercontroller.
        $user->roles()->detach();
        $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec success!');

    }



}
