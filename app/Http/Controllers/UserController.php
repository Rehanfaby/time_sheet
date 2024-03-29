<?php

namespace App\Http\Controllers;

use App\Project;
use App\Region;
use App\UserProject;
use Illuminate\Http\Request;
use App\User;
use App\Roles;
use App\Biller;
use App\Warehouse;
use App\CustomerGroup;
use App\Customer;
use Auth;
use Hash;
use Keygen;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-index')){
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            $lims_user_list = User::where('is_deleted', false)->get();
            return view('user.index', compact('lims_user_list', 'all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function userRole($id)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-index')){
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            $lims_user_list = User::where('is_deleted', false)->where('role_id', $id)->get();
            return view('user.admin', compact('lims_user_list', 'all_permission', 'id'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function voter()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-index')){
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            $lims_user_list = User::where('is_deleted', false)->where('role_id', 3)->get();
            return view('user.voter', compact('lims_user_list', 'all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function create()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-add')){
            $lims_role_list = Roles::where('is_active', true)->get();
            $regions = Region::get();
            $projects = Project::get();
            $supervisers = User::where('is_active', true)->where('role_id', 5)->get();

            $user_projects = [];
            $weak_days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

            return view('user.create', compact('lims_role_list', 'regions', 'projects', 'user_projects', 'weak_days', 'supervisers'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function generatePassword()
    {
        $id = Keygen::numeric(6)->generate();
        return $id;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'max:255',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
            'email' => [
                'email',
                'max:255',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
        ]);

        $this->validate($request, [
            'sign' => 'image|mimes:jpg,jpeg,png,gif,svg|max:10000',
        ]);

        $this->validate($request, [
            'stemp' => 'image|mimes:jpg,jpeg,png,gif,svg|max:10000',
        ]);

        $data = $request->except('sign', 'stemp');
        $sign = $request->sign;
        $stemp = $request->stemp;
        if ($sign) {
            $ext = pathinfo($sign->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = preg_replace('/[^a-zA-Z0-9]/', '', $request['sign']);
            $imageName = $imageName . '.' . $ext;
            $sign->move('public/images/user', $imageName);

            $data['sign'] = $imageName;
        }
        if ($stemp) {
            $ext = pathinfo($stemp->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = preg_replace('/[^a-zA-Z0-9]/', '', $request['stemp']);
            $imageName = $imageName . '.' . $ext;
            $stemp->move('public/images/user', $imageName);

            $data['stemp'] = $imageName;
        }
        $message = 'User created successfully';
        try {
            Mail::send( 'mail.user_details', $data, function( $message ) use ($data)
            {
                $message->to( $data['email'] )->subject( 'User Account Details' );
            });
        }
        catch(\Exception $e){
            $message = 'User created successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
        }
        if(!isset($data['is_active']))
            $data['is_active'] = false;
        $data['is_deleted'] = false;
        $data['password'] = bcrypt($data['password']);
        $data['phone'] = $data['phone_number'];
        $data['weak_start'] =  isset($data['weak_start']) ? implode(',', $data['weak_start']) : null;
        $data['project_id'] =  isset($data['project_id']) ? implode(',', $data['project_id']) : null;
        User::create($data);

        return redirect('user')->with('message1', $message);
    }

    public function edit($id)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-edit')){
            $lims_user_data = User::with('projects', 'region')->find($id);
            $lims_role_list = Roles::where('is_active', true)->get();
            $regions = Region::get();
            $projects = Project::get();
            $supervisers = User::where('is_active', true)->where('role_id', 5)->get();

            $user_projects = [];
            $working_days = [];
            $weak_days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            foreach (explode(',', $lims_user_data->project_id) as $project) {
                $user_projects[] = $project;
            }
            foreach (explode(',', $lims_user_data->weak_start) as $weak) {
                $working_days[] = $weak;
            }

            return view('user.edit', compact('lims_user_data', 'lims_role_list', 'regions', 'projects', 'user_projects', 'weak_days', 'supervisers', 'working_days'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function update(Request $request, $id)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');


        $input = $request->except('sign', 'stemp', 'password');
        $sign = $request->sign;
        $stemp = $request->stemp;
        if ($sign) {
            $ext = pathinfo($sign->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = preg_replace('/[^a-zA-Z0-9]/', '', $request['sign']);
            $imageName = $imageName . '.' . $ext;
            $sign->move('public/images/user', $imageName);

            $input['sign'] = $imageName;
        }
        if ($stemp) {
            $ext = pathinfo($stemp->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = preg_replace('/[^a-zA-Z0-9]/', '', $request['stemp']);
            $imageName = $imageName . '.' . $ext;
            $stemp->move('public/images/user', $imageName);

            $input['stemp'] = $imageName;
        }

        if(!isset($input['is_active']))
            $input['is_active'] = false;
        if(!empty($request['password']))
            $input['password'] = bcrypt($request['password']);

        $input['weak_start'] = isset($input['weak_start']) ? implode(',', $input['weak_start']) : null;
        $input['project_id'] = isset($input['project_id']) ? implode(',', $input['project_id']) : null;
        $lims_user_data = User::find($id);

        $lims_user_data->update($input);
        return redirect('user')->with('message2', 'Data updated successfullly');
    }

    public function profile($id)
    {
        $lims_user_data = User::with('projects', 'region')->find($id);
        $regions = Region::get();
        $projects = Project::get();

        $user_projects = [];
        $working_days = [];
        $weak_days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $supervisers = User::where('is_active', true)->where('role_id', 5)->get();
        foreach (explode(',', $lims_user_data->project_id) as $project) {
            $user_projects[] = $project;
        }
        foreach (explode(',', $lims_user_data->weak_start) as $weak) {
            $working_days[] = $weak;
        }
        return view('user.profile', compact('lims_user_data', 'regions', 'projects', 'user_projects', 'weak_days', 'supervisers', 'working_days'));
    }

    public function profileUpdate(Request $request, $id)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $input = $request->all();
        $input['weak_start'] = isset($input['weak_start']) ? implode(',', $input['weak_start']) : null;
        $input['project_id'] = isset($input['project_id']) ? implode(',', $input['project_id']) : null;
        $lims_user_data = User::find($id);
        $lims_user_data->update($input);

        return redirect()->back()->with('message3', 'Data updated successfullly');
    }

    public function changePassword(Request $request, $id)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $input = $request->all();
        $lims_user_data = User::find($id);
        if($input['new_pass'] != $input['confirm_pass'])
            return redirect("user/" .  "profile/" . $id )->with('message2', "Please Confirm your new password");

        if (Hash::check($input['current_pass'], $lims_user_data->password)) {
            $lims_user_data->password = bcrypt($input['new_pass']);
            $lims_user_data->save();
        }
        else {
            return redirect("user/" .  "profile/" . $id )->with('message1', "Current Password doesn't match");
        }
        auth()->logout();
        return redirect('/');
    }

    public function deleteBySelection(Request $request)
    {
        $user_id = $request['userIdArray'];
        foreach ($user_id as $id) {
            $lims_user_data = User::find($id);
            $lims_user_data->is_deleted = true;
            $lims_user_data->is_active = false;
            $lims_user_data->save();
        }
        return 'User deleted successfully!';
    }

    public function destroy($id)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        if(Auth::id() == $id){
            return redirect('user')->with('message3', 'User cannot delete itself');
        }

        $lims_user_data = User::find($id);
        $lims_user_data->is_deleted = true;
        $lims_user_data->name = 'deleted';
        $lims_user_data->password = 'deleted';
        $lims_user_data->is_active = false;
        $lims_user_data->save();

        return redirect('user')->with('message3', 'Data deleted successfullly');
    }
}
