<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesInvoice
 extends Model
{
    protected $table = 'sales_invoices';
    protected $fillable = ['quantity_products'];
    protected $guarded = ['id'];

    public function sale()
    {
    return $this->belongsTo('App\Models\Sale');
    }
     public function inventories()
    {
    return $this->hasMany('App\Models\Inventory');
    }
}
