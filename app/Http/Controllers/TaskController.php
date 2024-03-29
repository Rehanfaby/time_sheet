<?php

namespace App\Http\Controllers;

use App\Task;
use App\TimeSheet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;
use Auth;
use DB;

class TaskController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $tasks = Task::where('is_active', true)->get();

        $data = TimeSheet::with('task', 'user')
            ->where('is_active', true)
            ->whereDate('date', '>=', $start_date)
            ->whereDate('date', '<=', $end_date)
            ->orderBy('id', 'desc');


        if (Auth::user()->role_id == 2) {
            $data = $data->where('user_id', Auth::user()->id);
        }

        $data = $data->get();

        return view('tasks.index', compact('data', 'start_date', 'end_date', 'tasks'));
    }

    public function sheetMonthly($year, $month, Request $request)
    {
        $user = Auth::user();
        $role = Role::find($user->role_id);
        if($request->user_id) {
            $user_id = $request->user_id;
        } else {
            $user_id = $user->id;
        }
        if($role->hasPermissionTo('time-sheet-index')){
            $start = 1;
            $color = [];
            $task_data_array = [];
            $number_of_day = date('t', mktime(0, 0, 0, $month, 1, $year));
            while($start <= $number_of_day)
            {
                $task_data_array[$start] = [];
                if($start < 10)
                    $date = $year.'-'.$month.'-0'.$start;
                else
                    $date = $year.'-'.$month.'-'.$start;

                $task_data = TimeSheet::whereDate('date', $date)
                    ->where('user_id', $user_id)
                    ->where('is_active', 1)
                    ->get();

                foreach ($task_data as $task) {
                    $color[$start] = 'green';
                    $task_data_array[$start][] = @$task->task->name . ' * ' . $task->hours;
                }
                $start++;
            }
            $start_day = date('w', strtotime($year.'-'.$month.'-01')) + 1;
            $prev_year = date('Y', strtotime('-1 month', strtotime($year.'-'.$month.'-01')));
            $prev_month = date('m', strtotime('-1 month', strtotime($year.'-'.$month.'-01')));
            $next_year = date('Y', strtotime('+1 month', strtotime($year.'-'.$month.'-01')));
            $next_month = date('m', strtotime('+1 month', strtotime($year.'-'.$month.'-01')));
            if($role->id == 2) {
                $lims_user_list = [$user];
            } else {
                $lims_user_list = User::where('role_id', 2)->where('is_active', 1)->get();
            }
            return view('tasks.index-monthly', compact('color', 'task_data_array', 'lims_user_list', 'start_day', 'year', 'month', 'number_of_day', 'prev_year', 'prev_month', 'next_year', 'next_month', 'user_id'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('time-sheet-add')){
            $tasks = Task::where('is_active', true)->get();

            return view('tasks.create', compact('tasks'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->task as $key => $task) {
            $task_row = $request->task[$key];
             if($request->task[$key] == 0) {
                 $task_row = DB::table('tasks')->insertGetId([
                     'name'=> $request->new_task[$key],
                     'is_active' => 1,
                     'order' => 0,
                     'created_at' => date('Y-m-d H:i:s')
                 ]);
             }
             TimeSheet::create([
                 'user_id' => Auth::user()->id,
                 'task_id' => $task_row,
                 'hours' => $request->hour[$key],
                 'date' => $request->date[$key],
                 'is_active' => 1,
             ]);
        }


        return back()->with('message', 'Tasks added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        dd($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {

        $task_row = $request->task;
        if($task_row == 0) {
            $task_row = DB::table('tasks')->insertGetId([
                'name'=> $request->new_task,
                'is_active' => 1,
                'order' => 0
            ]);
        }

        TimeSheet::find($request->task_id)->update([
            'task_id' => $task_row,
            'hours' => $request->hour,
            'date' => $request->date,
        ]);

        return back()->with('message', 'Tasks updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }

    public function clone(Request $request) {

        if($request->start_date) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
        }

        $tasks = Task::where('is_active', true)->get();

        $data = TimeSheet::select('id', 'user_id', 'task_id', 'hours', 'date')
            ->where('user_id', Auth::user()->id)
            ->where('is_active', true)
            ->whereDate('date', '>=', $start_date)
            ->whereDate('date', '<=', $end_date)
            ->orderBy('id', 'desc')
            ->get();

        return $data;

    }
}
