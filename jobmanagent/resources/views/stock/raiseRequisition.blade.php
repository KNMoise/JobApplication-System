<!-- resources/views/raise-stock-requisition.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Raise Stock Requisition') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('submit-stock-requisition', $jobApplication->id) }}">
                            @csrf

                            <!-- Add form fields for stock requisition -->

                            <button type="submit">Submit Stock Requisition</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
