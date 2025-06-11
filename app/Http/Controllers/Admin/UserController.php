<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\School;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use League\Config\Exception\ValidationException;
use Mockery\Exception;

class UserController extends Controller
{
    public function getAllUsers(Request $request){
        if(Auth::user()->role_id != 1){
            if(empty(Auth::user()->school_id)) return back()->with('error','Your account is not associated to any school');
            $schools = School::where('id',Auth::user()->school_id)->get();
            $users = User::query()->whereNot('status','pending')->where('school_id',Auth::user()->school_id)->get();
        }else{
            $users = User::query()->whereNot('status','pending')->get();
            $schools = School::all();
        }
        $roles = Role::all();
        return view('pages.users.users-list',compact('users','schools','roles'));
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
                return back()->with('success','User saved successfully');
            } else {
                unset($userArray['user_id']);
                $userArray['password'] = bcrypt(123);
                User::create($userArray);
                return redirect()->route('users.account.requests')->with('success','User saved successfully');
            }

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function userProfile(Request $request){
        $user = Auth::user();
        return view('pages.users.profile',compact('user'));
    }

    public function changePassword(Request $request){
        try {
            // Validate input
            $request->validate([
                'current_password' => ['required'],
                'password' => ['required', 'min:4', 'confirmed'],
            ]);
            $user = Auth::user();
            if (!Hash::check($request->current_password, $user->password)) return back()->with('error','Current Password did not match');

            // Update password
            $user->password = Hash::make($request->password);
            $user->save();

            return back()->with('success', 'Password changed successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
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
        $rol = Auth::user()->role->permissions;
        $rol = (array) $rol;
        try {
            $roleId = $request->get('role_id');

            if(empty($roleId)){
                $roles = \App\Models\Role::query()->where('name','!=','admin')->get();
            }else{
                $roles = Role::query()->where('id',$roleId)->get();
            }
            $permissions = \App\Models\Permission::all();
            $rolePermissions = \DB::table('role_permissions')->select('role_id', 'permission_id')->get()->groupBy('role_id');
            $rolesWithPermissions = $roles->map(function ($role) use ($permissions, $rolePermissions) {
                $assignedPermissions = $rolePermissions->get($role->id, collect())->pluck('permission_id')->toArray();

                return [
                    'id' => $role->id,
                    'name' => $role->name,
                    'role_permissions' => $permissions->map(function ($permission) use ($assignedPermissions) {
                        return [
                            'id' => $permission->id,
                            'name' => $permission->name,
                            'group' => $permission->group,
                            'is_checked' => in_array($permission->id, $assignedPermissions) ? 1 : 0
                        ];
                    })->all()
                ];
            })->all();
        }catch (\Exception $e){
            return back()->with('error',$e->getMessage());
        }
        return view('pages.users.roles.roles-permission',compact('roles','rolesWithPermissions'));
    }

    public function saveRolePermission(Request $request)
    {
        try {
            $rolePermissions = $request->get('permissions', []);
            DB::beginTransaction();

            foreach ($rolePermissions as $roleId => $permissionIds) {
                $permissionIds = array_filter((array) $permissionIds);
                $existing = RolePermission::where('role_id', $roleId)->pluck('permission_id')->toArray();

                $toAdd = array_diff($permissionIds, $existing);
                $toRemove = array_diff($existing, $permissionIds);

                foreach ($toAdd as $permissionId) {
                    RolePermission::create([
                        'role_id' => $roleId,
                        'permission_id' => $permissionId,
                    ]);
                }

                if (!empty($toRemove)) {
                    RolePermission::where('role_id', $roleId)
                        ->whereIn('permission_id', $toRemove)
                        ->delete();
                }
            }

            DB::commit();
            return back()->with('success', 'Role permissions updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('An error occurred: ' . $e->getMessage());
        }
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
                ////
                 if(config('services.sms_settings.allow_sms_sending')){
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
                 }else{
                     $results = ['status'=>'success','msg'=>"User Account accepted successfull but confirmation token was not sent"];
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
