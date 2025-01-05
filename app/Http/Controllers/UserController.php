<?php

namespace App\Http\Controllers;

use App\Mail\CustomMail;
use App\Models\tbl_role_users;
use App\Models\tbl_roles;
use App\Models\tbl_users;
use App\Models\tbl_user_details;
use App\Models\tbl_shifts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    // Display all users
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = tbl_users::with('userDetails')->get();
            return DataTables::of($users)
                ->editColumn('name', function ($row) {
                    return ucwords($row->name);
                })
                ->editColumn('user_details.gender', function ($row) {
                    return ucwords($row->userDetails->gender);
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at ? $row->updated_at->format('d M Y') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '
                <a href="' . route('user.edit', ['id' => $row->id]) . '" 
                    class="edit btn btn-success btn-sm py-2" title="Edit">
                    <i class="mdi mdi-pencil"></i> Edit
                </a> 
                    <a href="' . route('user.view', ['id' => $row->id]) . '" 
                    class="edit btn btn-info btn-sm py-2 ml-2" title="View">
                     <i class="mdi mdi-eye"></i> View
                </a> 
                ';
                })
                ->rawColumns(['action']) // Render raw HTML for the action column
                ->make(true);
        }
        return view('user.user-list');
    }

    // Show form to create a new user
    public function create()
    {
        // Get all shifts for the dropdown or selection
        $shifts = tbl_shifts::all();
        $roles = tbl_roles::all();
        $nationalities = tbl_user_details::distinct()->pluck('nationality');
        $occupations = tbl_user_details::distinct()->pluck('occupation');
        // Loop through each shift and format start_time and end_time using Carbon
        foreach ($shifts as $shift) {
            $shift->start_time = Carbon::parse($shift->start_time)->format('H:i');
            $shift->end_time = Carbon::parse($shift->end_time)->format('H:i');
        }

        // Pass the shifts to the view
        return view('user.user-create', compact('shifts', 'nationalities', 'occupations', 'roles'));
    }

    // Store a new user
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validate request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:tbl_users,email',
                'address' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:15',
                'date_of_birth' => 'nullable|date',
                'gender' => 'nullable|in:male,female,other',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'bio' => 'nullable|string',
                'nationality' => 'nullable|string|max:50',
                'occupation' => 'nullable|string|max:100',
                'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'tbl_shift_id' => 'required|exists:tbl_shifts,id',
                'tbl_role_id' => 'required|exists:tbl_roles,id',
            ]);

            // Store user data
            // Generate a random 12-character password
            $randomPassword = Str::random(12);

            // Create the user with the random password
            $user = tbl_users::create([
                'name' => strtolower($request->name),
                'email' => $request->email,
                'password' => Hash::make($randomPassword), // Store the hashed password
            ]);

            // Store user details
            $userDetails = new tbl_user_details();
            $userDetails->tbl_user_id = $user->id;
            $userDetails->address = $request->address;
            $userDetails->phone = $request->phone;
            $userDetails->date_of_birth = $request->date_of_birth;
            $userDetails->gender = $request->gender;
            $userDetails->bio = $request->bio;
            $userDetails->nationality = strtolower($request->nationality);
            $userDetails->occupation = strtolower($request->occupation);
            $userDetails->tbl_shift_id = $request->tbl_shift_id;

            // Ensure the 'profile' and 'resume' directories exist in the public folder
            $profilePath = public_path('profile');
            $resumePath = public_path('resume');

            if (!file_exists($profilePath)) {
                mkdir($profilePath, 0777, true);
            }

            if (!file_exists($resumePath)) {
                mkdir($resumePath, 0777, true);
            }

            // Handle profile image upload with unique name
            if ($request->hasFile('profile_image')) {
                $imageName = Str::uuid() . '.' . $request->file('profile_image')->getClientOriginalExtension();
                $imagePath = $request->file('profile_image')->move($profilePath, $imageName);
                $userDetails->profile_image_path = 'profile/' . $imageName;
            }

            // Handle resume upload with unique name
            if ($request->hasFile('resume')) {
                $resumeName = Str::uuid() . '.' . $request->file('resume')->getClientOriginalExtension();
                $resumePath = $request->file('resume')->move($resumePath, $resumeName);
                $userDetails->resume_path = 'resume/' . $resumeName;
            }

            $userDetails->save();

            // Prepare the email content
            $subject = 'Welcome to the Platform';
            $body = "

                    <h2>Dear " . $user->name . ",</h2>
                    <p>Your account has been successfully created. Below are your login details:</p>
                    <table>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td>" . $user->email . "</td>
                        </tr>
                        <tr>
                            <td><strong>Password:</strong></td>
                            <td>" . $randomPassword . "</td>
                        </tr>
                    </table>
 

            ";

            $cc = [];  // Add CC emails if needed
            $bcc = []; // Add BCC emails if needed
            $view = 'mail.auth-mail'; // Blade view for email content
            $attachments = []; // Add any attachments if necessary

            // Send email to the user with their details
            Mail::to($user->email)->send(new CustomMail(
                $subject,
                $body,
                $attachments,
                $cc,
                $bcc,
                $view
            ));
            $userRole = new tbl_role_users();
            $userRole->tbl_user_id = $user->id;
            $userRole->tbl_role_id = $request->tbl_role_id;
            $userRole->save();

            // Commit the transaction if everything is successful
            DB::commit();

            session()->flash('success', 'User created successfully and email sent.');
            return redirect()->route('user');
        } catch (\Exception $e) {
            // Rollback transaction if any step fails
            DB::rollBack();

            session()->flash('error', 'Failed to create user: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }




    // Show form to edit a user's information
    public function edit($id)
    {
        try {
            $user = tbl_users::findOrFail($id);
            $userDetails = tbl_user_details::where('tbl_user_id', $id)->first();
            $userRole = tbl_role_users::where('tbl_user_id', $id)->first();
            $roles = tbl_roles::all();
            $shifts = tbl_shifts::all();
            return view('user.user-edit', compact('user', 'shifts', 'roles', 'userRole'));
        } catch (\Exception $e) {
            session()->flash('error', 'User not found: ' . $e->getMessage());
            return redirect()->route('user');
        }
    }

    // Update user information
    public function update(Request $request, $id)
    {
        try {
            // Validate request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:tbl_users,email,' . $id,
                'password' => 'nullable|min:8',
                'address' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:15',
                'date_of_birth' => 'nullable|date',
                'gender' => 'nullable|in:male,female,other',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'bio' => 'nullable|string',
                'nationality' => 'nullable|string|max:50',
                'occupation' => 'nullable|string|max:100',
                'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
                'tbl_shift_id' => 'required|exists:tbl_shifts,id',
                'tbl_role_id' => 'required|exists:tbl_roles,id',
            ]);

            // Update user data
            $user = tbl_users::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
                'update_at' => now(),
            ]);

            // Update user details
            $userDetails = tbl_user_details::where('tbl_user_id', $id)->first();
            $userDetails->update([
                'address' => $request->address,
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'bio' => $request->bio,
                'nationality' => $request->nationality,
                'occupation' => $request->occupation,
                'tbl_shift_id' => $request->tbl_shift_id,
            ]);

            // Ensure 'profile' and 'resume' folders exist in the public storage path
            $profilePath = public_path('profile');
            $resumePath = public_path('resume');

            if (!File::exists($profilePath)) {
                File::makeDirectory($profilePath, 0777, true);
            }

            if (!File::exists($resumePath)) {
                File::makeDirectory($resumePath, 0777, true);
            }

            // Handle profile image upload with unique name using public_path
            if ($request->hasFile('profile_image')) {
                $imageName = Str::uuid() . '.' . $request->file('profile_image')->getClientOriginalExtension();
                $imagePath = $request->file('profile_image')->move($profilePath, $imageName);
                $userDetails->profile_image_path = 'profile/' . $imageName;
            }

            // Handle resume upload with unique name using public_path
            if ($request->hasFile('resume')) {
                $resumeName = Str::uuid() . '.' . $request->file('resume')->getClientOriginalExtension();
                $resumePath = $request->file('resume')->move($resumePath, $resumeName);
                $userDetails->resume_path = 'resume/' . $resumeName;
            }
            $userDetails->updated_at = now();

            $userDetails->save();
            $userRole = tbl_role_users::firstOrNew(['tbl_user_id' => $id]);

            // Update the role ID
            $userRole->tbl_role_id = $request->tbl_role_id;
            $userRole->tbl_user_id = $id;
            $userRole->updated_at = now();
            $userRole->save();

            session()->flash('success', 'User updated successfully.');
            return redirect()->route('user');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update user: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }


    // View user details
    public function view($id)
    {
        // Fetch the user, their details, and their role
        $user = tbl_users::with('userDetails', 'roles')->find($id);
        // dd($user);
        return view('user.user-view', compact('user'));
    }
}
