<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $payments=Payment::paginate(20);
        return view('admin.payments.payments')->with([
            'payments'=>$payments
        ]);
    }

}
