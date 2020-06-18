<?php

namespace App\Http\Controllers;

use App\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index(){
        $shipments=Shipment::paginate(20);
        return view('admin.shipments.shipments')->with([
            'shipments'=>$shipments
        ]);
    }
}
