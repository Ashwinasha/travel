@extends('admin_layouts.app')

@section('admin_title', 'Slider Management')

@section('admin-content')

<div class="slider-management-container">
    <div class="slider-management-header">
        <h4>Slider Management</h4>
        <button class="add-new-slider-btn">ADD NEW SLIDER</button>
    </div>
    <table class="table slider-management-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Slider Image</th>
                <th>Slider Button</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example row; this should be replaced with dynamic content from the database -->
            <tr>
                <td>1</td>
                <td><img src="{{ asset('images/slider/image1.jpg') }}" alt="Slider Image 1"></td>
                <td>Slider button</td>
                <td>
                    <i class="action-icons" onclick="editSlider(1)">&#9998;</i> <!-- Pencil icon for edit -->
                    <i class="action-icons" onclick="deleteSlider(1)">&#128465;</i> <!-- Trash icon for delete -->
                </td>
            </tr>
            <!-- Add additional slider rows dynamically here -->
        </tbody>
    </table>
</div>

@endsection

@section('admin_styles')
<link rel="stylesheet" href="{{ asset('css/admin/slider_management.css') }}">
<style>
    /* Custom styles here */
    .slider-management-container {
        padding: 20px;
    }
    .slider-management-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .slider-management-table {
        width: 100%;
        margin-top: 20px;
    }
    .slider-management-table th, .slider-management-table td {
        text-align: center;
        vertical-align: middle;
    }
    .slider-management-table img {
        width: 100px;
        height: auto;
    }
    .action-icons {
        font-size: 20px;
        cursor: pointer;
    }
    .add-new-slider-btn {
        background-color: brown;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
@endsection

@section('admin_scripts')
<script src="{{ asset('js/admin/slider_management.js') }}"></script>
<script>
    function editSlider(id) {
        // Add your edit logic here, such as redirecting to the edit page
        window.location.href = `/edit_slider/${id}`; // Change this route as necessary
    }

    function deleteSlider(id) {
        if (confirm('Are you sure you want to delete this slider?')) {
            // Add your delete logic here
            // Example: Use AJAX to delete the slider without refreshing the page
            console.log(`Deleting slider with id: ${id}`); // Placeholder for actual delete logic
        }
    }
</script>
@endsection