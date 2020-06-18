<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::paginate(20);
        return view('admin.orders.orders')->with([
            'orders'=>$orders,

        ]);
    }
}
