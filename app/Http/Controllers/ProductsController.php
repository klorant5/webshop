<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Product;

class ProductsController extends Controller
{
    
    
    public function index(Request $request) {

//        $request->session()->forget('cart');
        return view("products.index", [
            'products' => Product::all(),
        ]);
        
    }
    
    public function show(Product $product) {
        
        
        
    }
}
