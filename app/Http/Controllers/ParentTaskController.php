<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;

class ParentTaskController extends Controller
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
        $data = Task::where('is_active', true)->get();
        return view('task.index',compact('data'));
    }

    public function create() {
        return view('task.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'max:255'
            ]
        ]);
        Task::create($request->all());
        return redirect('task')->with('message', 'Task inserted successfully');
    }

    public function edit($id)
    {
        $data = Task::where('id', $id)->first();
        return view('task.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => [
                'max:255'
            ]
        ]);

        $lims_category_data = Task::findOrFail($id);
        $lims_category_data->update($request->all());
        return redirect('task')->with('message', 'Task updated successfully');
    }

    public function destroy($id)
    {
        $lims_category_data = Task::where('id', $id)->update(['is_active' => false]);
        return redirect('task')->with('not_permitted', 'Task deleted successfully');
    }
}
