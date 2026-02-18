@extends('layouts.app')

@section('content')

  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Horizontal Layouts</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Basic Layout</h5>
            <small class="text-muted float-end">Default label</small>
          </div>
          <div class="card-body">
            <form action="{{ route('portofolio.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="title">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title" placeholder="Input Title" />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="category">Category</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input type="text" id="category" name="category" class="form-control" placeholder="Input Category" />

                  </div>
                  <div class="form-text">You can use letters, numbers & periods</div>
                </div>
              </div>

              <div class="row-mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10"></div>
                {{-- @if (Storage::disk('public')->exists($portofolio->image)) --}}
                  <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card h-100">
                      <img id="img-preview" class="card-img-top" src=""
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
                {{-- @else
                  <div class="form-text">Belum ada gambar</div>
                @endif --}}
                <input class="form-control" type="file" id="image" name="image" onChange="previewImage()"/>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Send</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script>
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('#img-preview');
      const card = document.querySelector('.img-preview');

      card.style.display = 'none';
    function previewImage() {
      

      if (image.files && image.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
          imgPreview.src = e.target.result;
          imgPreview.style.display = 'block';
          card.style.display = 'block';
        }
        reader.readAsDataURL(image.files[0]);
      }
      imgPreview.style.display = 'block';
      card.style.display = 'block';
      const ofReader = new FileReader();
      ofReader.readAsDataURL(image.files[0]);

      ofReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
      }
    }
  </script>
@endsection