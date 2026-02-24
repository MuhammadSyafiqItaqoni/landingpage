@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">View Message Data</h5>
                    <small class="text-muted float-end">Admin Panel</small>
                </div>
                <div class="card-body">
                    {{-- Action diarahkan ke messages.update --}}
                    <form action="{{ route('messages.update', $message->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Input Name --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="name">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" 
                                    value="{{ $message->name }}" required />
                            </div>
                        </div>

                        {{-- Input Email --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="email">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" 
                                    value="{{ $message->email }}" required />
                            </div>
                        </div>

                        {{-- Input Phone --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="phone">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" name="phone" 
                                    value="{{ $message->phone }}" required />
                            </div>
                        </div>

                        {{-- Input Message Content --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="message">Message</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="message" name="message" 
                                    rows="5" required>{{ $message->message }}</textarea>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                {{-- <button type="submit" class="btn btn-primary">Update Message</button> --}}
                                <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary">Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection