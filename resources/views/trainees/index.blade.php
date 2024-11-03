@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Trainees Management</h1>
        <a href="{{ route('admin.trainees.create') }}" class="btn btn-primary">Add New Trainee</a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.trainees.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search trainees..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Specialization</th>
                        <th>Start Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($trainees as $trainee)
                        <tr>
                            <td>{{ $trainee->name }}</td>
                            <td>{{ $trainee->email }}</td>
                            <td>{{ $trainee->phone }}</td>
                            <td>{{ $trainee->specialization }}</td>
                            <td>{{ $trainee->start_date->format('Y-m-d') }}</td>
                            <td>
                                        <span class="badge bg-{{ $trainee->status === 'active' ? 'success' : ($trainee->status === 'completed' ? 'primary' : 'danger') }}">
                                            {{ ucfirst($trainee->status) }}
                                        </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.trainees.edit', $trainee) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.trainees.destroy', $trainee) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $trainees->links() }}
        </div>
    </div>
</div>
@endsection
