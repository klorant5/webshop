<?php
/**
 * Created by PhpStorm.
 * User: lorant
 * Date: 2017.01.23.
 * Time: 18:57
 */
$sum = 0;
?>


@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your order</h1>
        <div>
            @if(!empty($products))
                <form action="/order" method="post">
                    @foreach($products as $product)
                        <?php $sum += $cart[$product->id] * $product->price; ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <a href="/product/{{$product->id}}"> {{ $product->name }} </a>
                            </div>
                            <div class="col-sm-3">{{$product->price . " Ft"}}</div>
                            <div class="col-sm-3">{{ "x".$cart[$product->id] }}</div>
                            <div class="col-sm-3">{{ $cart[$product->id] * $product->price . " Ft" }}</div>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-sm-offset-9 col-sm-3">
                            total: {{ $sum . " Ft" }}
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label for="shipping_types">Shipping:</label>
                            <select name="shipping" id="shipping_types" class="form-control">
                                @foreach($shipping as $sVal => $sMethod)
                                    <option value="{{$sVal}}">{{$sMethod}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="paying_method">Pay with:</label>
                            <select name="paying" id="paying_method" class="form-control">
                                @foreach($payingMethods as $pVal => $pMethod)
                                    <option value="{{$pVal}}">{{$pMethod}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Order</button>

                </form>
            @else
                <div>You have no product in your cart.</div>
            @endif
        </div>
    </div>
@endsection
