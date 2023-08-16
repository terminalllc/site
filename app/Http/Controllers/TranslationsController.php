<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Traits\MsgTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TranslationsRequest;
use Spatie\TranslationLoader\LanguageLine;

class TranslationsController extends Controller
{
    use MsgTrait;

    public function index()
	{
        $search = Request::all('search') ?? null;
        return Inertia::render('Translations/Index', [
            'filters' => Request::all('search'),
            'translations' => LanguageLine
                ::whereRaw("lower(text->'$.uk') like lower(?)", ["%{$search['search']}%"])
                ->paginate(50)
                ->withQueryString()
                ->through(function ($translation) {
                    return [
                        'id' => $translation->id,
                        'group' => $translation->group,
                        'text' => $translation->text['uk'],
                        'key' => $translation->key,
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Translations/Create' );
    }

    public function store(TranslationsRequest $request)
    {
        LanguageLine::create($request->validated());

        return Redirect::route('translations.index')->with('success', $this->msgInsert());
    }

     public function edit(LanguageLine $translation)
    {
        return Inertia::render('Translations/Edit', [
            'translation' => [
                'id' => $translation->id,
                'text' => $translation->text,
                'group' =>  $translation->group,
                'key' =>  $translation->key,
            ],
        ]);
    }

   public function update(TranslationsRequest $request, LanguageLine $translation)
    {
        $translation->update($request->validated());

         return Redirect::route('translations.index')->with('success', $this->msgUpdate());
    }

    public function destroy(LanguageLine $translation)
    {
        $message = $this->msgDelete();

		try{
            $translation->delete();
		} catch(\Exception $e){

            $message = $this->msgError() .   $e->getMessage();
            return Redirect::route('translations.index')->with('error',$message);

		}

        return Redirect::route('translations.index')->with('success',$message);
    }
}
