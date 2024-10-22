<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Calculation;
use App\Http\Traits\MsgTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CalculationsRequest;

class CalculationController extends Controller
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
        return Inertia::render('Calculations/Index', [
            'filters' => request('search', []),
            'calculations' => Calculation::filter(request()->only('search'))
                ->latest('updated_at')
                ->paginate(50)
                ->through(fn ($calculation) => [
                    'id' => $calculation->id,
                    'name' => $calculation->name,
                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Calculations/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CalculationsRequest $request)
    {
        Calculation::create($request->validated());

        return Redirect::route('calculations.index')->with('success', 'Calculation created.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calculation $calculation)
    {
        return Inertia::render('Calculations/Edit', ['calculation' => $calculation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CalculationsRequest $request, Calculation $calculation)
    {
        $calculation->update($request->validated());

        return Redirect::route('calculations.index')->with('success', 'Calculation updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calculation $calculation)
    {
        $calculation->delete();

        return Redirect::route('calculations.index')->with('success', 'Calculation deleted.');
    }
}
