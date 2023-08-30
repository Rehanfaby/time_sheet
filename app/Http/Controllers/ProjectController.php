<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;

class ProjectController extends Controller
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
        $data = Project::get();
        return view('project.index',compact('data'));
    }

    public function create() {
        return view('project.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'max:255'
            ]
        ]);
        Project::create($request->all());
        return redirect('project')->with('message', 'Project inserted successfully');
    }

    public function edit($id)
    {
        $data = Project::where('id', $id)->first();
        return view('project.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => [
                'max:255'
            ]
        ]);

        $lims_category_data = Project::findOrFail($id);
        $lims_category_data->update($request->all());
        return redirect('project')->with('message', 'Project updated successfully');
    }

    public function destroy($id)
    {
        $lims_category_data = Project::findOrFail($id)->delete();
        return redirect('project')->with('not_permitted', 'Project deleted successfully');
    }
}
