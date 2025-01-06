<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tbl_projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch projects for DataTable
            $projects = tbl_projects::all();

            return DataTables::of($projects)
                ->addIndexColumn()
                ->editColumn('project_name', function ($row) {
                    return ucwords($row->project_name); // Capitalize the first letter of each word
                })
                ->editColumn('project_category', function ($row) {
                    return ucwords($row->project_category); // Capitalize the first letter of each word
                })
                ->editColumn('description', function ($row) {
                    return $row->description; // Capitalize the first letter
                })
                ->editColumn('start_date', function ($row) {
                    return $row->start_date_formatted;
                })
                ->editColumn('end_date', function ($row) {
                    return $row->end_date_formatted;
                })

                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at ? $row->updated_at->format('d M Y') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '
                    <a href="' . route('project.view', ['id' => $row->id]) . '" 
                        class="view btn btn-primary btn-sm py-2" title="View">
                        <i class="mdi mdi-eye"></i> View
                    </a>
                    <a href="' . route('project.edit', ['id' => $row->id]) . '" 
                        class="edit btn btn-success btn-sm py-2" title="Edit">
                        <i class="mdi mdi-pencil"></i> Edit
                    </a>
                ';
                
                })
                ->rawColumns(['action']) // Render raw HTML for the action column
                ->make(true);
        }

        return view('project.project-list');
    }
    public function create()
    {
        return view('project.project-create', );
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'project_category' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        try {
            DB::beginTransaction(); // Start transaction

            tbl_projects::create([
                'project_name' => strtolower($request->project_name),
                'description' => $request->description,
                'project_category' => strtolower($request->project_category),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            DB::commit(); // Commit transaction

            return redirect()->route('project')->with('success', 'Project created successfully.');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction in case of error

            return redirect()->route('project.create')->with('error', 'Failed to create project: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $project = tbl_projects::findOrFail($id);
        return view('project.project-edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'project_category' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        try {
            DB::beginTransaction(); // Start transaction

            $project = tbl_projects::findOrFail($id);
            $project->update([
                'project_name' => strtolower($request->project_name),
                'description' => $request->description,
                'project_category' => strtolower($request->project_category),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'updated_at' => now(),
            ]);

            DB::commit(); // Commit transaction

            return redirect()->route('project')->with('success', 'Project updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction in case of error

            return redirect()->route('project.edit', $id)->with('error', 'Failed to update project: ' . $e->getMessage());
        }
    }


    public function view($id) {}
}
