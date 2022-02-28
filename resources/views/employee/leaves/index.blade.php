@extends('layouts.app')        

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">List Leaves</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employee.index') }}">Employee Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            List Leaves
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
                <div class="col-lg-12 col-md-12">
                    <!-- general form elements -->
                    @include('messages.alerts')
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">List of leaves</h3>
                        </div>
                        <div class="card-body">
                            @if ($leaves->count())
                            <table class="table table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Applied on</th>
                                        <th>Leave Type</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th class="none">Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $index => $leave)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $leave->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $leave->leave_type }}</td>
                                        <td>
                                            <h5>
                                                <span 
                                                @if ($leave->status == 'pending')
                                                    class="badge badge-pill badge-warning"
                                                @elseif($leave->status == 'declined')
                                                    class="badge badge-pill badge-danger"
                                                @elseif($leave->status == 'approved')
                                                    class="badge badge-pill badge-success"
                                                @endif
                                                >
                                                    {{ ucfirst($leave->status) }}
                                                </span> 
                                            </h5>
                                        </td>
                                        <td>{{ $leave->start_date->format('d-m-Y')}}</td>
                                        @if($leave->end_date) 
                                        <td>{{ $leave->end_date->format('d-m-Y') }}</td>
                                        @else
                                        <td>Single Day</td>
                                        @endif
                                        <td>{{ $leave->description }}</td>
                                        <td>
                                        @if ($leave->status == 'pending')
                                            <a href="{{ route('employee.leaves.edit', $leave->id) }}" class="btn btn-xs btn-warning">Edit</a>
                                        @else
                                        <p>No Permission</p>
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                                <h4>No records available</h4>
                            </div>
                            @endif
                        </div>
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
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
    $('.popover-dismiss').popover({
        trigger: 'focus'
    });
    $('#dataTable').DataTable({
        responsive:true,
        autoWidth: false,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 1 },
            { responsivePriority: 200000000000, targets: -1 }
        ],
        dom: 'Bfrtip',
        buttons: [
            'excel', 'print'
        ]
    });
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
});
</script>
<script src="{{ asset('/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/js/jszip.min.js') }}"></script>
<script src="{{ asset('/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/js/buttons.print.min.js') }}"></script>
@endsection