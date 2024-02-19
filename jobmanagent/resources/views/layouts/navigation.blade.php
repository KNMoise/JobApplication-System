
@if(auth()->check())
    @if(auth()->user()->role == 'employee')
        <a href="{{ route('employee.dashboard') }}">Employee Dashboard</a>
        <a href="{{ route('employee.createJobApplication') }}">Create Job Application</a>
        <a href="{{ route('employee.viewStatus') }}">View Job Application Status</a>
        <a href="{{ route('user.profileSettings') }}">Profile Settings</a>
        <a href="{{ route('user.resetPassword') }}">Reset Password</a>
    @elseif(auth()->user()->role == 'admin')
        <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        <a href="{{ route('admin.registerEmployee') }}">Register Employee</a>
        <a href="{{ route('admin.manageUsers') }}">Manage Users</a>
        <a href="{{ route('admin.viewJobApplications') }}">View Job Applications</a>
        <a href="{{ route('user.profileSettings') }}">Profile Settings</a>
        <a href="{{ route('user.resetPassword') }}">Reset Password</a>
    @elseif(auth()->user()->role == 'finance')
        <a href="{{ route('finance.dashboard') }}">Finance Dashboard</a>
        <a href="{{ route('finance.viewJobApplications') }}">View Job Applications</a>
        <a href="{{ route('user.profileSettings') }}">Profile Settings</a>
        <a href="{{ route('user.resetPassword') }}">Reset Password</a>
    @elseif(auth()->user()->role == 'production')
        <a href="{{ route('production.dashboard') }}">Production Dashboard</a>
        <a href="{{ route('user.profileSettings') }}">Profile Settings</a>
        <a href="{{ route('user.resetPassword') }}">Reset Password</a>
    @elseif(auth()->user()->role == 'stockkeeper')
        <a href="{{ route('stock.dashboard') }}">Stock Dashboard</a>
        <a href="{{ route('stock.raiseRequisition') }}">Raise Stock Requisition</a>
        <a href="{{ route('user.profileSettings') }}">Profile Settings</a>
        <a href="{{ route('user.resetPassword') }}">Reset Password</a>
    @endif
    <a href="{{ route('reports.generate') }}">Generate Reports</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endif
