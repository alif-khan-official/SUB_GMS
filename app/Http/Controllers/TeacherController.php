<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins.admin.teacher.list')
            ->with('teachers', User::select('users.*', 'departments.department_code')
                ->join("departments", "departments.id", "users.department_id")
                ->where('role', 'Teacher')
                ->where('department_id', Auth::user()->department_id)
                ->orderBy('users_id')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.admin.teacher.create');
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
        ], [
            'users_id.required' => '*The Teacher ID field is required.',
            'users_id.unique' => '*Entered USER ID already exists.',
            'users_id.max' => '*The Teacher ID may not be greater than 255 characters.',
            'password.required' => '*The Password field is required.',
            'password.max' => '*The Password may not be greater than 255 characters.',
        ]);

        $user_create = \App\User::create([
            'password' => bcrypt($request->password),
            'users_id' => $request->users_id,
            'role' => "Teacher",
            'department_id' => Auth::user()->department_id
        ]);

        return redirect('admins/admin/teacher');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */

    public function edit(User $teacher)
    {
        return view('admins/admin/teacher/edit')->with("teacher", $teacher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $teacher)
    {
        $this->validate($request, [
            'users_id' => "required|unique:users,users_id,$teacher->id|max:255",
            'password' => 'required|max:255',
        ], [
            'users_id.required' => '*The Teacher ID field is required.',
            'users_id.unique' => '*Entered USER ID already exists.',
            'users_id.max' => '*The Teacher ID may not be greater than 255 characters.',
            'password.required' => '*The Password field is required.',
            'password.max' => '*The Password may not be greater than 255 characters.',
        ]);

        $userData = $request->only(["users_id", "password"]);
        $userData['password'] = \Illuminate\Support\Facades\Hash::make($userData['password']);

        $teacher->update($userData);
        return redirect("admins/admin/teacher");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $teacher)
    {
        $teacher->delete();
        return redirect('admins/admin/teacher');
    }
}
