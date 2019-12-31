<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable($value = true);
            $table->string('type')->nullable($value = true);
            $table->string('designation')->nullable($value = true);
            $table->string('position')->nullable($value = true);
            $table->string('couleur')->nullable($value = true);
            $table->string('longueur')->nullable($value = true);
            $table->string('largeur')->nullable($value = true);
            $table->string('hauteur')->nullable($value = true);
            $table->string('epaisseur')->nullable($value = true);
            $table->string('poids')->nullable($value = true);
            $table->string('prix_uni')->nullable($value = true);
            $table->string('code_produit')->nullable($value = true);
            $table->string('code_douanier')->nullable($value = true);
            $table->string('categorie')->nullable($value = true);
            $table->string('port_sortie')->nullable($value = true);
            $table->string('fournisseur')->nullable($value = true);
            $table->string('image')->nullable($value = true);
            $table->text('comment')->nullable($value = true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}