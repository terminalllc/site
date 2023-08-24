<?php

namespace App\Composers;


use App\Models\Setting;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Services\LanguageService;
use Illuminate\Support\Facades\Route;


class LayoutComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $site = Setting::first();
        $langs = LanguageService::getLanguages();

        $current_route = Route::currentRouteName();
        foreach($langs as $lang){
            $search = $lang->code . '.';
            $current_route = Str::replace($search, '', $current_route);
        }

        $view->with('site', $site);
        $view->with('langs', $langs);
        $view->with('current_route', $current_route);
    }
}
