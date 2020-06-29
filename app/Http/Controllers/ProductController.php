<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'images'])->paginate(env('PAGINATION_COUNT'));
        $currencyCode = env('CURRENCY_CODE', '$');
        return view('admin.products.products')->with([
            'products' => $products,
            'currency_code' => $currencyCode
        ]);
    }





    public function store(Request $request)
    {


        $request->validate([
            'product_title' => 'required',
            'product_description' => 'required',
            'product_unit' => 'required',
            'product_price' => 'required',
            'product_total' => 'required',
            'product_category' => 'required',
            'product_discount' => 'required',


        ]);
        $product = new Product();
        $product->title = $request->input('product_title');
        $product->description = $request->input('product_description');
        $product->unit = intval($request->input('product_unit'));
        $product->price = doubleval($request->input('product_price'));
        $product->total = doubleval($request->input('product_total'));
        $product->category_id = intval($request->input('product_category'));
        $product->discount = doubleval($request->input('product_discount'));
        $product->save();
        Session::flash('message', 'product has been added');
        return redirect()->route('products');

    }


    public function newProduct($id = null)
    {

        $product = null;
        if(!is_null($id)) {

            $product = Product::with([
                'hasUnit',
                'category'
            ])->find($id);

        }
        $units = Unit::all();
        $categories = Category::all();

        return view('admin.products.new-product')->with([
            'product' => $product,
            'units' => $units,
            'categories' => $categories,
        ]);


    }

    public function update(Request $request)
    {

        dd($request);

    }


    public function delete($id)
    {

    }
}
