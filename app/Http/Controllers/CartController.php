<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    /**
     * @return array
     */
    public static function getCartData()
    {
        $cart = session("cart");
        $ids = [];
        if(empty($cart)){
            $cart = [];
        }
        foreach ($cart as $product_id => $quantity) {
            $ids[] = $product_id;
        }

        $products = Product::find($ids);

        $params = [
            "cart" => $cart,
            "products" => $products
        ];
//        var_dump($params);
        return $params;
    }

    /**
     * kosár listázása
     */
    public function index()
    {
        return view("cart.index", self::getCartData());
    }

    public function destroy($cart)
    {
        $cartData = session("cart");
        unset($cartData[$cart]);
        $this->saveCart($cartData);

        return Redirect::route("cart.index");
    }

    /**
     * kosárba rakás
     */
    public function store(Request $request)
    {

        $this->addProductToCart($request->input("product_id"), $request->input("quantity"));

        return Redirect::route("cart.index");
    }

    public function addProductToCart($productID, $quantity)
    {
        $cart = session("cart", []);
        if(isset($cart[$productID])){
            $cart[$productID] += $quantity;
        }else{
            $cart[$productID] = $quantity;
        }
        $this->saveCart($cart);
    }

    public static function flushCart()
    {
        session([
            "cart" => []
        ]);

    }
    private function saveCart($cart)
    {
        session([
            "cart" => $cart
        ]);

    }
}
