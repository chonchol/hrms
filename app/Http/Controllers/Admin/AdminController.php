<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

class AdminController extends Controller
{
    public function index() {
        $total_employee = DB::table('employees')->count();
        $leave_pending = DB::table('leaves')->where('status', '=', 'pending')->count();
        $todays_attendee = DB::table('attendances')->whereDate('created_at', '=', date('Y-m-d'))->count();
        // dd($todays_attendee);
        return view('admin.index', compact('total_employee', 'leave_pending', 'todays_attendee'));
    }

    public function reset_password() {
        return view('auth.reset-password');
    }

    public function update_password(Request $request) {
        $user = Auth::user();
        dd($user->password);
        if($user->password == Hash::make($request->old_password)) {
            dd($request->all());
        } else {
            $request->session()->flash('error', 'Wrong Password');
            return back();
        }
    }
}
