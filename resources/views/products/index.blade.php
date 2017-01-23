@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Our products</h1>
    <div class="row">
    @foreach($products as $product)
        <div class="col-sm-3" style="margin-bottom: 20px;">
            <div class="">
                <img class="img-responsive" src="http://placehold.it/500x250" />
            </div>
            <div>
                <div class="clearfix">
                    <div class="pull-left">
                        <h4><a href='/products/{{$product->id}}'>{{ $product->name }}</a></h4>
                    </div>
                    <div class="pull-right">
                        <h4>{{ $product->price . " Ft " }}</h4>
                    </div>
                </div>
                <div>
                    <!-- Quantity Form Input -->
                    <div class="clearfix">
                        <form action="/cart" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="text" maxlength="2" name="quantity" value="1">
                            <button type="submit" class="btn btn-default pull-right">Buy</button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    @endforeach
    </div>
</div>
@endsection
