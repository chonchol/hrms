@extends('layouts.app')        

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Add Employee</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Add Employee
                    </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5>Add new employee</h5>
                    </div>
                    @include('messages.alerts')
                    <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                    <div class="card-body">
                            <fieldset>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">First Name<span style="color:red">*</span></label>
                                        <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control">
                                        @error('first_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Last Name<span style="color:red">*</span></label>
                                        <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control">
                                        @error('last_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">Email<span style="color:red">*</span></label>
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                                        @error('email')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="dob">Date of Birth<span style="color:red">*</span></label>
                                        <input type="text" name="dob" id="dob" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">Gender<span style="color:red">*</span></label>
                                        <select name="sex" class="form-control">
                                            <option hidden disabled selected value> -- select an option -- </option>
                                            @if (old('sex') == 'Male')
                                            <option value="Male" selected>Male</option>
                                            <option value="Female">Female</option>
                                            @elseif (old('sex') == 'Female')
                                            <option value="Male">Male</option>
                                            <option value="Female" selected>Female</option>
                                            @else
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            @endif
                                        </select>
                                        @error('sex')
                                            <div class="text-danger">
                                                Please select an valid option
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="join_date">Joining Date<span style="color:red">*</span></label>
                                        <input type="text" name="join_date" id="join_date" class="form-control">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">Branch<span style="color:red">*</span></label>
                                        <select name="branch_id" class="form-control">
                                            <option hidden disabled selected value> -- select an option -- </option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}"
                                                @if (old('id') == $branch->id)
                                                    selected
                                                @endif
                                                >
                                                    {{ $branch->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('branch')
                                        <div class="text-danger">
                                            Please select an valid option
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Project Name</label>
                                        <select name="project_id" class="form-control">
                                            <option hidden disabled selected value> -- select an option -- </option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}"
                                                @if (old('id') == $project->id)
                                                    selected
                                                @endif
                                                >
                                                    {{ $project->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('project')
                                        <div class="text-danger">
                                            Please select an valid option
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">Designation<span style="color:red">*</span></label>
                                        <select name="desg" class="form-control">
                                            <option hidden disabled selected value> -- select an option -- </option>
                                            @foreach ($desgs as $desg)
                                                <option value="{{ $desg->id }}"
                                                @if (old('id') == $desg->id)
                                                    selected
                                                @endif
                                                >
                                                    {{ $desg->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('desg')
                                        <div class="text-danger">
                                            Please select an valid option
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">Department</label>
                                        <select name="department_id" class="form-control">
                                            <option hidden disabled selected value> -- select an option -- </option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    @if (old('department_id') == $department->id)
                                                        selected
                                                    @endif    
                                                >
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('department')
                                        <div class="text-danger">
                                            Please select a valid option
                                        </div>
                                    @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">Salary</label>
                                        <input type="text" name="salary" value="{{ old('salary') }}" class="form-control">
                                        @error('salary')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">HAEFA ID No<span style="color:red">*</span></label>
                                        <input type="number" name="haefaid" value="{{ old('haefaid') }}" class="form-control">
                                        @error('haefaid')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="">Photo<span style="color:red">*</span></label>
                                        <input type="file" name="photo" class="form-control-file">
                                        @error('photo')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="">National ID</label>
                                        <input type="number" name="nid" class="form-control">
                                        @error('nid')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="">Permanent Address<span style="color:red">*</span></label>
                                        <textarea name="permanent_add" id="permanent_add" cols="30" rows="3" class="form-control">{{ old('permanent_add') }}</textarea>
                                        @error('permanent_add')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="">Mobile Number<span style="color:red">*</span></label>
                                        <input type="number" name="mobile_no" id="mobile_no" class="form-control" value="{{ old('mobile_no') }}">
                                        @error('mobile_no')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Resigned Date(if needed)</label>
                                        <input type="text" name="resigned_date" id="resigned_date" class="form-control">
                                        @error('resigned_date')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Status<span style="color:red">*</span></label>
                                        <select name="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <h5 style="font-weight: bold;">Bank Details(If any)</h5>
                                <div class="form-row bank-details">
                                    <div class="form-group col-md-3">
                                        <label for="">Bank Name</label>
                                        <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{ old('bank_name') }}">
                                        @error('bank_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Account Name</label>
                                        <input type="text" name="bank_ac_name" id="bank_ac_name" class="form-control" value="{{ old('bank_ac_name') }}">
                                        @error('bank_ac_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Bank Acc No.</label>
                                        <input type="number" name="bank_acc_no" id="bank_acc_no" class="form-control" value="{{ old('bank_acc_no') }}">
                                        @error('bank_acc_no')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Bank Branch Name</label>
                                        <input type="text" name="bank_br_name" id="bank_br_name" class="form-control" value="{{ old('bank_br_no') }}">
                                        @error('bank_br_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Password<span style="color:red">*</span></label>
                                    <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                                    @error('password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password<span style="color:red">*</span></label>
                                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
                                    @error('password_confirmation')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </fieldset>
                            
                        
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary" style="width: 40%; font-size:1.3rem">Add</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- /.content-wrapper -->

@endsection

@section('extra-js')
<script>
    $().ready(function() {
        if('{{ old('dob') }}') {
            const dob = moment('{{ old('dob') }}', 'DD-MM-YYYY');
            const join_date = moment('{{ old('join_date') }}', 'DD-MM-YYYY');
            console.log('{{ old('dob') }}')
            $('#dob').daterangepicker({
                "startDate": dob,
                "singleDatePicker": true,
                "showDropdowns": true,
                "locale": {
                    "format": "DD-MM-YYYY"
                }
            });
            $('#join_date').daterangepicker({
                "startDate": join_date,
                "singleDatePicker": true,
                "showDropdowns": true,
                "locale": {
                    "format": "DD-MM-YYYY"
                }
            });
        } else {
            $('#dob').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "locale": {
                    "format": "DD-MM-YYYY"
                }
            });
            $('#join_date').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "locale": {
                    "format": "DD-MM-YYYY"
                }
            });
        }
        
    });
</script>
@endsection