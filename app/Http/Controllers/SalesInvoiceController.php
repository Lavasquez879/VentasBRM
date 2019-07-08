<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesInvoiceController extends Controller
{
    public function index()
    {
      return view('SalesInvoice/list');
    }
}
