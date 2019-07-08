<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product as Product;
use App\Models\Inventory as Inventory;

class ProductController extends Controller
{

 	public function create(Request $request)
    {
    	$product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();
        $inventory = Inventory::all();
    	$products = Product::all();
        return view('Inventory/list',compact('inventory','products'));
        
    }
}
