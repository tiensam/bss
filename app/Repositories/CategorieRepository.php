<?php

namespace App\Repositories;
use App\Categorie;
use DB;

class CategorieRepository extends ResourceRepository
{

    public function __construct(Categorie $categorie)
    {
        $this->model = $categorie;
    }

 }