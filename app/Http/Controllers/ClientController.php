<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Client;
use App\Http\Traits\MsgTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ClientsRequest;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    use MsgTrait;

    public function index()
    {
        return Inertia::render('Clients/Index', [
            'filters' => request('search', []),
            'clients' => Client::filter(request()->only('search'))
                ->when(Auth::user()->role !== 'admin', function ($query, $search) {
                    $query->where('creater_id', Auth::id());
                })
                ->latest('updated_at')
                ->paginate(50)
                ->through(fn ($client) => [
                    'id' => $client->id,
                    'name' => $client->name,
                    'phone' => $client->phone,
                    'email' => $client->email,
                    'status' => $client->status ? 'On' : 'Off',
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
        return Inertia::render('Clients/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientsRequest $request)
    {
        Client::create($request->validated());

        return Redirect::route('clients.index')->with('success', 'Client created.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return Inertia::render('Clients/Edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientsRequest $request, Client $client)
    {
        $client->update($request->validated());

        return Redirect::route('clients.index')->with('success', 'Client updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return Redirect::route('clients.index')->with('success', 'Client deleted.');
    }
}
