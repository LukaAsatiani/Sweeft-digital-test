<?php

namespace Database\Seeders;

use Database\Seeders\ProductSeeder as SeedersProduct;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
  public function run(){
    $this->call([
      SeedersProduct::class
    ]);    
  }
}
