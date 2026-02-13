@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="card">
                <h5 class="card-header">Hoverable rows</h5>
                <div class="card">
                    <div>
                    <a class="btn btn-primary" href="{{ route('portofolio.create') }}">Add Portofolio</a>
                    </div>
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
                          <td><span class="badge bg-label-primary me-1">{{ $porto->image }}</span></td>
                          <td>
                            <div class="dropdown">
                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href=""
                                  ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                >

                                <form action="" method="POST">
                                  @csrf
                                  @method('DELETE')
                                <button type="submit" class="dropdown-item" href=""><i class="bx bx-trash me-1"></i> Delete</button>
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