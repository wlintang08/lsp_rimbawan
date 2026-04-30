<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skema;

class FrontController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function news()
    {
        return view('front.news');
    }

    public function alur()
    {
        return view('front.alur');
    }

    public function skema()
    {
        $skema = Skema::all();
        return view('front.skema', compact('skema'));
    }
}
