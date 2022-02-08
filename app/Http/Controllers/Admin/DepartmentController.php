<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        $data = [
            'departments' => Department::all()
        ];

        return view('admin.department.index')->with($data);
    }

    public function create()
    {
        return view('admin.department.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        
        Department::create([
            'name' => $request->name,
        ]);
        $request->session()->flash('success', 'Department has been successfully added');
        return redirect()->route('admin.departments.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.department.edit')->with('department', $department);
    }

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
        ]);

        $department->name = $request->name;
    
        $department->save();
        $request->session()->flash('success', 'Department has been successfully updated');
        return redirect()->route('admin.departments.index');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        request()->session()->flash('success', 'Department has been successfully deleted!');
        return back();
    }
}
