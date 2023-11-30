<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use App\Services\LanguageService;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user() ? [
                        'id' => $request->user()->id,
                        'name' => $request->user()->name,
                        'email' => $request->user()->email,
                    ] : null,
                ];
            },
            'image' => function () {
                return [
                    'noImagePath' => '/images/no-image-100.png',
                ];
            },
            'isAdmin'=> Auth::user()?->role === 'admin',
            'langs' =>  LanguageService::getCodes(['code']),
            'default_lang' => LanguageService::getCodeDefault(),
            'flash' => function () use ($request) {
                return [
                    'success' => $request->hasSession() ? $request->session()->get('success') : null,
                    'error' => $request->hasSession() ? $request->session()->get('error') : null,
                    'warning' => $request->hasSession() ? $request->session()->get('warning') : null,
                ];
            },
        ]);
    }
}
