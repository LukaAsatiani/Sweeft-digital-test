<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration{
  public function up(){
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->text('description');
      $table->float('price')->unsigned();
      $table->string('currency')->default('GEL');
      $table->timestamps();
    });
  }

  public function down(){
    Schema::dropIfExists('products');
  }
}
