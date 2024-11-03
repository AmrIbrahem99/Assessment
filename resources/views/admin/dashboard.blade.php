@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Admin Dashboard</h4>
                        <a href="{{ route('admin.trainees.index') }}" class="btn btn-primary">Manage Trainees</a>
                    </div>

                    <div class="card-body">
                        <p>Welcome, {{ Auth::user()->name }}!</p>
                        <!-- Add your dashboard content here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
