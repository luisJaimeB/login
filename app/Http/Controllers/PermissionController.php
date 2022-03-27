<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionEditRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): View
    {
        abort_if(Gate::denies('permissions.index'), 403);

        $permissions = Permission::paginate(10);

        return view('permissions.index', compact('permissions'));
    }


    public function create(): View
    {
        abort_if(Gate::denies('permissions.create'), 403);

        return view('permissions.create');
    }

    
    public function store(PermissionCreateRequest $request): RedirectResponse
    {
        Permission::create($request->only('name'));
        return redirect()->route('permissions.index')->with('success', 'permiso creado correctamente');
    }


    public function show(Permission $permission): View
    {
        abort_if(Gate::denies('permissions.show'), 403);

        return view('permissions.show', compact('permission'));
    }


    public function edit(Permission $permission): View
    {
        abort_if(Gate::denies('permissions.edit'), 403);

        return view('permissions.edit', compact('permission'));
    }


    public function update(PermissionEditRequest $request, Permission $permission): RedirectResponse
    {
        $permission->update($request->only('name'));

        return redirect()->route('permissions.index')->with('success', 'permiso actualizado correctamente');
    }


    public function destroy(Permission $permission): RedirectResponse
    {
        abort_if(Gate::denies('permissions.destroy'), 403);

        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'permiso eliminado correctamente');
    }
}
