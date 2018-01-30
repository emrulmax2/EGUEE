<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $fillable = ['orderdate','totalamount','discount','productid','customerid','quantity'];
}
