<?php

namespace App\Http\Controllers;

use App\Models\tbl_roles;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    // Show the list of roles
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch roles with pagination for DataTable
            $roles = tbl_roles::all();
        //     <a href="javascript:void(0)" 
        //     class="delete btn btn-danger btn-sm ml-2 py-2" 
        //     data-id="' . $row->id . '" 
        //     title="Delete">
        //     <i class="mdi mdi-delete"></i> Delete
        // </a>';
            return DataTables::of($roles)
                ->addIndexColumn()
                ->editColumn('role_name', function ($row) {
                    return ucwords(strtolower($row->role_name)); // Capitalize the first letter of each word
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at ? $row->updated_at->format('d M Y') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('role.edit', ['id' => $row->id]) . '" 
                            class="edit btn btn-success btn-sm py-2" title="Edit">
                            <i class="mdi mdi-pencil"></i> Edit
                        </a> 
                        ';
                })
                ->rawColumns(['action']) // Render raw HTML for the action column
                ->make(true);
        }

        return view('role.role-list');
    }

    // Show the form for creating a new role
    public function create()
    {
        return view('role.role-create');
    }

    // Store a newly created role in the database
    public function store(Request $request)
    {
        try {
            // Validate the form data
            $request->validate([
                'role_name' => 'required|string|max:255|unique:tbl_roles,role_name',
                'description' => 'nullable|string',
            ]);

            // Create the new role
            tbl_roles::create([
                'role_name' => strtolower($request->role_name),
                'description' => $request->description,
            ]);

            // Flash success message and redirect
            session()->flash('success', 'Role created successfully.');
            return redirect()->route('role');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create role: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // Show the form for editing the specified role
    public function edit($id)
    {
        try {
            $role = tbl_roles::findOrFail($id);
            return view('role.role-edit', compact('role'));
        } catch (\Exception $e) {
            session()->flash('error', 'Role not found: ' . $e->getMessage());
            return redirect()->route('role');
        }
    }

    // Update the specified role in the database
    public function update(Request $request, $id)
    {
        try {
            // Validate the form data
            $request->validate([
                'role_name' => 'required|string|max:255|unique:tbl_roles,role_name,' . $id,
                'description' => 'nullable|string',
            ]);

            // Find and update the role
            $role = tbl_roles::findOrFail($id);
            $role->update([
                'role_name' => strtolower($request->role_name),
                'description' => $request->description,
                'updated_at' => now(),
            ]);

            // Flash success message and redirect
            session()->flash('success', 'Role updated successfully.');
            return redirect()->route('role');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update role: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    // Remove the specified role from the database
    public function destroy($id)
    {
        try {
            // Find the role and delete it
            $role = tbl_roles::findOrFail($id);
            $role->delete();

            // Flash success message and redirect
            session()->flash('success', 'Role deleted successfully.');
            return redirect()->route('role');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete role: ' . $e->getMessage());
            return redirect()->route('role');
        }
    }
}
