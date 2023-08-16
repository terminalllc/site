<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Car;
use Inertia\Inertia;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Traits\MsgTrait;
use App\Http\Requests\CarsRequest;
use Illuminate\Support\Facades\Redirect;

class CarController extends Controller
{
    use MsgTrait;

    public function index()
    {
        return Inertia::render('Cars/Index', [
            'filters' => request('search', []),
            'cars' => Car::filter(request()->only('search'))
                ->latest('updated_at')
                ->paginate(50)
                ->through(fn ($car) => [
                    'id' => $car->id,
                    'name' => $car->name,
                    'vin' => $car->vin,
                    'presentImages'=> !empty($car->containerImages) || !empty($car->terminalImages) || !empty($car->outImages),
                    'status' => $car->status ? 'Увімкнено' : 'Вимкнено',
                ]),
        ]);
    }
    /*         'containerImages' => 'array',
        'terminalImages' => 'array',
        'outImages' => 'array', */
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Cars/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarsRequest $request)
    {
        Car::create($request->validated());

        return Redirect::route('cars.index')->with('success', 'Car created.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return Inertia::render('Cars/Edit', ['car' => $car]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarsRequest $request, Car $car)
    {
        $car->update($request->validated());

        return Redirect::route('cars.index')->with('success', 'Car updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return Redirect::route('cars.index')->with('success', 'Car deleted.');
    }
}
