<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleEditRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('roles.index'), 403);

        $roles = Role::paginate(5);

        return view('admin.roles.index', compact('roles'));
    }


    public function create(): View
    {
        abort_if(Gate::denies('roles.create'), 403);

        $permissions = Permission::all()->pluck('name', 'id');

        return view('admin.roles.create', compact('permissions'));
    }


    public function store(RoleCreateRequest $request): RedirectResponse
    {
        $role = Role::create($request->only('name'));

        $role->syncPermissions($request->input('permissions', []));

        return redirect()->route('roles.index');
    }


    public function show(Role $role): View
    {
        abort_if(Gate::denies('roles.show'), 403);

        $role->load('permissions');
        return view('admin.roles.show', compact('role'));
    }


    public function edit(Role $role): View
    {
        abort_if(Gate::denies('roles.edit'), 403);

        $permissions = Permission::all()->pluck('name', 'id');
        $role->load('permissions');

        return view('admin.roles.edit', compact('role', 'permissions'));
    }


    public function update(RoleEditRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->only('name'));

        $role->syncPermissions($request->input('permissions', []));

        return redirect()->route('roles.index');
    }


    public function destroy(Role $role): RedirectResponse
    {
        abort_if(Gate::denies('roles.destroy'), 403);

        $role->delete();

        return redirect()->route('roles.index');
    }
}
