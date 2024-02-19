<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Admin Dashboard') }}</div>

                    <div class="card-body">
                        <ul>
                            <li><a href="{{ route('admin-approve-reject') }}">Approve/Reject Job Applications</a></li>
                            <li><a href="{{ route('manage-users') }}">Manage Users</a></li>
                            <li><a href="{{ route('show-pending-applications') }}">View Pending Applications</a></li>
                            <li><a href="{{ route('show-approved-applications') }}">View Approved Applications</a></li>
                            <li><a href="{{ route('show-rejected-applications') }}">View Rejected Applications</a></li>
                            <!-- Add more links based on admin actions -->
                        </ul>
                        <hr>
                        <p>Pending Applications: {{ $pendingApplications }}</p>
                        <p>Approved Applications: {{ $approvedApplications }}</p>
                        <p>Rejected Applications: {{ $rejectedApplications }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
