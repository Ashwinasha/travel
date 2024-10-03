@extends('admin_layouts.app')

@section('admin_title', 'Slider Management')

@section('admin-content')

<div class="container mt-5">
    <div class="mb-4">
        <div>
            <a href="#" class="text-dark text-decoration-none"><b>Slider</b></a>
        </div>
        
        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('add_slider') }}" class="btn btn-danger" style="width: 200px;">
                <i class="bi bi-plus-circle me-2"></i>Add New Slider
            </a>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <div class="w-100" style="max-width: 600px;">
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>

    <div class="table-responsive mt-2">
        <div class="d-flex justify-content-center">
            <table class="table table-borderless align-middle mx-auto" style="width: 900px;">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col" class="pe-5"><h5>Slider Image</h5></th> 
                        <th scope="col" class="pe-5 ms-5"><h5>Slider Button</h5></th>
                        <th scope="col" class="text-end"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $slider)
                    <tr style="border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                        <th scope="row" class="text-center">{{ ($sliders->currentPage() - 1) * $sliders->perPage() + $loop->iteration }}</th>
                        <td class="pe-5">
                            <img src="{{ asset('storage/sliders/' . $slider->image_path) }}" alt="Slider Image" width="100" height="100" class="slider_image rounded-2">
                        </td>
                        <td class="pe-5 ms-5" style="color: #686868;">{{ $slider->button_name }}</td>
                        <td class="text-end">
                            <!-- Red edit icon -->
                            <a class="btn editbtn me-5 text-danger" href="{{ route('slider.edit', $slider->id) }}">
                            <i class="bi bi-pencil-square"></i>
                            </a>
                            <!-- Delete button without outline -->
                            <button class="btn delete-btn text-danger" data-id="{{ $slider->id }}" data-url="{{ route('delete_slider', $slider->id) }}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-2 mb-4">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                @if ($sliders->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $sliders->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                @endif

                @foreach ($sliders->links()->elements[0] as $page => $url)
                    @if ($sliders->currentPage() == $page)
                        <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach

                @if ($sliders->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $sliders->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this slider?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('admin_styles')
<link rel="stylesheet" href="{{ asset('css/admin/slider_management.css') }}">
@endsection

@section('admin_scripts')
<script src="{{ asset('js/admin/slider_management.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteForm = document.getElementById('deleteForm');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const sliderId = this.getAttribute('data-id');
            const url = this.getAttribute('data-url');

            // Set the form action to the delete URL
            deleteForm.setAttribute('action', url);
        });
    });
});
</script>
@endsection
