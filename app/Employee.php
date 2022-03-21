<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $dates = ['created_at', 'dob','updated_at', 'join_date'];
    protected $fillable = ['user_id', 'first_name', 'last_name', 'haefaid', 'nid', 'sex', 'dob', 'join_date', 'desg', 'department_id', 'branch_id', 'project_id', 'permanent_add', 'mobile_no', 'salary', 'status', 'resigned_date', 'bank_name', 'bank_ac_name', 'bank_acc_no', 'bank_br_name', 'photo'];
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function department() {
        // return $this->hasOne('App\Department');
        return $this->belongsTo('App\Department');
    }

    public function designation() {
        return $this->belongsTo('App\Models\Designation', 'desg');
    }

    public function attendance() {
        return $this->hasMany('App\Attendance');
    }

    public function leave() {
        return $this->hasMany('App\Leave');
    }

    public function expense() {
        return $this->hasMany('App\Expense');
    }
}
