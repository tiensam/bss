@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edition d'utilisateurs {{$user->name}} </div>

                    <div class="card-body">
                        <form action="{{route('admin.users.update', $user)}}" method="POST"><!-- on prend les infos de l'utilisateur stocké dans
                        la variable $user pour l'envoyer dans la fonction update du Usercontroller-->

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="email" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <!--Partie des checkbox des roles-->

                            @csrf <!-- On passe notre token CSRF-->
                            {{method_field('PUT')}} <!-- La methode admin.users.update attend une methode put et non post! Nous avons donc utilisé la methode
                                 method_field pour remédier a cela. Ainsi notre methode 'POST' sera reconnu comme un 'PUT'-->
                            <div class="form-group row">
                                <label for="roles" class="col-md-2 col-form-label text-md-right">Roles</label>
                                <div class="col-md-6">
                                    @foreach($roles as $role) <!-- Assignation des roles. Pour passer les roles dans la vue sous forme de checkbox-->
                                        <div class="form-check">
                                            <input type="checkbox" name="roles[]" value="{{$role->id}}"
                                            @if($user->roles->pluck('id')->contains($role->id)) checked @endif> <!--le name est de type array car plusieurs roles sont assignable. On recupere également ldans la table roles l'id des roles que l'utilisateur possède et on coche les correspondant dans le formulaire-->
                                            <label> {{$role->name}} </label>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                                    <button class="btn btn-primary">Mettre à jour</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
