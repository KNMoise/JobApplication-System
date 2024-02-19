<!-- resources/views/admin/approved-applications.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Approved Job Applications') }}</div>

                    <div class="card-body">
                        @foreach($applications as $application)
                            <div>
                                <p>{{ $application->user->name }} - {{ $application->created_at->format('Y-m-d H:i:s') }}</p>
                                <p>{{ $application->job_title }} - {{ $application->status }}</p>
                                <!-- Display additional application information as needed -->
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
