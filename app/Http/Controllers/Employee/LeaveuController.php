<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;

use App\Leave;
use App\Rules\DateRange;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeaveMail;

class LeaveuController extends Controller
{
    public function index() {
        $employee = Auth::user()->employee;
        $data = [
            'employee' => $employee,
            'leaves' => $employee->leave
        ];
        return view('employee.leaves.index')->with($data);
    }
    public function create() {
        $employee = Auth::user()->employee;
        $data = [
            'employee' => $employee,
            'leave_type' => ['Annual Leave', 'Casual Leave', 'Maternity Leave', 'Paternity Leave', 'Sick Leave', 'Leave without Pay']
        ];

        return view('employee.leaves.create')->with($data);
    }

    public function store(Request $request, $employee_id) {
        $data = [
            'employee' => Auth::user()->employee
        ];

        // dd($data);
        // if($request->input('multiple-days') == 'yes') {
            $this->validate($request, [
                'leave_type' => 'required',
                'description' => 'required',
                // 'date_range' => new DateRange
            ]);
        // } else {
        //     $this->validate($request, [
        //         'leave_type' => 'required',
        //         'description' => 'required'
        //     ]);
        // }
        
        $values = [
            'employee_id' => $employee_id,
            'leave_type' => $request->input('leave_type'),
            'description' => $request->input('description'),
            // 'half_day' => $request->input('half-day')
        ];
        // if($request->input('multiple-days') == 'yes') {
            [$start, $end] = explode(' - ', $request->input('date_range'));
            $values['start_date'] = Carbon::parse($start);
            $values['end_date'] = Carbon::parse($end);
        // } else {
        //     $values['start_date'] = Carbon::parse($request->input('date'));
        // }
        Leave::create($values);

        // dd($values['employee_id']);

        // Mail::to('chonchol57@gmail.com')->send(new LeaveMail($data, $values));

        // \Mail::send('contactMail', array(
        //     'employee_id' => $input['name'],
        //     'email' => $input['email'],
        //     'phone' => $input['phone'],
        //     'subject' => $input['subject'],
        //     'message' => $input['message'],
        // ), function($message) use ($request){
        //     $message->from($request->email);
        //     $message->to('admin@admin.com', 'Admin')->subject($request->get('subject'));
        // });

        $request->session()->flash('success', 'Your Leave has been successfully applied, wait for approval.');
        return redirect()->route('employee.leaves.create')->with($data);
    }

    public function edit($leave_id) {
        $leave = Leave::findOrFail($leave_id);
        Gate::authorize('employee-leaves-access', $leave);
        return view('employee.leaves.edit')->with('leave', $leave);
    }

    public function update(Request $request, $leave_id) {
        $leave = Leave::findOrFail($leave_id);
        Gate::authorize('employee-leaves-access', $leave);
        if($request->input('multiple-days') == 'yes') {
            $this->validate($request, [
                'leave_type' => 'required',
                'description' => 'required',
                'date_range' => new DateRange
            ]);
        } else {
            $this->validate($request, [
                'leave_type' => 'required',
                'description' => 'required'
            ]);
        }

        $leave->leave_type = $request->leave_type;
        $leave->description = $request->description;
        $leave->half_day = $request->input('half-day');
        if($request->input('multiple-days') == 'yes') {
            [$start, $end] = explode(' - ', $request->input('date_range'));
            $start = Carbon::parse($start);
            $end = Carbon::parse($end);
            $leave->start_date = $start;
            $leave->end_date = $end;
        } else {
            $leave->start_date = Carbon::parse($request->input('date'));
        }

        $leave->save();

        $request->session()->flash('success', 'Your leave has been successfully updated');
        return redirect()->route('employee.leaves.index');
    }

    // public function destroy($leave_id) {
    //     $leave = Leave::findOrFail($leave_id);
    //     Gate::authorize('employee-leaves-access', $leave);
    //     $leave->delete();
    //     request()->session()->flash('success', 'Your leave has been successfully deleted');

    //     return redirect()->route('employee.leaves.index');
    // }
}
