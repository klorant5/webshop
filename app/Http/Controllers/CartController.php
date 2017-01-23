<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{

    /**
     * kosár listázása
     */
    public function index()
    {
        $cart = session("cart");
        $ids = [];
        foreach ($cart as $product_id => $quantity){
            $ids[] = $product_id;
        }

        $products = Product::find($ids);

        $params = [
            "cart" => $cart,
            "products" => $products
        ];
        return view("cart.index", $params);
    }

    /**
     * kosárba rakás
     */
    public function store(Request $request)
    {


        $cart = session("cart", []);

        $cart[$request->input("product_id")] = $request->input("quantity");
        session([
            "cart" => $cart
        ]);

        return Redirect::route("cart.index");
    }

}
