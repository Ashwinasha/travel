<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class adminSliderManagementController extends Controller
{


    public function slider_management() {
        return view('admin.slider_management');
    }
    public function add_slider() {
        return view('admin.add_slider');
    }
    public function edit_slider() {
        return view('admin.edit_slider');
    }

}