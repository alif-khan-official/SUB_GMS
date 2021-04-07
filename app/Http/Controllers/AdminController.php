<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Department;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.super.admin.list')->with('admins', User::select('users.*', 'departments.department_code')
            ->join("departments", "departments.id", "users.department_id")
            ->where('role', 'Admin')
            ->orderBy('users_id')->paginate(10));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.super.admin.create')->with('departments', Department::all());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'users_id' => 'required|unique:users|max:255',
            'password' => 'required|max:255',
            'department_id' => 'required',
        ], [
            'users_id.required' => '*The Admin ID field is required.',
            'users_id.unique' => '*Entered USER ID already exists.',
            'users_id.max' => '*The Admin ID may not be greater than 255 characters.',
            'password.required' => '*The Password field is required.',
            'password.max' => '*The Password may not be greater than 255 characters.',
            'department_id.required' => '*The Department Code field is required.',
        ]);

        $user_create = \App\User::create([
            'password' => bcrypt($request->password),
            'users_id' => $request->users_id,
            'role' => "Admin",
            'department_id' => $request->department_id
        ]);
        return redirect('admins/super/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Admin $admin
     * @return \Illuminate\Http\Response
     */

    public function edit(User $admin)
    {
        return view('admins/super/admin/edit')
            ->with("admin", $admin)
            ->with('departments', Department::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Admin $admin
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, User $admin)
    {
        $this->validate($request, [
            'users_id' => "required|unique:users,users_id,$admin->id|max:255",
            'password' => 'required|max:255',
            'department_id' => 'required',
        ], [
            'users_id.required' => '*The Admin ID field is required.',
            'users_id.unique' => '*Entered USER ID already exists.',
            'users_id.max' => '*The Admin ID may not be greater than 255 characters.',
            'password.required' => '*The Password field is required.',
            'password.max' => '*The Password may not be greater than 255 characters.',
            'department_id.required' => '*The Department Code field is required.',
        ]);

        $userData = $request->only(["users_id", "password", "department_id"]);
        $userData['password'] = \Illuminate\Support\Facades\Hash::make($userData['password']);

        $admin->update($userData);
        return redirect("admins/super/admin");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Admin $admin
     * @return \Illuminate\Http\Response
     */
//    public function destroy(Admin $admin)
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect('admins/super/admin');
    }
}
