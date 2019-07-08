<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table ='sales';
    protected $fillable = ['date_sale','total_value'];
    protected $guarded = ['id']; 

    public function sales_invoices()
    {
    return $this->hasMany('App\Models\Sales_invoice');
    }
}
