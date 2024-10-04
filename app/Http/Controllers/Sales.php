<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sales extends Controller
{

  public function index(Request $request)
  {
    return view('sales/index');
  }

  public function test(Request $request)
  {
    return view('sales.test');
  }
}
