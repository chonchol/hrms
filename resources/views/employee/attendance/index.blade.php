@extends('layouts.app')        

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">List Attendance</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employee.index') }}">Employee Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            List Attendance
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                                <h5 class="text-primary">Search attendance using date range</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('employee.attendance.index') }}" method="POST">
                                        @csrf
                                        <fieldset>
                                            <div class="form-inline">
                                            <div class="form-group mr-2">
                                                <label for="">Date Range</label>
                                                <input type="text" name="date_range" placeholder="Start Date" class="form-control text-center ml-2"
                                                id="date_range"
                                                >
                                                @error('date_range')
                                                <div class="ml-2 text-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <input type="submit" name="" class="btn btn-primary" value="Submit">
                                            </div>
                                        </fieldset>
                                        
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- <div class="container">
                                <form action="{{ route('employee.attendance.index') }}" class="row" method="POST">
                                    @csrf
                                    <div class="col-sm-9 mb-2">

                                        <div class="input-group">
                                            <input type="text" name="date_range" placeholder="Start Date" class="form-control"
                                            id="date_range"
                                            >
                                        </div>
                                        @error('date_range')
                                        <div class="ml-2 text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="input-group">
                                            <input type="submit" name="" class="btn btn-primary" value="Submit">
                                        </div>
                                    </div>
                                    
                                </form>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title text-center">
                                Attendances
                                @if ($filter)
                                    of a range
                                @endif
                            </div>
                            
                        </div>
                        <div class="card-body">
                            @if ($attendances->count())
                            <table class="table table-bordered table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th width="60">Date</th>
                                        <th>Entry Time</th>
                                        <th>Entry Location</th>
                                        <th>Exit Time</th>
                                        <th>Exit Location</th>
                                        <th>Working Hours</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($attendances as $index => $attendance)
                                    <tr>
                                        @if ($attendance->registered == 'yes')
                                        <?php
                                            $timediffence = strtotime($attendance->exit_time)-strtotime($attendance->entry_time);
                                            $hours = (int)($timediffence/60/60);
                                            $minutes = (int)($timediffence/60)-$hours*60;
                                            $seconds = (int)$timediffence-$hours*60*60-$minutes*60;
                                        ?>
                                        <td>{{ date('d-m-Y', strtotime($attendance->entry_time)) }}</td>
                                        <td>{{ date('H:i:s', strtotime($attendance->entry_time)) }}</td>
                                        <td>{{ $attendance->entry_location }}</td>
                                        <td>{{ date('H:i:s', strtotime($attendance->exit_time)) }}</td>
                                        <td>{{ $attendance->exit_location }}</td>
                                        <td><?php echo $hours. ":" .$minutes. ":" .$seconds; ?></td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-success">Present</span> </h5></td>
                                        @elseif($attendance->registered == 'no')
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-danger">Absent</span> </h5></td>
                                        @elseif($attendance->registered == 'fri')
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        <td class="text-center">No records</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-info">Friday</span> </h5></td>
                                        @elseif($attendance->registered == 'leave')
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td class="text-center">On Leave</td>
                                        <td class="text-center">On Leave</td>
                                        <td class="text-center">On Leave</td>
                                        <td class="text-center">On Leave</td>
                                        <td class="text-center">On Leave</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-info">Leave</span> </h5></td>
                                        @elseif($attendance->registered == 'holiday')
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td class="text-center">Public Holiday</td>
                                        <td class="text-center">Public Holiday</td>
                                        <td class="text-center">Public Holiday</td>
                                        <td class="text-center">Public Holiday</td>
                                        <td class="text-center">Public Holiday</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-success">Holiday</span> </h5></td>
                                        @else
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $attendance->created_at->format('H:i:s') }}</td>
                                        <td>{{ $attendance->entry_location }}</td>
                                        <td>No entry</td>
                                        <td>No entry</td>
                                        <td>No entry</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-warning">Half Day</span> </h5></td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                                <h4>No Records Available</h4>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                    <!-- general form elements -->
                    
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
        $('#dataTable').DataTable({
            responsive:true,
            autoWidth: false,
            dom: 'Bfrtip',
            buttons: [
                'excel', 'print'
            ]
        });
        $('#date_range').daterangepicker({
            "maxDate": new Date(),
            "locale": {
                "format": "DD-MM-YYYY",
            }
        })
    });
</script>

<script src="{{ asset('/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/js/jszip.min.js') }}"></script>
<script src="{{ asset('/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/js/buttons.print.min.js') }}"></script>

@endsection