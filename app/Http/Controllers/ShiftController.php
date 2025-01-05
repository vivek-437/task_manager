<?php

namespace App\Http\Controllers;

use App\Models\tbl_shifts;
use App\Models\tbl_users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ShiftController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch roles with pagination for DataTable
            $roles = tbl_shifts::all();
            //     <a href="javascript:void(0)" 
            //     class="delete btn btn-danger btn-sm ml-2 py-2" 
            //     data-id="' . $row->id . '" 
            //     title="Delete">
            //     <i class="mdi mdi-delete"></i> Delete
            // </a>';
            return DataTables::of($roles)
                ->addIndexColumn()
                ->editColumn('shift_type', function ($row) {
                    return ucwords(strtolower($row->shift_type)); // Capitalize the first letter of each word
                })->editColumn('location', function ($row) {
                    return ucwords(strtolower($row->location)); // Capitalize the first letter of each word
                }) // Use the custom formatted start_time
                ->editColumn('start_time', function ($row) {
                    return $row->start_time_formatted; // Call the accessor for formatted start_time
                })
                // Use the custom formatted end_time
                ->editColumn('end_time', function ($row) {
                    return $row->end_time_formatted; // Call the accessor for formatted end_time
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at ? $row->updated_at->format('d M Y') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="' . route('shift.edit', ['id' => $row->id]) . '" 
                            class="edit btn btn-success btn-sm py-2" title="Edit">
                            <i class="mdi mdi-pencil"></i> Edit
                        </a> 
                        ';
                })
                ->rawColumns(['action']) // Render raw HTML for the action column
                ->make(true);
        }
        return view('shift.shift-list');
    }
    // Display the form to create a new shift
    public function create()
    {
        return view('shift.shift-create');
    }

    // Store the new shift in the database

    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'shift_type' => 'required|in:morning,evening,night',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'location' => 'nullable|string|max:255',
                'notes' => 'nullable|string',
            ]);

            // Convert start_time and end_time to timestamp format
            $start_time = Carbon::createFromFormat('H:i', $request->start_time)->format('Y-m-d H:i:s');
            $end_time = Carbon::createFromFormat('H:i', $request->end_time)->format('Y-m-d H:i:s');

            // Create the shift
            tbl_shifts::create([
                'shift_type' => $request->shift_type,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'location' => strtolower($request->location),
                'notes' => $request->notes,
            ]);

            session()->flash('success', 'Shift created successfully.');
            return redirect()->route('shift');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create shift: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    // Display the form to edit an existing shift
    public function edit($id)
    {
        try {
            $shift = tbl_shifts::findOrFail($id);
            // Convert start_time and end_time to Carbon instances, then format them
            $shift->start_time = Carbon::parse($shift->start_time)->format('H:i');
            $shift->end_time = Carbon::parse($shift->end_time)->format('H:i');

            return view('shift.shift-edit', compact('shift'));
        } catch (\Exception $e) {
            session()->flash('error', 'Shift not found: ' . $e->getMessage());
            return redirect()->route('shift');
        }
    }

    // Update the shift in the database
    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $request->validate([
                'shift_type' => 'required|in:morning,evening,night',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'location' => 'nullable|string|max:255',
                'notes' => 'nullable|string',
            ]);

            // Convert start_time and end_time to timestamp format
            $start_time = Carbon::createFromFormat('H:i', $request->start_time)->format('Y-m-d H:i:s');
            $end_time = Carbon::createFromFormat('H:i', $request->end_time)->format('Y-m-d H:i:s');

            // Find the shift and update with the new values
            $shift = tbl_shifts::findOrFail($id);
            $shift->update([
                'shift_type' => $request->shift_type,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'location' => strtolower($request->location),
                'notes' => $request->notes,
            ]);

            session()->flash('success', 'Shift updated successfully.');
            return redirect()->route('shift');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update shift: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

}
