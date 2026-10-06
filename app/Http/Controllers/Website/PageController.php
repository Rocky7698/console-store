<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('website.pages.contact');
    }

    public function contact()
    {
        return view('website.pages.contact');
    }
}
