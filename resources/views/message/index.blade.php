@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Message Data</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($messages as $item)
                                {{-- Baris tabel --}}
                                <tr class="{{ $item->read ? '' : 'table-info' }}">

                                    {{-- 1. Kolom Nama --}}
                                    <td>
                                        <strong>{{ $item->name }}</strong>
                                        @if(!$item->read)
                                            <span class="badge bg-danger ms-1">New</span>
                                        @endif
                                    </td>

                                    {{-- 2. Kolom Email --}}
                                    <td>{{ $item->email }}</td>

                                    {{-- 3. Kolom Phone --}}
                                    <td>{{ $item->phone }}</td>

                                    {{-- 4. Kolom Message --}}
                                    <td>{{ Str::limit($item->message, 30) }}</td>

                                    {{-- 5. Kolom Tanggal (Satu baris dengan data lain) --}}
                                    <td>{{ $item->created_at->format('d M Y') }}</td>

                                    {{-- 6. Kolom Actions --}}
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('messages.edit', $item->id) }}">
                                                    <i class="bx bx-show-alt me-1"></i> Detail
                                                </a>

                                                <form action="{{ route('message.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </button>
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