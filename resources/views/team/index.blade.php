@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-header">Teams Data</h5>
            <a class="btn btn-primary" href="{{ route('team.create') }}">Add Person</a>
        </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Image</th>
                            <th>Twitter</th>
                            <th>Facebook</th>
                            <th>Linkedin</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($teams as $team)
                        <tr>
                            <td><strong>{{ $team->name }}</strong></td>
                            <td>{{ $team->role }}</td>
                            <td>
                                @if ($team->image && Storage::disk('public')->exists($team->image))
                                    <img src="{{ asset('storage/' . $team->image) }}" alt="team" width="100" class="rounded">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $team->twitter }}</td>
                            <td>{{ $team->facebook }}</td>
                            <td>{{ $team->linkedin }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('team.edit', $team->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <form action="{{ route('team.destroy', $team->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection