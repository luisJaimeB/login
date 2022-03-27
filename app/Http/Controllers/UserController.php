<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\UserEditRequest;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::paginate(3);

        return view('users.index', compact('users'));
    }


    public function create(): View
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('users.create', compact('roles'));
    }


    public function store(UserCreateRequest $request):RedirectResponse
    {
        $user = User::create($request->only('name', 'username', 'email') + [
            'password' => bcrypt($request->input('password'))
        ]);

        event(new Registered($user));

        $roles = $request->input('roles', []);
        $user->syncRoles($roles);
        return redirect()->route('users.index', $user->id)->with('success', 'usuario creado correctamente');
    }


    public function show(User $user): View
    {
        $user->load('roles');
        return view('users.show', compact('user'));
    }


    public function edit(User $user): View
    {
        $roles = Role::all()->pluck('name', 'id');
        $user->load('roles');

        return view('users.edit', compact('user', 'roles'));
    }


    public function update(UserEditRequest $request, User $user): RedirectResponse
    {
        $data = $request->only('name', 'username', 'email');
        $password = $request->input('password');
        if ($password) {
            $data['password'] = bcrypt($password);
        }

        $user->update($data);
        $roles = $request->input('roles', []);
        $user->syncRoles($roles);
        return redirect()->route('users.show', $user->id)->with('success', 'Usuario actualizado satisfactoriamente');
    }


    public function destroy(User $user):RedirectResponse
    {
        if (auth()->user()->id == $user->id) {
            return redirect()->route('users.index');
        }

        $user->delete();
        return back()->with('success', 'Usuario eliminado correctamente');
    }

    public function changeStatusUser(User $user): RedirectResponse
    {
        $user->status = !$user->status;
        $user->save();

        return back()->with('success', 'Estado actualizado correctamente');
    }
}
