<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        return ProductsResource::collection(Product::paginate());
    }

    public function show($id){
        return new ProductsResource(Product::find($id));
    }
}
