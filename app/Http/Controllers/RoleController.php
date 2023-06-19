<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Role::class);

        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        $validated = $request->validate([
            'name' => 'required|string',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $validated['name']])
            ->givePermissionTo($validated['permissions']);

        session()->flash('message', __('Successfully created'));

        return redirect()->route('roles.show', ['role' => $role->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $this->authorize('view', $role);

        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);

        $permissions = $this->getRolePermissionSelectOption($role);

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);

        $validated = $request->validate([
            'name' => 'required|string',
            'permissions' => 'required|array',
        ]);

        $role->name = $validated['name'];

        $role->syncPermissions($validated['permissions']);

        $role->save();

        session()->flash('message', __('Successfully updated'));

        return redirect()->route('roles.show', ['role' => $role->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $role->forceDelete();

        session()->flash('message', __('Successfully deleted'));

        return redirect()->route('roles.index');
    }

    /**
     * Get role permissions option for select on form
     */
    private function getRolePermissionSelectOption(Role $role): Collection
    {
        $role_permission = $role->permissions;

        $permissions = Permission::all()
            ->map(function ($permission) use ($role_permission) {
                $permission->checked = $role_permission->contains($permission->id);

                return $permission;
            });

        return $permissions;
    }
}
