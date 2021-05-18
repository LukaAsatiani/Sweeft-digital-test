<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {
  private $prefix = 'products';
  private $supported_currencies = ['GEL', 'EUR', 'USD'];
  
  public function index(){
    $products = Product::all();
    $count = count($products);

    if($count === 0)
      return $this->respondWithMessage($this->prefix.'.get.empty');

    return $this->respond($products, $this->prefix.'.get.success');
  }

  public function store(Request $req){
    $validator = Validator::make($req->all(), [
      'title' => 'required|min:2|max:64',
      'description' => 'max:256',
      'price' => 'required|numeric|min:0.01|max:100000|regex:/^\d+(\.\d{1,2})?$/',
      'currency' => 'required|in:' . implode(',', $this->supported_currencies)
    ]);

    if ($validator->fails()) {
      return $this->respondWithValidationError($validator->errors()->messages(), 422);
    }

    $fields = $req->only(['title', 'description', 'price', 'currency']);
    
    if(!isset($fields['description']))
      $fields['description'] = '';

    $product = Product::create($fields);
    $product->save();

    return $this->respond($product, $this->prefix.'.create.success');
  }

  public function update(Request $req, $id){
    $validator = Validator::make($req->all(), [
      'title' => 'min:2|max:64',
      'description' => 'max:256',
      'price' => 'numeric|min:0.01|max:100000|regex:/^\d+(\.\d{1,2})?$/',
      'currency' => 'in:' . implode(',', $this->supported_currencies)
    ]);

    if ($validator->fails()) {
      return $this->respondWithValidationError($validator->errors()->messages(), 422);
    }
    
    $product = Product::find($id);
    
    if(!$product)
      return $this->respondWithMessage($this->prefix.'.find.error', 404, false);

    $fields = $req->only(['title', 'description', 'price', 'currency']);
    $product->fill($fields);

    if($product->isDirty()){
      $product->save();
      return $this->respond($product, $this->prefix.'.update.success');
    }

    return $this->respondWithMessage($this->prefix.'.update.same', 200, false);
  }

  public function destroy(Request $req, $id){
    $product = Product::find($id);

    if(!$product)
      return $this->respondWithMessage($this->prefix.'.find.error', 404, false);

    $product->delete();
    return $this->respondWithMessage($this->prefix.'.delete.success');
  }
}
