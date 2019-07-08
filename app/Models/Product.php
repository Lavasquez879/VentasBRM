<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name','description'];
    protected $guarded = ['id'];

    public function inventories()
    {
 	   return $this->hasMany('App\Models\Inventory');
    }
}
 