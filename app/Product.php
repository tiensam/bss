<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use Notifiable;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'products.id'    => 10,
            'products.name'  => 10,
            'products.type'   => 10,
            'products.code_produit'   => 10,
            'products.code_douanier'    => 10,
            'products.designation'  => 10,
            'products.position'   => 10,
            'products.couleur'    => 10,
            'products.longueur'  => 10,
            'products.largeur'   => 10,
            'products.epaisseur'   => 10,
            'products.poids'    => 10,
            'products.prix_uni'  => 10,
            'products.categorie'   => 10,
            'products.port_sortie'    => 10,
            'products.fournisseur'    => 10,
            'products.image'    => 10,
            'products.comment'    => 10,
        ]
    ];
    protected $fillable = [
        'name','type', 'code_produit', 'code_douanier', 'designation','position', 'couleur', 'longueur' , 'largeur',
        'hauteur', 'epaisseur', 'poids', 'prix_uni', 'categorie','port_sortie','fournisseur', 'image','comment'

    ];


}
