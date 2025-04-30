<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\School;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getAllUsers(Request $request){
        $users = User::query()->whereNot('status','pending')->whereNot('id',1)->get();
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

    public function acceptAccountRequest(Request $request){
        $results = ['status'=>'success'];
        try {
            DB::beginTransaction();
            $user = User::find($request->get('user_id'));
            if(!$user) throw new \Exception("User Not Found");
            if($user->status == 'rejected') throw new \Exception("$user->name account is already rejected");
            if($user->status == 'accepted') throw new \Exception("$user->name account is already accepted but token not verified");
            if($user->status == 'active') throw new \Exception("$user->name account is active");
            if($user->status == 'pending'){
                $rememberToken = randomString(6);
                $user->update(['remember_token'=>$rememberToken,'status'=>'accepted']);
                $userPhoneNo = $user->phone_number;
                $userPhoneNo = preg_replace('/^0/', '255', $userPhoneNo);
                $smsData = [
                    'user_names'=>$user->name,
                    'token'=>$rememberToken,
                    'phone_number'=>$userPhoneNo,
                ];
                $sendTokenSms = sendUserRegisterToken($smsData);
                //Todo: save message results for later references
                if($sendTokenSms['successful']){
                    $results = ['status'=>'success','msg'=>"User Account accepted and token sms was sent"];
                }else{
                    $results = ['status'=>'success','msg'=>"User Account accepted but sending token sms has failed"];
                }
            }

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            $results = ['status'=>'error','msg'=>$exception->getMessage()];
        }
        return response()->json($results);
    }

}
