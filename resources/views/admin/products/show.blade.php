@extends('layouts.app')
@section('content')

    <div class="col-sm-offset-4 col-md-8">
        <br>
        <div class="panel panel-primary">
            <div class="panel-heading">Détail du produit:  {{ $product->code_produit }}
                <div class="float-right">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary btn-sm">Retour au Catalogue</a>
                </div>
            </div>
            <div class="panel-body">





            <h4> <p><b>code_produit :</b> {{ $product->code_produit }}</h4>
            <h4> <p><b>type :</b>{{ $product->type }}</h4>
            <h4> <p><b>designation :</b>{{ $product->designation }}</h4>
            <h4> <p><b>code_douanier :</b>{{ $product->code_douanier }}</h4>
            <h4> <p><b>longueur :</b>{{ $product->longueur }}</h4>
            <h4> <p><b>largeur :</b>{{ $product->largeur }}</h4>
            <h4> <p><b>hauteur :</b>{{ $product->hauteur }}</h4>
            <h4> <p><b>epaisseur :</b>{{ $product->epaisseur }}</h4>
            <h4> <p><b>poids :</b>{{ $product->poids }}</h4>
            <h4> <p><b>prix_uni :</b>{{ $product->prix_uni }}</h4>
            <h4> <p><b>fournissuer :</b>{{ $product->fournissuer }}</h4>
            <h4> <p><b>port_sortie :</b>{{ $product->port_sortie }}</h4>
            <h4> <p><b>code_douanier :</b>{{ $product->code_douanier }}</h4>
            <h4> <p><b>Enregistrement N° :</b>{{ $product->id }}</h4>
            <p>
                {{ $product->comment }}
            </p>
            <h2><img width=80% src="{{asset( $product->image )}}"></h2>
            </div>
        </div>
    </div>
@endsection