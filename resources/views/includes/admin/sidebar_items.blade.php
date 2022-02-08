
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-calendar-check-o"></i>
        <p>
            Employees
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">5</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="{{ route('admin.employees.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>List Employees</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="{{ route('admin.employees.attendance') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Date Wise Attendance</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="#"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Individual Attendance</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="{{ route('admin.leaves.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Leaves</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="{{ route('admin.expenses.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Expenses</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-store"></i>
        <p>
            Stock Management
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">2</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="{{ route('admin.leaves.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Products</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="{{ route('admin.expenses.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Reports</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-calendar-minus-o"></i>
        <p>
            Settings
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">6</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="{{ route('admin.holidays.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Holidays</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.branch.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Branch</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.departments.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Department</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.designations.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Designation</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.projects.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Project</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Management Notice</p>
            </a>
        </li>
    </ul>
</li>