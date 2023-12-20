<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        $tax = 0.07;
        return view('main.checkout', ['tax'=>$tax]);
    }
}
