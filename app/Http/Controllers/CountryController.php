<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;

class CountryController extends Controller
{
    public function getCountries()
    {
        $countries=Country::all();
        $countrynames=$countries->pluck('CountryName');
        $response=$countrynames;
        return response()->json($response,200);
    }
}
