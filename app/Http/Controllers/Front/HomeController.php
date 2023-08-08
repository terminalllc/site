<?php

namespace App\Http\Controllers\Front;

use App\Models\Setting;
use App\Services\LanguageService;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $site= Setting::first();
        $langs = LanguageService::getLanguages();
        return view('index', compact('site', 'langs'));
    }

}
