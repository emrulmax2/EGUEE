<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $fillable = ['orderdate','amount','paid','due','discount','productid','customerid'];
}
