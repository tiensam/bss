<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Categorie extends Model
{
    use Notifiable;

    protected $fillable = ['name', 'comment'];
}
