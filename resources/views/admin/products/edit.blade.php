@extends('layouts.app')
@section('content')

     <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <b> <h3><div class="card-header">Edition de produit</div></h3></b>

                        <div class="card-body">

    <div class="card">
        <div class="card-header">
            <div class="float-right">
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-sm">Retour sur Catalogue</a>
            </div>
            <h4>Produit en cours de modification : &nbsp <b><span style="color:#ff0311">{{$product->name }} </span></b></h4>
        </div>
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

            <form action="{{ route('admin.products.update',$product->id) }}" method="POST">
                @csrf @method('PUT')
                <table class="table table-hover">


                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$product->name }}">
                    </div>
                    <div class="form-group">
                        <div class="form-group {!! $errors->has('type') ? 'has-error' : '' !!}">
                            {!! Form::Label('type', 'Type:') !!}
                            {!! Form::select('type',$categorie, $product->type, ['class' => 'form-control', 'placeholder' => $selectedcategorie ]) !!}
                            {!! $errors->first('type', '<small class="help-block">:message</small>') !!}
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="code_produit">Code du produit</label>
                        <input type="text" class="form-control" id="code_produit" name="code_produit" value="{{ $product->code_produit}}">
                    </div>
                    <div class="form-group">
                        <label for="designation">designation</label>
                        <input type="text" class="form-control" id="designation" name="designation" value="{{$product->designation }}">
                    </div>
                    <div class="form-group">
                        <label for="image">image</label>
                        <img width=50% src="{{asset( $product->image )}}">

                        <div class="form-group {!! $errors->has('file') ? 'has-error' : '' !!}">
                            {!! Form::label('file', 'Changer l\'image du produit') !!}
                            {!! Form::file('file', ['class' => 'form-control']) !!}
                            {!! $errors->first('file', '<small class="help-block">:message</small>') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="position">position</label>
                        <input type="text" class="form-control" id="position" name="position" value="{{$product->position}}">
                    </div>
                    <div class="form-group">
                        <label for="couleur">couleur</label>
                        <input type="text" class="form-control" id="couleur" name="couleur" value="{{ $product->couleur }}">
                    </div>
                    <div class="form-group">
                        <label for="longueur">longueur</label>
                        <input type="text" class="form-control" id="longueur" name="longueur" value="{{ $product->longueur }}">
                    </div>
                    <div class="form-group">
                        <label for="largeur">largeur</label>
                        <input type="text" class="form-control" id="largeur" name="largeur" value="{{ $product->largeur }}">
                    </div>
                    <div class="form-group">
                        <label for="hauteur">hauteur</label>
                        <input type="text" class="form-control" id="hauteur" name="hauteur" value="{{ $product->hauteur }}">
                    </div>
                    <div class="form-group">
                        <label for="epaisseur">epaisseur</label>
                        <input type="text" class="form-control" id="epaisseur" name="epaisseur" value="{{ $product->epaisseur }}">
                    </div>
                    <div class="form-group">
                        <label for="poids">poids</label>
                        <input type="text" class="form-control" id="poids" name="poids" value="{{ $product->poids }}">
                    </div>

                    <div class="form-group">
                        <label for="prix_uni">prix_uni</label>
                        <input class="form-control" id="prix_uni" name="prix_uni" value="{{ $product->prix_uni }}">
                    </div>
                    <div class="form-group">
                        <label for="code_douanier">code_douanier</label>
                        <input class="form-control" id="code_douanier" name="code_douanier" value="{{ $product->code_douanier }}">
                    </div>
                    <div class="form-group">
                        <label for="categorie">categorie</label>
                        <input class="form-control" id="categorie" name="categorie" value="{{ $product->categorie }}">
                    </div>
                    <div class="form-group">
                        <label for="port_sortie">port_sortie</label>
                        <input class="form-control" id="port_sortie" name="port_sortie" value="{{ $product->port_sortie }}">
                    </div>
                    <div class="form-group">
                        <label for="fournisseur">fournisseur</label>
                        <input class="form-control" id="fournisseur" name="fournisseur" value="{{ $product->fournisseur }}">
                    </div>
                    <div class="form-group">
                        <label for="comment">comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="5">{{ $product->comment }}</textarea>
                    </div>

                <button type="submit" class="btn btn-primary">Mettre a jour</button>
                </table>
            </form>
        </div>
    </div>
@endsection