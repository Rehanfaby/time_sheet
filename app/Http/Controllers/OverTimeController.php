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

class OverTimeController extends Controller
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

    public function generate()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('time-sheet-add')){
            $start_date = date('y-m-01');
            $end_date = date('y-m-d');
            $users = User::where('is_active', true)->where('role_id', 2)->get();
            $staff = User::where('is_active', true)->where('role_id', '!=', 2)->get();

            return view('overtime.generate', compact('users', 'staff', 'start_date', 'end_date'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    private function timeSheetReport()
    {
        return Timesheetreport::where('is_over_time', 1);
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
        return view('overtime.index', compact('reports', 'start_date', 'end_date'));
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
        return view('overtime.signer', compact('reports', 'start_date', 'end_date'));
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
        return view('overtime.approver', compact('reports', 'start_date', 'end_date'));
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
        return view('overtime.approved', compact('reports', 'start_date', 'end_date'));
    }

    public function show($id)
    {
        $data =  Timesheetreport::with('user')->where('id', $id)->first();
        return view('overtime.show', compact('data'));
    }
}
