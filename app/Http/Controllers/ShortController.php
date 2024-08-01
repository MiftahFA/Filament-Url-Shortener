<?php

namespace App\Http\Controllers;

use AshAllenDesign\ShortURL\Facades\ShortURL;
use Illuminate\Http\Request;

class ShortController extends Controller
{
    function index()
    {
        $shortURLObject = ShortURL::destinationUrl('https://polinema.ac.id')->make();
        dd($shortURLObject);
    }
}
