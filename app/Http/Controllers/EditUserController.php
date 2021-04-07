<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class EditUserController extends Controller
{
    public function super_edit(User $super)
    {
        return view('admins/super/super_edit')
            ->with("super", $super);
    }

    public function super_update(Request $request, User $super)
    {
        $this->validate($request, [
            'users_id' => "required|unique:users,users_id,$super->id|max:255",
            'password' => 'required|max:255'
        ], [
            'users_id.required' => '*The Super Admin ID field is required.',
            'users_id.unique' => '*Entered USER ID already exists.',
            'users_id.max' => '*The Super Admin ID may not be greater than 255 characters.',
            'password.required' => '*The Password field is required.',
            'password.max' => '*The Password may not be greater than 255 characters.',
        ]);

        $userData = $request->only(["users_id", "password"]);
        $userData['password'] = \Illuminate\Support\Facades\Hash::make($userData['password']);

        $super->update($userData);
        return redirect("admins/super/admin");
    }

    public function admin_edit(User $admin)
    {
        return view('admins/admin/admin_edit')
            ->with("admin", $admin);
    }

    public function admin_update(Request $request, User $admin)
    {
        $this->validate($request, [
            'users_id' => "required|unique:users,users_id,$admin->id|max:255",
            'password' => 'required|max:255'
        ], [
            'users_id.required' => '*The Admin ID field is required.',
            'users_id.unique' => '*Entered USER ID already exists.',
            'users_id.max' => '*The Admin ID may not be greater than 255 characters.',
            'password.required' => '*The Password field is required.',
            'password.max' => '*The Password may not be greater than 255 characters.',
        ]);
        $userData = $request->only(["users_id", "password"]);
        $userData['password'] = \Illuminate\Support\Facades\Hash::make($userData['password']);

        $admin->update($userData);
        return redirect("admins/admin/all-course");
    }

    public function teacher_edit(User $teacher)
    {
        return view('admins/teacher/teacher_edit')
            ->with("teacher", $teacher);
    }

    public function teacher_update(Request $request, User $teacher)
    {
        $this->validate($request, [
            'users_id' => "required|unique:users,users_id,$teacher->id|max:255",
            'password' => 'required|max:255'
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
        return redirect("admins/teacher/my-course");
    }
}
