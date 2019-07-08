<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory as Inventory;
use App\Models\Product as Product;
class InventoryController extends Controller
{
	public function index()
    {
    	$inventory = Inventory::all();
    	$products = Product::all();
        return view('Inventory/list',compact('inventory','products'));
    }
    
    public function create(Request $request)
    {
    	$inventory = new Inventory;
        $inventory->product_id = $request->product_id;
        $inventory->user_id = \Auth::user()->id;
        $inventory->quantity = $request->quantity;
        $inventory->lot_number = $request->lotNumber;
        $inventory->expiration_date = $request->expirationDate;
        $inventory->price = $request->price;
        $inventory->save();
        $inventory = Inventory::all();
    	$products = Product::all();
        return view('Inventory/list',compact('inventory','products'));
    }
}
