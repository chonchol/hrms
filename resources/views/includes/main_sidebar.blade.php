<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style = "z-index: 1040 !important;">
    <!-- Brand Logo -->
    <a 
    @can('admin-access')
        href="{{ route('admin.index') }}"
    @endcan
    @can('employee-access')
        href="{{ route('employee.index') }}"
    @endcan
    class="brand-link">
        <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: 0.8;"
        /> 
        <span class="brand-text font-weight-light ">HRM System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (Auth::user()->employee)
                <img
                    src="{{ asset('/img')}}/{{ Auth::user()->employee->photo }}"
                    class="img-circle elevation-2"
                    alt="User Image"
                />
                @else
                <img
                    src="{{ asset('/dist/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2"
                    alt="User Image"
                />
                @endif
                
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false"
            >
                @can('admin-access')

                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard </p>
                    </a>
                </li>
                @include('includes.admin.sidebar_items')
                @endcan
                @can('employee-access')
                <li class="nav-item">
                    <a href="{{ route('employee.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @include('includes.employee.sidebar_items')
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
