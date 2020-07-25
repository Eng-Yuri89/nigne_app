<?php

namespace App\Http\Controllers\api;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Resources\StateResource;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        return CountryResource::collection(Country::paginate());
    }

    public function showStates($id)
    {
        $country = Country::find($id);
        return StateResource::collection($country->states()->paginate());
    }

    public function showCities($id)
    {
        $country = Country::find($id);
        return StateResource::collection($country->cities()->paginate());
    }
}
