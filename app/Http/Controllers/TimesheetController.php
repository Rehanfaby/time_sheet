<?php

namespace App\Http\Controllers;

use App\Task;
use App\TimeSheet;
use App\Timesheetreport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;
use function GuzzleHttp\Psr7\str;

class TimesheetController extends Controller
{
    private $user;

    public function __construct() {


        $this->middleware(function ($request, $next) {
            $this->user = \Illuminate\Support\Facades\Auth::user();
            $role = Role::find($this->user->role_id);
            $permissions = Role::findByName($role->name)->permissions;

            foreach ($permissions as $permission) {
                $all_permission[] = $permission->name;
            }
            View::share ( 'all_permission', $all_permission);

            return $next($request);
        });
    }

    private function timeSheetReport()
    {
        return Timesheetreport::where('is_over_time', 0);
    }

    public function generate()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('timesheet_generate')){
            $start_date = date('y-m-01');
            $end_date = date('y-m-d');
            if ($role->id == 2) {
                $users = User::where('id', Auth::user()->id)->get();
            } else {
                $users = User::where('is_active', true)->where('role_id', 2)->get();
            }
            $staff = User::where('is_active', true)->where('role_id', '!=', 2)->get();

            return view('timesheet.generate', compact('users', 'staff', 'start_date', 'end_date'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function generateStore(Request $request)
    {
        if (!empty($request->users)) {
            foreach ($request->users as $user) {
                $data = TimeSheet::where('is_active', true)
                    ->whereDate('date', '>=', $request->start_date)
                    ->whereDate('date', '<=', $request->end_date)
                    ->where('user_id', $user);

                $user_data = User::where('id', $user)->first();
                $working_days = $this->workingDays($user_data->weak_start, $request->start_date, $request->end_date);
                $expected_working_days = $working_days * 8;
                $total_working_days = $data->sum('hours');
                $over_time = 0;
                if ($expected_working_days < $total_working_days) {
                    $over_time = $total_working_days - $expected_working_days;
                }
                if ($request->report_type == 0) {
                    Timesheetreport::create([
                        'name' => str_replace(' ', '', ($user_data->name)) . ' - ' . $request->start_date . ' - ' . $request->end_date,
                        'user_id' => $user,
                        'expected_hours' => $expected_working_days,
                        'total_hours' => $total_working_days,
                        'over_time' => $over_time,
                        'staff' => $request->staffs != null ? implode(',', $request->staffs) : null,
                        'from' => $request->start_date,
                        'to' => $request->end_date,
                        'description' => $request->description
                    ]);
                } elseif ($request->report_type == 1){
                    Timesheetreport::create([
                        'name' => str_replace(' ', '', ($user_data->name)) . ' - ' . $request->start_date . ' - ' . $request->end_date,
                        'user_id' => $user,
                        'expected_hours' => $expected_working_days,
                        'total_hours' => $total_working_days,
                        'over_time' => $over_time,
                        'staff' => $request->staffs != null ? implode(',', $request->staffs) : null,
                        'from' => $request->start_date,
                        'to' => $request->end_date,
                        'description' => $request->description,
                        'is_over_time' => 1,
                    ]);
                } elseif ($request->report_type == 2){
                    Timesheetreport::create([
                        'name' => str_replace(' ', '', ($user_data->name)) . ' - ' . $request->start_date . ' - ' . $request->end_date,
                        'user_id' => $user,
                        'expected_hours' => $expected_working_days,
                        'total_hours' => $total_working_days,
                        'over_time' => $over_time,
                        'staff' => $request->staffs != null ? implode(',', $request->staffs) : null,
                        'from' => $request->start_date,
                        'to' => $request->end_date,
                        'description' => $request->description
                    ]);
                    Timesheetreport::create([
                        'name' => str_replace(' ', '', ($user_data->name)) . ' - ' . $request->start_date . ' - ' . $request->end_date,
                        'user_id' => $user,
                        'expected_hours' => $expected_working_days,
                        'total_hours' => $total_working_days,
                        'over_time' => $over_time,
                        'staff' => $request->staffs != null ? implode(',', $request->staffs) : null,
                        'from' => $request->start_date,
                        'to' => $request->end_date,
                        'description' => $request->description,
                        'is_over_time' => 1,
                    ]);
                }

            }
        }

        return back()->with('message', 'Reports has been generated');
    }

    public function multipleApprove(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('timesheet_approve')) {
            if ($request->employeeIdArray != null) {
                foreach ($request->employeeIdArray as $id) {
                    if ($id == null) {
                        continue;
                    }
                    Timesheetreport::where('id', $id)->update(['is_approve' => 1, 'approved_by' => Auth::user()->id]);
                }
                return 'Selected time sheet reports has been approved successfully!';
            }
        }
        return "Sorry, You don't have permissions";
    }

    public function multipleSign(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('timesheet_sign')) {
            if ($request->employeeIdArray != null) {
                foreach ($request->employeeIdArray as $id) {
                    if ($id == null) {
                        continue;
                    }
                    Timesheetreport::where('id', $id)->update(['is_sign' => 1, 'signed_by' => Auth::user()->id]);
                }
                return 'Selected time sheet reports has been Signed successfully!';
            }
        }
        return "Sorry, You don't have permissions";
    }

    public function multipleRemove(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('timesheet_delete')) {
            if ($request->employeeIdArray != null) {
                foreach ($request->employeeIdArray as $id) {
                    if ($id == null) {
                        continue;
                    }
                    Timesheetreport::where('id', $id)->delete();
                }
                return 'Selected Data has been deleted successfully!';
            }
        }
        return "Sorry, You don't have permissions";
    }

    public function workingDays($working_days, $start, $end)
    {
        $total_working_days = 0;
        $startTimestamp = strtotime($start);
        $endTimestamp = strtotime($end);

        for ($currentTimestamp = $startTimestamp; $currentTimestamp <= $endTimestamp; $currentTimestamp += 86400) {
            $dayName = date('l', $currentTimestamp);
            if (in_array(strtolower($dayName), explode(',', $working_days))) {
                $total_working_days++;
            }
        }
        return $total_working_days;
    }

    public function index(Request $request)
    {
        if($request->start_date) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        }
        else {
            $start_date = '2023-07-01';
            $end_date = date('Y-m-d');
        }

        $reports = $this->timeSheetReport()->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)->orderByDesc('id')->get();
        return view('timesheet.index', compact('reports', 'start_date', 'end_date'));
    }

    public function signer(Request $request)
    {
        if($request->start_date) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        }
        else {
            $start_date = '2023-07-01';
            $end_date = date('Y-m-d');
        }

        $reports = $this->timeSheetReport()->where('is_sign', 0)->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)->orderByDesc('id')->get();
        return view('timesheet.signer', compact('reports', 'start_date', 'end_date'));
    }

    public function approver(Request $request)
    {
        if($request->start_date) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        }
        else {
            $start_date = '2023-07-01';
            $end_date = date('Y-m-d');
        }

        $reports = $this->timeSheetReport()->where('is_approve', 0)->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)->orderByDesc('id')->get();
        return view('timesheet.approver', compact('reports', 'start_date', 'end_date'));
    }

    public function approved(Request $request)
    {
        if($request->start_date) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        }
        else {
            $start_date = '2023-07-01';
            $end_date = date('Y-m-d');
        }

        $reports = $this->timeSheetReport()->where('is_sign', 1)->where('is_approve', 1)->whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)->orderByDesc('id')->get();
        return view('timesheet.approved', compact('reports', 'start_date', 'end_date'));
    }

    public function destroy($id)
    {
        Timesheetreport::where('id', $id)->delete();
        return back()->with('not_permitted', 'Data has been deleted');
    }

    public function show($id)
    {
        $data =  Timesheetreport::with('user')->where('id', $id)->first();
        return view('timesheet.show', compact('data'));
    }

    public function approve($id)
    {
        Timesheetreport::where('id', $id)->update(['is_approve' => 1, 'approved_by' => Auth::user()->id]);
        return back()->with('message', 'Report has been approved');
    }

    public function sign($id)
    {
        Timesheetreport::where('id', $id)->update(['is_sign' => 1, 'signed_by' => Auth::user()->id]);
        return back()->with('message', 'Report has been signed');
    }
}
