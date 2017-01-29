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
        <h1>Your Cart</h1>
        <div>
            @if(!empty($products->all()))
                @foreach($products->all() as $product)
                    <?php $sum += $cart[$product->id] * $product->price; ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <a href="/product/{{$product->id}}"> {{ $product->name }} </a>
                            <form action="/cart/{{$product->id}}" method="post">
                                {{ csrf_field() }}
                                {{ method_field("DELETE") }}
                                <button type="submit" class="btn-default btn">Delete</button>
                            </form>
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

                <a href="/order/create" class="btn btn-primary">Buy</a>
            @else
                <div>You have no product in your cart.</div>
            @endif
        </div>
    </div>
@endsection
