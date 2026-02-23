@extends('layouts.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Hero Section Layout</h5>
                    <small class="text-muted float-end">Edit Header Data</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('hero.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="title">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Input Title" value="{{ $hero->title ?? '' }}" />
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="tagline">Tagline</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tagline" name="tagline" placeholder="Input Tagline" value="{{ $hero->tagline ?? '' }}" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="button">Button Text</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <input
                                        type="text"
                                        id="button"
                                        name="button"
                                        value="{{ $hero->button ?? '' }}"
                                        class="form-control"
                                        placeholder="Input Button Text"
                                    /> 
                                    <span class="input-group-text" id="basic-default-email2">Action Button</span>
                                </div>
                        </div>
                    
                        <div class="mb-4">
                            <label for="image" class="col-sm-2 col-form-label">Background Image</label>
                            <div class="col-sm-10">
                                @if($hero->image && Storage::disk('public')->exists($hero->image))
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card h-100 img-preview">
                                        <img id="img-preview" class="card-img-top" src="{{ asset('storage/' . $hero->image) }}" alt="Hero Background Preview" />
                                        <div class="card-body">
                                            <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm">Current Image</a>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="card h-100 img-preview">
                                        <img id="img-preview" class="card-img-top" src="" alt="No Image Available" style="display:none;"/>
                                        <div class="card-body">
                                            <div class="form-text text-danger">Belum ada gambar background</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <input class="form-control" type="file" id="image" name="image" onchange="previewImage()" />
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update Hero</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('#img-preview');
        
        if(image.files && image.files[0]){
            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            
            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }
    }
</script>
@endsection
