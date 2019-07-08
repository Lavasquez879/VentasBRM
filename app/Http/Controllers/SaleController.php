<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory as Inventory;
use App\Models\Sale as Sale;
use App\Models\SalesInvoice as SalesInvoice;


class SaleController extends Controller
{
    public function registerInvoice(Request $request){ 
    	$sale= new Sale();    
    	$sale->date_sale=date('Ymd');
    	$sale->total_value = $request->priceFinal;
    	$sale->save();
    	foreach ($request->listCar as $value) {
    		$product =Inventory::find($value['id']);
    		$quantityResult =($product->quantity - $value['quantity']);
    		$product->quantity = $quantityResult;
    		$product->save();
    		$salesInvoice = new SalesInvoice();
    		$salesInvoice->sale_id=1;
    		$salesInvoice->inventory_id=$value['id'];
    		$salesInvoice->quantity_products=$value['quantity'];
    		$salesInvoice->save();
    	}
    }
}
