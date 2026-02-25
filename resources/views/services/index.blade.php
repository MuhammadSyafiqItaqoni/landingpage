@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div>
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-header">Service Management</h5>
                    <a class="btn btn-primary mb-3" href="{{ route('service.create') }}">Add Service</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($services as $item)
                                <tr>
                                    <td><strong>{{ $item->title }}</strong></td>
                                    <td>{{ Str::limit($item->description, 50) }}</td>
                                    <td>
                                        @if ($item->image && Storage::disk('public')->exists($item->image))
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="service" width="100"
                                                class="rounded">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('service.edit', $item->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Edit</a>
                                                <form action="{{ route('service.destroy', $item->id) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"><i class="bx bx-trash me-1"></i>
                                                        Delete</button>
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