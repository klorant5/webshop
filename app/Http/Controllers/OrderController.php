<?php

namespace App\Http\Controllers;

use App\OrderItem;
use Illuminate\Http\Request;

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

        $cart = session("cart");
        $ids = [];
        foreach ($cart as $product_id => $quantity) {
            $ids[] = $product_id;
            $orderItem = new OrderItem([

            ]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
