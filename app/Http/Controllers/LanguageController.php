<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Language;
use App\Http\Traits\MsgTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LanguagesRequest;
use Illuminate\Support\Facades\Redirect;

class LanguageController extends Controller
{
    use MsgTrait;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('cars.index');
            }
            return $next($request);
        });
    }

    public function index()
    {
        return Inertia::render('Languages/Index', [
            'filters' => request('search', []),
            'languages' => Language::filter(request()->only('search'))
                ->paginate(10)
                ->through(fn ($language) => [
                    'id' => $language->id,
                    'name' => $language->name,
                    'is_default' => $language->is_default ? 'Yes' : 'No',
                    'status' => $language->status ? 'On' : 'Off',
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Languages/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguagesRequest $request)
    {
        Language::create($request->validated());

        return Redirect::route('languages.index')->with('success', 'Language created.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        return Inertia::render('Languages/Edit', ['language' => $language]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguagesRequest $request, Language $language)
    {
        $language->update($request->validated());

        return Redirect::route('languages.index')->with('success', 'Language updated.');
    }

    public function destroy(Language $language)
    {
        $message = $this->msgDelete();

        try {
            $language->delete();

        } catch (\Exception $e) {
            $message = $this->msgError() .   $e->getMessage();

            return Redirect::route('languages.index')->with('error', $message);
        }

        return Redirect::route('languages.index')->with('success', $message);
    }

}
