@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <b>
                        <h3>
                            <div class="card-header">Création de produit
                                <div class="float-right">
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary ">Retour sur catalogue</a>
                                </div>
                            </div>
                        </h3>
                    </b>
                    <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <p>
                                        <strong>Input Error!</strong>
                                    </p>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                </div>

                                <div class="form-group {!! $errors->has('type') ? 'has-error' : '' !!}">
                                    {!! Form::label('type', 'Type du produit') !!}
                                    {!! Form::select('type', array('' => '-- Choisir le type --','Cuisine' => 'Cuisine', 'Dressing' => 'Dressing',
                                    'Domotique' => 'Domotique', 'Escalier et Rampes' => 'Escalier et Rampes', 'Equipements Hotel' => 'Equipements Hotel',
                                    'Fenetres' => 'Fenetres', 'Luminaires' => 'Luminaires', 'Mobilier salle de bains' => 'Mobilier salle de bains',
                                    'Mur Rideau' => 'Mur Rideau', 'Peinture' => 'Peinture', 'Portes' => 'Portes',
                                    'Revetement sol et murs' => 'Revetement sol et murs', 'Robinetterie' => 'Robinetterie', 'Sanitaires' => 'Sanitaires'),
                                    ['class' => 'form-control', 'placeholder' => '--Choisir le type du produit--'])!!}
                                    {!! $errors->first('type', '<small class="help-block">:message</small>')  !!}


                                <div class="form-group">
                                    <label for="code_produit">Code du produit</label>
                                    <input type="text" class="form-control" id="code_produit" name="code_produit" value="{{ old('code_produit') }}">
                                </div>
                                <div class="form-group">
                                    <label for="designation">Désignation</label>
                                    <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation') }}">
                                </div>
                                <div class="form-group {!! $errors->has('file') ? 'has-error' : '' !!}">
                                    {!! Form::label('file', 'Image du produit') !!}
                                    {!! Form::file('file', ['class' => 'form-control']) !!}
                                    {!! $errors->first('file', '<small class="help-block">:message</small>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="position">position</label>
                                    <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}">
                                </div>
                                <div class="form-group">
                                    <label for="couleur">couleur</label>
                                    <input type="text" class="form-control" id="couleur" name="couleur" value="{{ old('couleur') }}">
                                </div>



                                <div class="form-group">
                                    <label for="longueur">longueur</label>
                                    <input type="text" class="form-control" id="longueur" name="longueur" value="{{ old('longueur') }}">
                                </div>
                                <div class="form-group">
                                    <label for="largeur">largeur</label>
                                    <input type="text" class="form-control" id="largeur" name="largeur" value="{{ old('largeur') }}">
                                </div>
                                <div class="form-group">
                                    <label for="hauteur">hauteur</label>
                                    <input type="text" class="form-control" id="hauteur" name="hauteur" value="{{ old('hauteur') }}">
                                </div>
                                <div class="form-group">
                                    <label for="epaisseur">epaisseur</label>
                                    <input type="text" class="form-control" id="epaisseur" name="epaisseur" value="{{ old('epaisseur') }}">
                                </div>
                                <div class="form-group">
                                    <label for="poids">poids</label>
                                    <input type="text" class="form-control" id="poids" name="poids" value="{{ old('poids') }}">
                                </div>

                                <div class="form-group">
                                    <label for="prix_uni">prix_uni</label>
                                    <input class="form-control" id="prix_uni" name="prix_uni" value="{{ old('prix_uni') }}">
                                </div>
                                <div class="form-group">
                                    <label for="code_douanier">Code Douanier</label>
                                    <input class="form-control" id="code_douanier" name="code_douanier" value="{{ old('code_douanier') }}">
                                </div>
                                <div class="form-group">
                                    <label for="categorie">Catégorie</label>
                                    <input class="form-control" id="categorie" name="categorie" value="{{ old('categorie') }}">
                                </div>
                                <div class="form-group">
                                    <label for="port_sortie">Port de sortie</label>
                                    <input class="form-control" id="port_sortie" name="port_sortie" value="{{ old('port_sortie') }}">
                                </div>
                                <div class="form-group">
                                    <label for="fournisseur">Fournisseur</label>
                                    <input class="form-control" id="fournisseur" name="fournisseur" value="{{ old('fournisseur') }}">
                                </div>
                                <div class="form-group">
                                    <label for="comment">Commentaires</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="5">{{ old('comment') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Enregistrer</button>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
