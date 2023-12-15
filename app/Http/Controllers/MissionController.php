<?php

namespace App\Http\Controllers;

use App\Mission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;

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
        $data = Mission::get();
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
        $data = Mission::findOrFail($id)->first();
        return view('mission.show',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $lims_category_data = Mission::findOrFail($id);
        $data = $request->all();
        if($data['status'] != 0) {
            $data['approve_by'] = Auth::user()->id;
        }

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