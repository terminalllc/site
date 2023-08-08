<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class UsersController extends Controller
{
    public function index()
    {
        return Inertia::render('Users/Index', [
            'users' => User::getOnlyAdmin()
            ->orderByName()
            ->paginate(10)
            ->through(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]),
        ]);
    }
/*             'cars' => Car::filter(request()->only('search'))
                ->paginate(10)
                ->through(fn ($car) => [
                    'id' => $car->id,
                    'name' => $car->name,
                    'phone' => $car->vin,
                    'status' => $car->status ? 'Увімкнено' : 'Вимкнено',
                ]), */
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
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function update(UserRequest $request, User $user)
    {

        $user->update($request->safe()->only('name', 'email'));

        if ($request->get('password')) {
            $user->update(['password' =>  $request->safe()['password']]);
        }

        return Redirect::back()->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        if (Auth::user()->id === $user->id) {
            return Redirect::back()->with('error', 'Нельзя удалить текущего пользователя');
        }

        $user->delete();

        return Redirect::back()->with('success', 'Пользователь удален');
    }

    public function restore(User $user)
    {
        $user->restore();

        return Redirect::back()->with('success', 'Пользователь восстановлен');
    }
}
