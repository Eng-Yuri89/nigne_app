<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(){
        $status=State::paginate(20);
        return view('admin.states.states')->with([
            'states'=>$status
        ]);
    }
}
