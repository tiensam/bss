@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liste des utilisateurs</div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Habilitations</th>
                                <th scope="col">Actions</th>
                                <th scope="col"></th>
                                <th scope="col"></th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <!--{//{$user->name}} - {//{$user->email}} affiche le nom et le prenom de chaque élément trouvé dans la table user-->
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{implode(',',$user->roles()->get()->pluck('name')->toArray())}}</td><!-- Dans le model User appelle la fonction méthode roles et pla
                                                le nom du role ou le user_id = id de l'utilisateur stocké dans la variable $user pas dans la variable session.-->
                                    <!--<td>
                                        <a href="{{route('admin.users.show', $user->id)}}"><button class="btn btn-success float-left">Voir</button> </a>
                                    </td>-->
                                    <td>
                                        @can('edit-users')<!-- Activation de la gate edit-usres-->
                                        <a href="{{route('admin.users.edit', $user->id)}}"><button class="btn btn-warning float-left">Editer</button> </a>
                                        @endcan
                                    </td>
                                    <td>
                                        @can('delete-users')<!-- Activation de la gate delete-usres -->
                                            <form action="{{route('admin.users.destroy',$user)}}" method="POST">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur?')" class="btn btn-danger float-right">Supprimer</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            @can('create-users')
                            <a href="{{route('admin.users.create')}}"><button class="btn btn-primary float-left">Créer un utilisateur</button> </a>
                            @endcan
                            </tbody>

                        </table>
                        @can('create-users')
                        <a href="{{route('admin.users.create')}}"><button class="btn btn-primary float-left">Créer un utilisateur</button> </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection