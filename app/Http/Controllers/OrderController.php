<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{

    const SHIPPING_UPS = "UPS";
    const SHIPPING_DHL = "DHL";

    const PAY_MASTERCARD = "Mastercard";
    const PAY_VISA = "Visa";

    private $shipping = [
        1 => self::SHIPPING_UPS,
        2 => self::SHIPPING_DHL,
    ];

    private $payingMethods = [
        1 => self::PAY_MASTERCARD,
        2 => self::PAY_VISA,
    ];

    private $cart = null;
    private $products;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $params = CartController::getCartData();

        $params["shipping"] = $this->shipping;
        $params["payingMethods"] = $this->payingMethods;

        return view("order.index", $params);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->cart = session("cart");

        $order = new Order();
        $order->user_id = Auth::id();
        $order->pay_type = $request->get("paying");
        $order->shipping_type = $request->get("shipping");
        $order->total_amount = $this->calculateTotalAmount();
        $order->save();


        foreach ($this->cart as $product_id => $quantity) {
            $orderItem = new OrderItem();
            $orderItem->quantity = $quantity;
            $orderItem->price = $this->products[$product_id]->price;
            $orderItem->product_id = $product_id;
            $items[] = $orderItem;
        }

        $order->orderitem()->saveMany($items);

        $this->decrementProductStock();

        CartController::flushCart();

        return Redirect::to("/thank-you");
    }

    private function calculateTotalAmount()
    {
        $productIDs = array_keys($this->cart);

        $this->products = Product::find($productIDs)->keyBy("id");
        $total = 0;

        foreach ($this->products->all() as $product){
            $total += $this->cart[$product->id] * $product->price;
            $this->cart[$product->id];
        }

        return $total;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->cart = session("cart");
        $this->calculateTotalAmount();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function decrementProductStock()
    {
        foreach ($this->cart as $pid => $quan) {
            if ($this->products[$pid]->quantity - $quan < 0) {
                $this->products[$pid] = 0;
            } else {
                $this->products[$pid]->quantity -= $quan;
            }
            $this->products[$pid]->save();
        }
    }
}
