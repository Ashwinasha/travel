@extends('admin_layouts.app')
@section('admin_title', 'Edit Slider')
@section('admin-content')

<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent p-0 mb-4">
            <li class="breadcrumb-item">
                <a href="{{ route('slider_management') }}" class="text-dark text-decoration-none"><b>Slider</b></a>
            </li>
            <span class="mx-1">&gt;</span>
            <li class="breadcrumb-item active text-muted" aria-current="page"><b>Edit Slider</b></li>
        </ol>
    </nav>
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow p-4">

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Form Fields -->
                <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label for="slider" class="form-label">upload image</label>
                    <div class="image-upload-container mb-3 border-dashed d-flex align-items-center justify-content-center position-relative" style="height: 300px; border: 2px dashed black; overflow: hidden;">
                        <img id="image-preview" src="{{ $slider->image_path ? asset('storage/sliders/' . $slider->image_path) : '' }}" alt="Image Preview" class="img-fluid" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                        
                        <!-- Trash icon -->
                        <i class="bi bi-trash-fill text-danger position-absolute top-0 end-0" id="close-btn" style="font-size: 1.5rem; cursor: pointer; display: none;" onclick="removeImage(event)"></i>

                        <!-- Plus icon -->
                        <i class="bi bi-plus-circle-fill position-absolute" id="plus-icon" style="font-size: 1.5rem; cursor: pointer;"></i>

                        <!-- Hidden file input (triggered by clicking the plus icon) -->
                        <input type="file" id="image-upload" name="slider_image" class="d-none {{ $errors->has('slider_image') ? 'is-invalid' : '' }}" accept="image/*" onchange="previewImage(event)">
                    </div>

                    @error('slider_image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                    @enderror

                    <div class="mb-3">
                        <label for="slider" class="form-label">Slider</label>
                        <input type="text" class="form-control {{ $errors->has('slider') ? 'is-invalid' : '' }}" id="slider" name="slider" value="{{ old('slider', $slider->slider) }}" placeholder="Slider Details">
                        @error('slider')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="button-name" class="form-label">Button Name</label>
                        <input type="text" class="form-control {{ $errors->has('button_name') ? 'is-invalid' : '' }}" id="button-name" name="button_name" value="{{ old('button_name', $slider->button_name) }}" placeholder="Button Name">
                        @error('button_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nav-link" class="form-label">Nav Link</label>
                        <input type="text" class="form-control {{ $errors->has('nav_link') ? 'is-invalid' : '' }}" id="nav-link" name="nav_link" value="{{ old('nav_link', $slider->nav_link) }}" placeholder="Link">
                        @error('nav_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Save Button -->
                    <div class="d-grid text-center justify-content-center">
                        <button type="submit" class="btn btn-danger">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('admin_styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/edit_slider.css') }}">
@endsection

@section('admin_scripts')
<script src="{{ asset('js/admin/edit_slider.js') }}"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {
    var imagePreview = document.getElementById('image-preview');
    var closeButton = document.getElementById('close-btn');
    var plusIcon = document.getElementById('plus-icon');
    var imageUpload = document.getElementById('image-upload');

    // Check if the image is loaded from the server
    if (imagePreview.getAttribute('src') && imagePreview.getAttribute('src') !== '') {
        imagePreview.style.display = 'block';
        closeButton.style.display = 'block';
        plusIcon.style.display = 'none';
    } else {
        imagePreview.style.display = 'none';
        closeButton.style.display = 'none';
        plusIcon.style.display = 'block';
    }

    // Event listener for clicking the plus icon to trigger file upload
    plusIcon.addEventListener('click', function() {
        imageUpload.click(); // Open file dialog when plus icon is clicked
    });

    // Event listener for file input change
    imageUpload.addEventListener('change', function() {
        if (this.files.length > 0) {
            plusIcon.style.display = 'none'; // Hide plus icon
            closeButton.style.display = 'block'; // Show delete icon
        }
    });
});

function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('image-preview');
        output.src = reader.result;
        output.style.display = 'block'; // Show image preview
        document.getElementById('plus-icon').style.display = 'none'; // Hide plus icon
        document.getElementById('close-btn').style.display = 'block'; // Show delete icon
    };
    reader.readAsDataURL(event.target.files[0]);
}

function removeImage(event) {
    event.stopPropagation(); // Prevent the click event from bubbling up
    event.preventDefault(); // Prevent default action

    // Clear the file input and reset the preview image
    document.getElementById('image-upload').value = ''; // Clear file input
    document.getElementById('image-preview').src = ''; // Clear image preview src
    document.getElementById('image-preview').style.display = 'none'; // Hide image preview
    document.getElementById('plus-icon').style.display = 'block'; // Show plus icon
    document.getElementById('close-btn').style.display = 'none'; // Hide delete icon
}

</script>
@endsection
