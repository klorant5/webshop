<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{


    public function product()
    {
        return $this->hasOne(Product::class);
    }
    
}
