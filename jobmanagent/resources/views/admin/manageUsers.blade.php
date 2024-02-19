<!-- resources/views/admin/manage-users.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Manage Users') }}</div>

                    <div class="card-body">
                        <ul>
                            @foreach($users as $user)
                                <li>{{ $user->name }} - {{ $user->email }}</li>
                                <a href="{{ route('edit-user', $user->id) }}">Edit</a>
                                <a href="{{ route('delete-user', $user->id) }}">Delete</a>
                                <!-- Display additional user information as needed -->
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
