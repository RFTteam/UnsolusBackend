<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;

class LanguageController extends Controller
{
    public function getLanguages()
    {
        $languages=Language::all();
        $languagenames=$languages->pluck('LanguageName');
        $response=$languagenames;
        return response()->json($response,200);
    }
}
