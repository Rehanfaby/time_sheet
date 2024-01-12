<?php

namespace App\Http\Controllers;

use App\Mission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;
use PDF;

class MissionController extends Controller
{
    public function __construct() {

        $this->middleware(function ($request, $next) {
            $role = Role::find(Auth::user()->role_id);
            $permissions = Role::findByName($role->name)->permissions;

            foreach ($permissions as $permission) {
                $all_permission[] = $permission->name;
            }
            View::share ( 'all_permission', $all_permission);

            return $next($request);
        });
    }

    public function index()
    {
        if (Auth::user()->role_id == 2) {
            $data = Mission::orderByDesc('id')->where('created_by', Auth::user()->id)->get();
        } else {
            $data = Mission::orderByDesc('id')->get();
        }
        return view('mission.index',compact('data'));
    }

    public function create() {
        $users = User::where('is_active', 1)->get();
        return view('mission.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['traveler'] = implode(',', $data['traveler']);
        Mission::create($data);
        return redirect('mission')->with('message', 'Mission inserted successfully');
    }

    public function edit($id)
    {
        $data = Mission::where('id', $id)->first();
        $users = User::where('is_active', 1)->get();
        return view('mission.edit',compact('data', 'users'));
    }

    public function show($id)
    {
        $data = Mission::where('id', $id)->first();
        return view('mission.show',compact('data'));
    }

    public function approve($id, $status)
    {
        Mission::where('id', $id)->update(['status' => $status, 'approve_by' => Auth::user()->id, 'approve_on' => date('Y-m-d H:i:s')]);
        if($status == 1) {
            $msg = "Mission order approved successfuly";
        } else {
            $msg = "Mission order rejected successfuly";
        }
        return redirect('mission')->with('message', $msg);
    }

    public function multipleApprove(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('mission-order-approve')) {
            if ($request->employeeIdArray != null) {
                foreach ($request->employeeIdArray as $id) {
                    if ($id == null) {
                        continue;
                    }
                    Mission::where('id', $id)->update(['status' => 1, 'approve_by' => Auth::user()->id, 'approve_on' => date('Y-m-d H:i:s')]);
                }
                return 'Selected Mission Order has been approved successfully!';
            }
        }
        return "Sorry, You don't have permissions";
    }

    public function multipleRemove(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('mission-order-delete')) {
            if ($request->employeeIdArray != null) {
                foreach ($request->employeeIdArray as $id) {
                    if ($id == null) {
                        continue;
                    }
                    Mission::findOrFail($id)->delete();
                }
                return 'Selected Missions Order has been deleted successfully!';
            }
        }
        return "Sorry, You don't have permissions";
    }


    public function print($id) {
        $mission = Mission::where('id', $id)->first();

        $data = [
            'data' => $mission,
        ];

        $pdf = PDF::loadView('pdf.mission_order', $data)->setPaper('A4', 'portrait');
        return $pdf->stream('letter.pdf');

    }

    public function update(Request $request, $id)
    {
        $lims_category_data = Mission::findOrFail($id);
        $data = $request->all();

        $data['traveler'] = implode(',', $data['traveler']);
        $lims_category_data->update($data);
        return redirect('mission')->with('message', 'Mission updated successfully');
    }

    public function destroy($id)
    {
        $lims_category_data = Mission::findOrFail($id)->delete();
        return redirect('mission')->with('not_permitted', 'Mission deleted successfully');
    }
}
