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
                </div>
              </div>

              <div class="row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image</label>

                <div class="col-sm-10">

                  <img id="img-preview" class="img-fluid rounded mb-3" style="display:none; max-width:300px;" />

                  <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                </div>
              </div>

              <div class="row justify-content-end">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Send</button>
                  <a href="{{ route('portofolio.index') }}" class="btn btn-secondary">Back</a>
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