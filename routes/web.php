<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LeaveController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\DesignationController;
// use App\Http\Controllers\Admin\NoticeController;

use App\Http\Controllers\Employee\EmployeeuController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Employee\LeaveuController;
use App\Http\Controllers\Employee\ExpenseuController;
use App\Http\Controllers\Employee\SelfController;


Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware(['auth','can:admin-access'])->group(function () {

    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/reset-password', [AdminController::class, 'reset_password'])->name('reset-password');
    Route::put('/update-password', [AdminController::class, 'update_password'])->name('update-password');

    // Routes for employees //
    Route::get('/employees/list-employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/add-employee', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/attendance', [EmployeeController::class, 'attendance'])->name('employees.attendance');
    Route::post('/employees/attendance', [EmployeeController::class, 'attendance'])->name('employees.attendance');
    Route::delete('/employees/attendance/{attendance_id}', [EmployeeController::class, 'attendanceDelete'])->name('employees.attendance.delete');
    Route::get('/employees/profile/{employee_id}', [EmployeeController::class, 'employeeProfile'])->name('employees.profile');
    Route::delete('/employees/{employee_id}', [EmployeeController::class, 'destroy'])->name('employees.delete');

    // Routes for leaves //   
    Route::get('/leaves/list-leaves', [LeaveController::class, 'index'])->name('leaves.index');
    Route::put('/leaves/{leave_id}', [LeaveController::class, 'update'])->name('leaves.update');

    // Routes for expenses //
    Route::get('/expenses/list-expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::put('/expenses/{expense_id}', [ExpenseController::class, 'update'])->name('expenses.update');

    // Routes for holidays //
    Route::get('/holidays/list-holidays', [HolidayController::class, 'index'])->name('holidays.index');
    Route::get('/holidays/add-holiday', [HolidayController::class, 'create'])->name('holidays.create');
    Route::post('/holidays', [HolidayController::class, 'store'])->name('holidays.store');
    Route::get('/holidays/edit-holiday/{holiday_id}', [HolidayController::class, 'edit'])->name('holidays.edit');
    Route::put('/holidays/{holiday_id}', [HolidayController::class, 'update'])->name('holidays.update');
    Route::delete('/holidays/{holiday_id}', [HolidayController::class, 'destroy'])->name('holidays.delete');

    // Routes for Branch
    Route::get('/branch/list-branch', [BranchController::class, 'index'])->name('branch.index');
    Route::get('/branch/add-branch', [BranchController::class, 'create'])->name('branch.create');
    Route::post('/branch', [BranchController::class, 'store'])->name('branch.store');
    Route::get('/branch/edit-branch/{branch_id}', [BranchController::class, 'edit'])->name('branch.edit');
    Route::put('/branch/{branch_id}', [BranchController::class, 'update'])->name('branch.update');
    Route::delete('/branch/{branch_id}', [BranchController::class, 'destroy'])->name('branch.delete');

    // Routes for Department
    Route::resource('/departments', '\App\Http\Controllers\Admin\DepartmentController');
    // Routes for Designation
    Route::resource('/designations', '\App\Http\Controllers\Admin\DesignationController');
    // Routes for Designation
    Route::resource('/projects', '\App\Http\Controllers\Admin\ProjectController');
 
});

Route::namespace('Employee')->prefix('employee')->name('employee.')->middleware(['auth','can:employee-access'])->group(function () {
    Route::get('/', [EmployeeuController::class, 'index'])->name('index');
    Route::get('/profile', [EmployeeuController::class, 'profile'])->name('profile');
    Route::get('/profile-edit/{employee_id}', [EmployeeuController::class, 'profile_edit'])->name('profile-edit');
    Route::put('/profile/{employee_id}', [EmployeeuController::class, 'profile_update'])->name('profile-update');
    // Routes for Attendances //
    Route::get('/attendance/list-attendances', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/list-attendances', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/get-location', [AttendanceController::class, 'location'])->name('attendance.get-location');
    Route::get('/attendance/register', [AttendanceController::class, 'create'])->name('attendance.create');
    Route::post('/attendance/{employee_id}', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::put('/attendance/{attendance_id}', [AttendanceController::class, 'update'])->name('attendance.update');

    // Routes for Leaves //
    Route::get('/leaves/apply', [LeaveuController::class, 'create'])->name('leaves.create');
    Route::get('/leaves/list-leaves', [LeaveuController::class, 'index'])->name('leaves.index');
    Route::post('/leaves/{employee_id}', [LeaveuController::class, 'store'])->name('leaves.store');
    Route::get('/leaves/edit-leave/{leave_id}', [LeaveuController::class, 'edit'])->name('leaves.edit');
    Route::put('/leaves/{leave_id}', [LeaveuController::class, 'update'])->name('leaves.update');
    // Route::delete('/leaves/{leave_id}', [LeaveuController::class, 'destroy'])->name('leaves.delete');

    // Routes for Expenses//
    Route::get('/expenses/list-expenses', [ExpenseuController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/claim-expense', [ExpenseuController::class, 'create'])->name('expenses.create');
    Route::post('/expenses/{employee_id}', [ExpenseuController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/edit-expense/{expense_id}', [ExpenseuController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expense_id}', [ExpenseuController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense_id}', [ExpenseuController::class, 'destroy'])->name('expenses.delete');

    // Routes for Self //
    Route::get('/self/holidays', [SelfController::class, 'holidays'])->name('self.holidays');
    Route::get('/self/salary_slip', [SelfController::class, 'salary_slip'])->name('self.salary_slip');
    Route::get('/self/salary_slip_print', [SelfController::class, 'salary_slip_print'])->name('self.salary_slip_print');
});