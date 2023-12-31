<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Car;
use Inertia\Inertia;
use App\Http\Traits\MsgTrait;
use App\Http\Requests\CarsRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CarController extends Controller
{
    use MsgTrait;

    public function index()
    {
        return Inertia::render('Cars/Index', [
            'filters' => request('search', []),
            'cars' => Car::filter(request()->only('search'))
                ->when(Auth::user()->role !== 'admin', function ($query, $search) {
                    $query->where('creater_id', Auth::id());
                })
                ->latest('updated_at')
                ->paginate(50)
                ->through(fn ($car) => [
                    'id' => $car->id,
                    'name' => $car->name,
                    'vin' => $car->vin,
                    'presentImages'=> !empty($car->containerImages) || !empty($car->terminalImages) || !empty($car->outImages),
                    'comment' => $car->comment,
                    'client' => $car->client?->name,
                    'payment_summa' => $car->payment_summa,
                    'payment_status' => $car->payment_status ? 'Paid' : 'Not paid',
                    'power_of_attorney_delivery' => $car->power_of_attorney_delivery,
                    'power_of_attorney_import' => $car->power_of_attorney_import,
                    'status' => $car->status ? 'On' : 'Off',
                ]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Cars/Create',[
            'clients' => Client::select('id', 'name')->get(),
        ]);
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
        return Inertia::render('Cars/Edit', [
            'car' => tap($car, function ($car) {
                // Get client as object for search input.
                $car->client_id = $car->client;
            }),
            'clients'=> Client::select('id','name')->get(),
        ]);
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

    public function changeStatusPayment(Car $car)
    {
        $car->update([
            'payment_status' => !$car->payment_status,
            'user_clicked_payment_status' => Auth::user()->name,
            'paymented_at' => now(),
        ]);

        $message = 'Payment status changed successfully!';

        return Redirect::route('cars.index')->with('success', $message);
    }
}
