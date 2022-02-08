<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $data = [
            'branches' => Branch::all()
        ];

        return view('admin.branch.index')->with($data);
    }

    public function create()
    {
        return view('admin.branch.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'branch_add' => 'required'
        ]);
        
        Branch::create([
            'name' => $request->name,
            'branch_add' => $request->branch_add,
        ]);
        $request->session()->flash('success', 'Branch has been successfully added');
        return redirect()->route('admin.branch.index');
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);

        return view('admin.branch.edit')->with('branch', $branch);
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $this->validate($request, [
            'name' => 'required',
            'branch_add' => 'required'
        ]);

        $branch->name = $request->name;
        $branch->branch_add = $request->branch_add;

    
        $branch->save();
        $request->session()->flash('success', 'Branch has been successfully updated');
        return redirect()->route('admin.branch.index');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();
        request()->session()->flash('success', 'Branch has been successfully deleted!');
        return back();
    }
}
