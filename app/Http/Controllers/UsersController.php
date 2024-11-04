<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Http\Requests\UserRequest;
use App\Models\Calculation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !=='admin') {
                return redirect()->route('cars.index');
            }
            return $next($request);
        });
    }

    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::orderByName()
            ->paginate(10)
            ->through(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());

        return Redirect::route('users.index')->with('success', 'User created');
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => $user,
        ]);
    }

    public function update(UserRequest $request, User $user)
    {

        $user->update($request->safe()->except(['password']));

        if ($request->get('password')) {
            $user->update(['password' =>  $request->safe()['password']]);
        }

        return Redirect::back()->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->id === $user->id) {
            return Redirect::back()->with('error', 'Cannot delete current user');
        }

        $user->delete();

        return Redirect::back()->with('success', 'User deleted');
    }

    public function restore(User $user)
    {
        $user->restore();

        return Redirect::back()->with('success', 'User restored');
    }
}
