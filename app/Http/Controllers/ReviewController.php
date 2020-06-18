<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        $reviews=Review::with(['product','customer'])->paginate(15);
        return view('admin.reviews.reviews')->with([
            'reviews'=>$reviews
        ]);
    }
}
