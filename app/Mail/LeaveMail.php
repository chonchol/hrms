<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class LeaveMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $values;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $values)
    {
        $this->data = $data;
        $this->values = $values;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');

        $employee_data = DB::table('employees')
                        ->join('users', 'users.id', '=', 'employees.user_id')
                        ->join('departments', 'departments.id', '=', 'employees.department_id')
                        ->select('employees.*', 'users.email', 'departments.name as dept')
                        ->first();

        // dd($employee_data->dept);

        $start = strtotime($this->values['start_date']);
        $end = strtotime($this->values['end_date']);
        $datediff = $end - $start;

        return $this->subject('Leave Application from HAEFA HRM System')
                    ->view('includes.email.index')
                    // ->with('data', $this->data)
                    ->with([
                        'first_name' => $employee_data->first_name,
                        'last_name' => $employee_data->last_name,
                        'designation' => $employee_data->desg,
                        'department' => $employee_data->dept,
                        'email' => $employee_data->email,
                        'mobile' => $employee_data->mobile_no,
                        'leave_type' => $this->values['leave_type'],
                        'description' => $this->values['description'],
                        'start_date' => $this->values['start_date']->format('Y-m-d'),
                        'end_date' => $this->values['end_date']->format('Y-m-d'),
                        // 'resume_work' => $this->values['end_date']->format('Y-m-d')->addDay(),
                        'days_count' => round($datediff / (60 * 60 * 24)),
                    ]);
    }
}
