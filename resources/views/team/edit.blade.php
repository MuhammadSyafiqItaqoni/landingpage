@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Edit Team</h4>

    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Teams Data</h5>
                    <small class="text-muted float-end">Admin: {{ $username }}</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('team.update', $team->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="name">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" 
                                    placeholder="Input name" value="{{ $team->name }}" required />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="role">Role</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="role" name="role" 
                                    placeholder="Input role" required>{{ $team->role }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card h-100 border">
                                        @if ($team->image && Storage::disk('public')->exists($team->image))
                                            <img id="img-preview" class="card-img-top" 
                                                src="{{ asset('storage/'.$team->image) }}" alt="Team Image" />
                                        @else
                                            <img id="img-preview" class="card-img-top" 
                                                src="" alt="No Image" style="display:none;" />
                                            <div id="no-image-text" class="form-text p-2">Belum ada gambar</div>
                                        @endif
                                        <div class="card-body">
                                            <p class="card-text small text-muted">Preview Gambar</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <input class="form-control" type="file" id="image" name="image" onChange="previewImage()" />
                                <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar.</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="twitter">Link Twitter</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="twitter" name="twitter" 
                                    placeholder="Input twitter" value="{{ $team->twitter }}" required />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="facebook">Link Facebook</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="facebook" name="facebook" 
                                    placeholder="Input facebook" value="{{ $team->facebook }}" required />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="linkedin">Link Linkedin</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="linkedin" name="linkedin" 
                                    placeholder="Input linkedin" value="{{ $team->linkedin }}" required />
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update Data</button>
                                <a href="{{ route('team.index') }}" class="btn btn-outline-secondary">Back</a>
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
        const noImageText = document.querySelector('#no-image-text');

        if (image.files && image.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgPreview.src = e.target.result;
                imgPreview.style.display = 'block';
                if (noImageText) noImageText.style.display = 'none';
            }
            reader.readAsDataURL(image.files[0]);
        }
    }
</script>
@endsection