<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
   	protected $table = 'inventories';
   	protected $fillable = ['quantity','lot_number','expiration_date','price'];
   	protected $guarded = ['id'];

   	public function product()
   	{
   		return $this->belongsTo('App\Models\Product');
   	}
   	public function user()
   	{
   		return $this->belongsTo('App\User');
   	}
      public function sales_invoice()
      {
         return $this->belongsTo('App\Models\Sales_invoice');
      }

}
