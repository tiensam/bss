<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Full_text_search extends Model
{
    use Notifiable;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'full_text_searches.CustomerName'  => 10,
            'full_text_searches.Gender'   => 10,
            'full_text_searches.Address'   => 10,
            'full_text_searches.City'    => 10,
            'full_text_searches.PostalCode'  => 10,
            'full_text_searches.Country'   => 10,
            'full_text_searches.id'    => 10,
        ]
    ];

    protected $fillable = [
        'CustomerName', 'Gender', 'Address', 'City', 'PostalCode', 'Country',
    ];
}