@extends('admin_layouts.app')

@section('admin_title','edit Slider')

@section('admin-content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent p-0 mb-4">
            <li class="breadcrumb-item">
                <a href="#" class="text-dark text-decoration-none">Slider Management</a>
            </li>
            <span class="mx-1">&gt;</span>
            <li class="breadcrumb-item active text-muted" aria-current="page">edit Slider</li>
        </ol>
    </nav>
  
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow p-4">
                <form id="slider-form" method="POST" action="#" enctype="multipart/form-data">
                    @csrf

                    @if(session('success'))
                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                    @endif

                    <!-- Image upload -->
                    <div class="image-upload-container mb-3 border-dashed d-flex align-items-center justify-content-center position-relative" style="height: 300px; border: 2px dashed black;">
                        <img id="image-preview" alt="Image Preview" class="img-fluid d-none" style="max-width: 100%; max-height: 100%;">
                        <!-- Only the plus icon triggers the file input -->
                        <img src="{{ asset('img/icon/plus-solid.svg') }}" id="plus-icon" class="position-absolute" style="max-width:20px; max-height: 20px; cursor: pointer;">
                        
                        <!-- Keep input file hidden and only clickable via the plus icon -->
                        <input type="file" name="slider_image" id="image-upload" class="d-none" accept="image/*" onchange="previewImage(event)">
                        
                        <img src="{{ asset('img/icon/trash-can-solid.svg') }}" id="close-btn" class="btn position-absolute top-0 end-0 d-none" style="max-width: 40px; max-height:40px; cursor: pointer;" onclick="removeImage()">
                    </div>


                    @error('slider_image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                    <!-- Slider Name -->
                    <div class="mb-3 position-relative">
                        <label for="slider" class="form-label">Slider</label>
                        <input type="text" name="slider" class="form-control @error('slider') is-invalid @enderror" id="slider" placeholder="Slider Details" value="{{ old('slider') }}">
                        @error('slider')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Button Name -->
                    <div class="mb-3 position-relative">
                        <label for="button_name" class="form-label">Button Name</label>
                        <input type="text" name="button_name" class="form-control @error('button_name') is-invalid @enderror" id="button_name" placeholder="Button Name" value="{{ old('button_name') }}">
                        @error('button_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nav Link -->
                    <div class="mb-3 position-relative">
                        <label for="nav_link" class="form-label">Nav Link</label>
                        <input type="text" name="nav_link" class="form-control @error('nav_link') is-invalid @enderror" id="nav_link" placeholder="Link" value="{{ old('nav_link') }}">
                        @error('nav_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Save Button -->
                    <div class="d-grid text-center justify-content-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                   
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Slider added successfully!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Unable to add slider. Please try again.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('admin_styles')
<link rel="stylesheet" href="{{ asset('css/admin/add_slider.css') }}">
@endsection

@section('admin_scripts')
<script src="{{ asset('js/admin/add_slider.js') }}"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {
    const plusIcon = document.getElementById('plus-icon');
    const fileInput = document.getElementById('image-upload');

    // Open file dialog when clicking the plus icon
    plusIcon.addEventListener('click', function () {
        fileInput.click();
    });

    // Function to preview the image
    window.previewImage = function (event) {
        const imagePreview = document.getElementById('image-preview');
        const closeBtn = document.getElementById('close-btn');
        const plusIcon = document.getElementById('plus-icon');

        // Show the image preview
        const reader = new FileReader();
        reader.onload = function () {
            imagePreview.src = reader.result;
            imagePreview.classList.remove('d-none');
            closeBtn.classList.remove('d-none');
            plusIcon.classList.add('d-none'); // Hide the plus icon after image is uploaded
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    // Function to remove the image and reset the input
    window.removeImage = function () {
        const imagePreview = document.getElementById('image-preview');
        const closeBtn = document.getElementById('close-btn');
        const plusIcon = document.getElementById('plus-icon');
        const fileInput = document.getElementById('image-upload');

        // Reset file input and image preview
        fileInput.value = "";
        imagePreview.src = "";
        imagePreview.classList.add('d-none');
        closeBtn.classList.add('d-none');
        plusIcon.classList.remove('d-none'); // Show the plus icon again
    };


    let successMessage = "{{ session('success') }}";
    let errorMessage = "{{ session('error') }}";

    // Trigger the modals if success or error session exists
    if (successMessage) {
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    }

    if (errorMessage) {
        const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        errorModal.show();
    }
    
});

</script>

@endsection