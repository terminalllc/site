<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SettingsRequest;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('cars.index');
            }
            return $next($request);
        });
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return Inertia::render('Settings/Edit', ['setting' => $setting]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingsRequest $request, Setting $setting)
    {
        $setting->update($request->validated());

        return Redirect::route('setting.edit',1)->with('success', 'Settings updated.');
    }

}
