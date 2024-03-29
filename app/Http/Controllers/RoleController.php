<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;
use App\User;
use Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
       if(Auth::user()->role_id <= 2) {
            $lims_role_all = Roles::where('is_active', true)->get();
            return view('role.create', compact('lims_role_all'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }


    public function create()
    {

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'max:255',
                    Rule::unique('roles')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
        ]);

        $data = $request->all();
        Roles::create($data);
        return redirect('role')->with('message', 'Data inserted successfully');
    }

    public function edit($id)
    {
        if(Auth::user()->role_id <= 2) {
            $lims_role_data = Roles::find($id);
            return $lims_role_data;
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'max:255',
                Rule::unique('roles')->ignore($request->role_id)->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
        ]);

        $input = $request->all();
        $lims_role_data = Roles::where('id', $input['role_id'])->first();
        $lims_role_data->update($input);
        return redirect('role')->with('message', 'Data updated successfully');
    }

    public function permission($id)
    {
        if(Auth::user()->role_id <= 2) {
            $lims_role_data = Roles::find($id);
            $permissions = Role::findByName($lims_role_data->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if(empty($all_permission))
                $all_permission[] = 'dummy text';
            return view('role.permission', compact('lims_role_data', 'all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function setPermission(Request $request)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $role = Role::firstOrCreate(['id' => $request['role_id']]);

        if($request->has('task-index')){
            $permission = Permission::firstOrCreate(['name' => 'task-index']);
            if(!$role->hasPermissionTo('task-index')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('task-index');

        if($request->has('task-add')){
            $permission = Permission::firstOrCreate(['name' => 'task-add']);
            if(!$role->hasPermissionTo('task-add')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('task-add');

        if($request->has('task-edit')){
            $permission = Permission::firstOrCreate(['name' => 'task-edit']);
            if(!$role->hasPermissionTo('task-edit')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('task-edit');

        if($request->has('task-delete')){
            $permission = Permission::firstOrCreate(['name' => 'task-delete']);
            if(!$role->hasPermissionTo('task-delete')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('task-delete');

        if($request->has('time-sheet-index')){
            $permission = Permission::firstOrCreate(['name' => 'time-sheet-index']);
            if(!$role->hasPermissionTo('time-sheet-index')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('time-sheet-index');

        if($request->has('time-sheet-add')){
            $permission = Permission::firstOrCreate(['name' => 'time-sheet-add']);
            if(!$role->hasPermissionTo('time-sheet-add')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('time-sheet-add');

        if($request->has('time-sheet-edit')){
            $permission = Permission::firstOrCreate(['name' => 'time-sheet-edit']);
            if(!$role->hasPermissionTo('time-sheet-edit')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('time-sheet-edit');

        if($request->has('time-sheet-delete')){
            $permission = Permission::firstOrCreate(['name' => 'time-sheet-delete']);
            if(!$role->hasPermissionTo('time-sheet-delete')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('time-sheet-delete');

        if($request->has('timesheet_generate')){
            $permission = Permission::firstOrCreate(['name' => 'timesheet_generate']);
            if(!$role->hasPermissionTo('timesheet_generate')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('timesheet_generate');


        if($request->has('timesheet_report')){
            $permission = Permission::firstOrCreate(['name' => 'timesheet_report']);
            if(!$role->hasPermissionTo('timesheet_report')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('timesheet_report');


        if($request->has('timesheet_approve')){
            $permission = Permission::firstOrCreate(['name' => 'timesheet_approve']);
            if(!$role->hasPermissionTo('timesheet_approve')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('timesheet_approve');


        if($request->has('timesheet_sign')){
            $permission = Permission::firstOrCreate(['name' => 'timesheet_sign']);
            if(!$role->hasPermissionTo('timesheet_sign')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('timesheet_sign');


        if($request->has('timesheet_delete')){
            $permission = Permission::firstOrCreate(['name' => 'timesheet_delete']);
            if(!$role->hasPermissionTo('timesheet_delete')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('timesheet_delete');



        if($request->has('over_time_generate')){
            $permission = Permission::firstOrCreate(['name' => 'over_time_generate']);
            if(!$role->hasPermissionTo('over_time_generate')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('over_time_generate');


        if($request->has('over_time_report')){
            $permission = Permission::firstOrCreate(['name' => 'over_time_report']);
            if(!$role->hasPermissionTo('over_time_report')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('over_time_report');


        if($request->has('over_time_approve')){
            $permission = Permission::firstOrCreate(['name' => 'over_time_approve']);
            if(!$role->hasPermissionTo('over_time_approve')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('over_time_approve');


        if($request->has('over_time_sign')){
            $permission = Permission::firstOrCreate(['name' => 'over_time_sign']);
            if(!$role->hasPermissionTo('over_time_sign')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('over_time_sign');


        if($request->has('over_time_delete')){
            $permission = Permission::firstOrCreate(['name' => 'over_time_delete']);
            if(!$role->hasPermissionTo('over_time_delete')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('over_time_delete');


        if($request->has('one_time_otp')){
            $permission = Permission::firstOrCreate(['name' => 'one_time_otp']);
            if(!$role->hasPermissionTo('one_time_otp')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('one_time_otp');


        if($request->has('mission-order-index')){
            $permission = Permission::firstOrCreate(['name' => 'mission-order-index']);
            if(!$role->hasPermissionTo('mission-order-index')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('mission-order-index');

        if($request->has('mission-order-add')){
            $permission = Permission::firstOrCreate(['name' => 'mission-order-add']);
            if(!$role->hasPermissionTo('mission-order-add')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('mission-order-add');

        if($request->has('mission-order-edit')){
            $permission = Permission::firstOrCreate(['name' => 'mission-order-edit']);
            if(!$role->hasPermissionTo('mission-order-edit')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('mission-order-edit');

        if($request->has('mission-order-delete')){
            $permission = Permission::firstOrCreate(['name' => 'mission-order-delete']);
            if(!$role->hasPermissionTo('mission-order-delete')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('mission-order-delete');

//        if($request->has('mission-order-sign')){
//            $permission = Permission::firstOrCreate(['name' => 'mission-order-sign']);
//            if(!$role->hasPermissionTo('mission-order-sign')){
//                $role->givePermissionTo($permission);
//            }
//        }
//        else
//            $role->revokePermissionTo('mission-order-sign');

        if($request->has('mission-order-approve')){
            $permission = Permission::firstOrCreate(['name' => 'mission-order-approve']);
            if(!$role->hasPermissionTo('mission-order-approve')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('mission-order-approve');


        if($request->has('votes-index')){
            $permission = Permission::firstOrCreate(['name' => 'votes-index']);
            if(!$role->hasPermissionTo('votes-index')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('votes-index');

        if($request->has('votes-add')){
            $permission = Permission::firstOrCreate(['name' => 'votes-add']);
            if(!$role->hasPermissionTo('votes-add')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('votes-add');

        if($request->has('votes-edit')){
            $permission = Permission::firstOrCreate(['name' => 'votes-edit']);
            if(!$role->hasPermissionTo('votes-edit')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('votes-edit');

        if($request->has('votes-delete')){
            $permission = Permission::firstOrCreate(['name' => 'votes-delete']);
            if(!$role->hasPermissionTo('votes-delete')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('votes-delete');

        if($request->has('projects-index')){
            $permission = Permission::firstOrCreate(['name' => 'projects-index']);
            if(!$role->hasPermissionTo('projects-index')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('projects-index');

        if($request->has('projects-add')){
            $permission = Permission::firstOrCreate(['name' => 'projects-add']);
            if(!$role->hasPermissionTo('projects-add')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('projects-add');

        if($request->has('projects-edit')){
            $permission = Permission::firstOrCreate(['name' => 'projects-edit']);
            if(!$role->hasPermissionTo('projects-edit')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('projects-edit');

        if($request->has('projects-delete')){
            $permission = Permission::firstOrCreate(['name' => 'projects-delete']);
            if(!$role->hasPermissionTo('projects-delete')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('projects-delete');


        if($request->has('regions-index')){
            $permission = Permission::firstOrCreate(['name' => 'regions-index']);
            if(!$role->hasPermissionTo('regions-index')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('regions-index');

        if($request->has('regions-add')){
            $permission = Permission::firstOrCreate(['name' => 'regions-add']);
            if(!$role->hasPermissionTo('regions-add')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('regions-add');

        if($request->has('regions-edit')){
            $permission = Permission::firstOrCreate(['name' => 'regions-edit']);
            if(!$role->hasPermissionTo('regions-edit')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('regions-edit');

        if($request->has('regions-delete')){
            $permission = Permission::firstOrCreate(['name' => 'regions-delete']);
            if(!$role->hasPermissionTo('regions-delete')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('regions-delete');


        if($request->has('coins-index')){
            $permission = Permission::firstOrCreate(['name' => 'coins-index']);
            if(!$role->hasPermissionTo('coins-index')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('coins-index');

        if($request->has('coins-add')){
            $permission = Permission::firstOrCreate(['name' => 'coins-add']);
            if(!$role->hasPermissionTo('coins-add')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('coins-add');

        if($request->has('coins-edit')){
            $permission = Permission::firstOrCreate(['name' => 'coins-edit']);
            if(!$role->hasPermissionTo('coins-edit')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('coins-edit');

        if($request->has('coins-delete')){
            $permission = Permission::firstOrCreate(['name' => 'coins-delete']);
            if(!$role->hasPermissionTo('coins-delete')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('coins-delete');


        if($request->has('see-votes')){
            $permission = Permission::firstOrCreate(['name' => 'see-votes']);
            if(!$role->hasPermissionTo('see-votes')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('see-votes');


        if($request->has('expenses-index')){
            $permission = Permission::firstOrCreate(['name' => 'expenses-index']);
            if(!$role->hasPermissionTo('expenses-index')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('expenses-index');

        if($request->has('expenses-add')){
            $permission = Permission::firstOrCreate(['name' => 'expenses-add']);
            if(!$role->hasPermissionTo('expenses-add')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('expenses-add');

        if($request->has('expenses-edit')){
            $permission = Permission::firstOrCreate(['name' => 'expenses-edit']);
            if(!$role->hasPermissionTo('expenses-edit')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('expenses-edit');

        if($request->has('expenses-delete')){
            $permission = Permission::firstOrCreate(['name' => 'expenses-delete']);
            if(!$role->hasPermissionTo('expenses-delete')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('expenses-delete');

        if($request->has('account-index')){
            $permission = Permission::firstOrCreate(['name' => 'account-index']);
            if(!$role->hasPermissionTo('account-index')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('account-index');

        if($request->has('department')){
            $permission = Permission::firstOrCreate(['name' => 'department']);
            if(!$role->hasPermissionTo('department')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('department');


        if($request->has('employees-index')){
            $permission = Permission::firstOrCreate(['name' => 'employees-index']);
            if(!$role->hasPermissionTo('employees-index')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('employees-index');

        if($request->has('employees-add')){
            $permission = Permission::firstOrCreate(['name' => 'employees-add']);
            if(!$role->hasPermissionTo('employees-add')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('employees-add');

        if($request->has('employees-edit')){
            $permission = Permission::firstOrCreate(['name' => 'employees-edit']);
            if(!$role->hasPermissionTo('employees-edit')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('employees-edit');

        if($request->has('employees-delete')){
            $permission = Permission::firstOrCreate(['name' => 'employees-delete']);
            if(!$role->hasPermissionTo('employees-delete')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('employees-delete');

        if($request->has('users-index')){
            $permission = Permission::firstOrCreate(['name' => 'users-index']);
            if(!$role->hasPermissionTo('users-index')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('users-index');

        if($request->has('users-add')){
            $permission = Permission::firstOrCreate(['name' => 'users-add']);
            if(!$role->hasPermissionTo('users-add')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('users-add');

        if($request->has('users-edit')){
            $permission = Permission::firstOrCreate(['name' => 'users-edit']);
            if(!$role->hasPermissionTo('users-edit')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('users-edit');

        if($request->has('users-delete')){
            $permission = Permission::firstOrCreate(['name' => 'users-delete']);
            if(!$role->hasPermissionTo('users-delete')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('users-delete');


        if($request->has('general_setting')){
            $permission = Permission::firstOrCreate(['name' => 'general_setting']);
            if(!$role->hasPermissionTo('general_setting')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('general_setting');


//        if($request->has('sms_setting')){
//            $permission = Permission::firstOrCreate(['name' => 'sms_setting']);
//            if(!$role->hasPermissionTo('sms_setting')){
//                $role->givePermissionTo($permission);
//            }
//        }
//        else
//            $role->revokePermissionTo('sms_setting');
//
//        if($request->has('create_sms')){
//            $permission = Permission::firstOrCreate(['name' => 'create_sms']);
//            if(!$role->hasPermissionTo('create_sms')){
//                $role->givePermissionTo($permission);
//            }
//        }
//        else
//            $role->revokePermissionTo('create_sms');



        if($request->has('dashboard')){
            $permission = Permission::firstOrCreate(['name' => 'dashboard']);
            if(!$role->hasPermissionTo('dashboard')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('dashboard');

        if($request->has('send_notification')){
            $permission = Permission::firstOrCreate(['name' => 'send_notification']);
            if(!$role->hasPermissionTo('send_notification')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('send_notification');


        if($request->has('currency')){
            $permission = Permission::firstOrCreate(['name' => 'currency']);
            if(!$role->hasPermissionTo('currency')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('currency');


        if($request->has('vote-report')){
            $permission = Permission::firstOrCreate(['name' => 'vote-report']);
            if(!$role->hasPermissionTo('vote-report')){
                $role->givePermissionTo($permission);
            }
        }
        else
            $role->revokePermissionTo('vote-report');



        return redirect('role')->with('message', 'Permission updated successfully');
    }

    public function destroy($id)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');
        $lims_role_data = Roles::find($id);
        $lims_role_data->is_active = false;
        $lims_role_data->save();
        return redirect('role')->with('not_permitted', 'Data deleted successfully');
    }
}
