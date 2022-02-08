<?php

namespace App\Http\Controllers\Admin;

use App\Models\Designation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index()
    {
        $data = [
            'designations' => Designation::all()
        ];

        return view('admin.designation.index')->with($data);
    }

    public function create()
    {
        return view('admin.designation.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        
        Designation::create([
            'name' => $request->name,
        ]);
        $request->session()->flash('success', 'Designation has been successfully added');
        return redirect()->route('admin.designations.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $designation = Designation::findOrFail($id);
        return view('admin.designation.edit')->with('designation', $designation);
    }

    public function update(Request $request, $id)
    {
        $designation = Designation::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
        ]);

        $designation->name = $request->name;
    
        $designation->save();
        $request->session()->flash('success', 'Designation has been successfully updated');
        return redirect()->route('admin.designations.index');
    }

    public function destroy($id)
    {
        $designation = Designation::findOrFail($id);
        $designation->delete();
        request()->session()->flash('success', 'Designation has been successfully deleted!');
        return back();
    }
}
