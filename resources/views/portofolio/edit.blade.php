@extends('layouts.app')

@section('content')

  <div class="container-xxl flex-grow-1 container-p-y">

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
      <!-- Basic Layout -->
      <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Portofolio</h5>
            <small class="text-muted float-end">Edit Portofolio Data</small>
          </div>
          <div class="card-body">
            <form action="{{ route('portofolio.update', $portofolio) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="title">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="title" placeholder="Input Title"
                    value="{{ $portofolio->title }}" />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="category">Category</label>
                <div class="col-sm-10">
                  <div class="input-group input-group-merge">
                    <input type="text" id="category" name="category" value="{{ $portofolio->category }}"
                      class="form-control" placeholder="Input Category" />

                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">

                  @if ($portofolio->image && Storage::disk('public')->exists($portofolio->image))
                    <div class="mb-3" style="max-width:300px;">
                      <img id="img-preview" src="{{ asset('storage/' . $portofolio->image) }}" class="img-fluid rounded">
                    </div>
                  @else
                    <div class="mb-3">
                      <img id="img-preview" class="img-fluid rounded" style="display:none; max-width:300px;">
                    </div>
                  @endif

                  <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                </div>
              </div>

              <div class="row">
                <div class="col-sm-10 offset-sm-2">
                  <button type="submit" class="btn btn-primary me-2">Send</button>
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
    function previewImage() {
      const image = document.querySelector('#image');
      const imgPreview = document.querySelector('#img-preview');

      if (image.files && image.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
          imgPreview.src = e.target.result;
          imgPreview.style.display = 'block';
        }
        reader.readAsDataURL(image.files[0]);
      }
      imgPreview.style.display = 'block';

      const ofReader = new FileReader();
      ofReader.readAsDataURL(image.files[0]);

      ofReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
      }
    }
  </script>
@endsection