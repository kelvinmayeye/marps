<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\School;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers(Request $request){
        $users = User::query()->whereNot('status','pending')->get();
        $schools = School::all();
        return view('pages.users.users-list',compact('users','schools'));
    }

    public function getUsersRequests(Request $request){
        $users = User::query()->where('status','pending')->get();
        $schools = School::all();
        return view('pages.users.users-pending-list',compact('users','schools'));
    }

    public function saveUser(Request $request){
        try {
            $userArray = $request->except('_token');
            $username = $userArray['username'];
            $userId = $userArray['user_id'] ?? null;

            $existingUser = User::where('username', $username);
            if ($userId) $existingUser = $existingUser->where('id', '!=', $userId);
            $existingUser = $existingUser->first();

            if ($existingUser) {
                return redirect()->back()->with('error', "Username $username already taken by another user");
            }

            if ($userId) {
                $subject = User::findOrFail($userId);
                unset($userArray['user_id']);
                $subject->update($userArray);
            } else {
                unset($userArray['user_id']);
                $userArray['password'] = bcrypt(123);
                User::create($userArray);
            }

            toastr()->success('User saved successfully');
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function getAllRoles(Request $request){
        $roles = Role::all();
        return view('pages.users.roles.roles-list',compact('roles'));
    }

    public function saveRole(Request $request){
        try {
            $roleId = $request->input('role_id');
            $roleData = $request->except('role_id');
            $roleName = $request->input('name');

            $existingRole = Role::where('name', $roleName);
            if ($roleId) $existingRole = $existingRole->where('id', '!=', $roleId);
            $existingRole = $existingRole->first();

            if ($existingRole) return redirect()->back()->with('error', "Role '$roleName' already exists.");


            if ($roleId) {
                $role = Role::findOrFail($roleId);
                $role->update($roleData);
            } else {
                Role::create($roleData);
            }

            toastr()->success('Role saved successfully');
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function getAllPermissions(Request $request){
        return view('pages.users.roles.roles-permission');
    }

}
