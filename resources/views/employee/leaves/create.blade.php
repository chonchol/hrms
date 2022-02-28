@extends('layouts.app')        

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Apply For Leave</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employee.index') }}">Employee Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Apply For Leave
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Apply For Leave
                            </h3>
                        </div>
                        <div class="leave-info card-body">
                            <p>*You can take miximum <b>10 days</b> Casual Leave and <b>5 days</b> Sick Leave in a Year</p> 
                        </div>

                        @include('messages.alerts')
                        <form action="{{ route('employee.leaves.store', $employee->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                        <label for="">Leave Type<span style="color:red">*</span></label>
                                        <select name="leave_type" class="form-control">
                                            <option hidden disabled selected value> -- select an option -- </option>
                                            @foreach ($leave_type as $type)
                                                <option value="{{ $type }}"
                                                @if (old('type') == $type)
                                                    selected
                                                @endif
                                                >
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <div class="text-danger">
                                            Please select an valid option
                                        </div>
                                        @enderror
                                    </div>

                                <div class="form-group">
                                    <label for="">Reason</label>
                                    <textarea name="description" class="form-control" >{{ old('description') }}</textarea>
                                    @error('description')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <!-- <div class="form-group">
                                    <label>Multiple Days</label>
                                    <select class="form-control" name="multiple-days" onchange="showDate()">
                                        <option value="yes" selected>Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div> -->
                                <!-- <div class="form-group hide-input" id="half-day">
                                    <label>Half Day</label>
                                    <select class="form-control" name="half-day">
                                        <option value="no">No</option>
                                        <option value="yes">Yes</option>
                                    </select>
                                </div> -->
                                <div class="form-group" id="range-group">
                                    <label for="">Date Range: </label>
                                    <input type="text" name="date_range" id="date_range" class="form-control">
                                    @error('date_range')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <!-- <div class="form-group hide-input" id="date-group">
                                    <label for="">Select Date </label>
                                    <input type="text" name="date" id="date" class="form-control">
                                </div> -->
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('extra-js')

<script>
    $(document).ready(function() {
        $('#date_range').daterangepicker({
            "locale": {
                "format": "DD-MM-YYYY",
            }
        });
        // $('#date').daterangepicker({
        //     "singleDatePicker": true,
        //     "locale": {
        //         "format": "DD-MM-YYYY",
        //     }
        // });

    });
    // function showDate() {
    //     $('#range-group').toggleClass('hide-input');
    //     $('#date-group').toggleClass('hide-input');
    //     $('#half-day').toggleClass('hide-input');
    // }
</script>
@endsection