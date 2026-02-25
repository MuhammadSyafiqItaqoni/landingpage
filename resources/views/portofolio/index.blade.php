@extends('layouts.app')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-header">Portofolio Data</h5>
        <a class="btn btn-primary" href="{{ route('portofolio.create') }}">Add Portofolio</a>
      </div>
      <div class="card">
        <div class="table-responsive text-nowrap">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Title</th>
                <th>Category</th>
                <!-- <th>Users</th> -->
                <th>Image</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($portofolios as $porto)

                <tr>
                  <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $porto->title }}</strong></td>
                  <td>{{ $porto->category }}</td>
                  <!-- <td>
                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                      <li
                                        data-bs-toggle="tooltip"
                                        data-popup="tooltip-custom"
                                        data-bs-placement="top"
                                        class="avatar avatar-xs pull-up"
                                        title="Lilian Fuller"
                                      >
                                        <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                                      </li>
                                      <li
                                        data-bs-toggle="tooltip"
                                        data-popup="tooltip-custom"
                                        data-bs-placement="top"
                                        class="avatar avatar-xs pull-up"
                                        title="Sophia Wilkerson"
                                      >
                                        <img src="../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                                      </li>
                                      <li
                                        data-bs-toggle="tooltip"
                                        data-popup="tooltip-custom"
                                        data-bs-placement="top"
                                        class="avatar avatar-xs pull-up"
                                        title="Christina Parker"
                                      >
                                        <img src="../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle" />
                                      </li>
                                    </ul>
                                  </td> -->

                  <td>
                    @if (Storage::disk('public')->exists($porto->image))
                      <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card h-100">
                          <img id="img-preview" class="card-img-top" src="{{ asset('storage/' . $porto->image) }}"
                            alt="Card image cap" />
                          <div class="card-body">
                            {{-- <h5 class="card-title">Card title</h5> --}}
                            {{-- <p class="card-text">
                              Some quick example text to build on the card title and make up the bulk of the card's content.
                            </p> --}}
                            {{-- <a href="javascript:void(0)" class="btn btn-outline-danger">Delete</a> --}}
                          </div>
                        </div>
                      </div>
                    @else
                      <div class="form-text">Belum ada gambar</div>
                    @endif
                  </td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('portofolio.edit', $porto) }}"><i
                            class="bx bx-edit-alt me-1"></i> Edit</a>

                        <form action="{{ route('portofolio.destroy', $porto) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="dropdown-item text-danger" href=""><i class="bx bx-trash me-1"></i>
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
@endsection