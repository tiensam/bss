<?php

namespace App\Repositories;
use App\Product;
use DB;

/**
 * Class TaxifeeRepository.
 */
class ProductRepository extends ResourceRepository
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }


    public function getcategories()
    {
        return DB::table('categories')->pluck('name','id');
    }
/*
    public function getmetier()
    {
        return DB::table('metiers')->pluck('nommetier','id');
    }

    public function getcustomer()
    {
        return DB::table('customers')->pluck('abrvclient','id');
    }*/
}
