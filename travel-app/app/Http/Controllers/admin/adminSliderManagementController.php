<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class adminSliderManagementController extends Controller
{


    public function slider_management() {
        $sliders = Slider::paginate(10); // Using pagination for easier management
        return view('admin.slider_management', compact('sliders'));
    }

    // Show the form to add a new slider
    public function add_slider() {
        return view('admin.add_slider');
    }

    // Store a new slider in the database
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'slider_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'slider' => 'required|string|max:255',
            'button_name' => 'required|string|max:255',
            'nav_link' => 'required|string|max:255',
        ]);

        // Handle file upload
        $imagePath = $request->file('slider_image')->store('sliders');

        // Create a new slider record
        Slider::create([
            'image_path' => basename($imagePath), // Store only the filename
            'slider' => $request->input('slider'),
            'button_name' => $request->input('button_name'),
            'nav_link' => $request->input('nav_link'),
        ]);

        return redirect()->back()->with('success', 'Slider added successfully!');
    }

    // Show the form to edit an existing slider
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.edit_slider', compact('slider'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'slider' => 'required|string|max:255',
        'button_name' => 'required|string|max:255',
        'nav_link' => 'required|string|max:255',
        'slider_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $slider = Slider::findOrFail($id);

    // Update other fields
    $slider->slider = $request->input('slider');
    $slider->button_name = $request->input('button_name');
    $slider->nav_link = $request->input('nav_link');

    if ($request->hasFile('slider_image')) {
        // Delete old image if exists
        if ($slider->image_path && Storage::exists('sliders/' . $slider->image_path)) {
            Storage::delete('sliders/' . $slider->image_path);
        }

        // Save new image
        $imagePath = $request->file('slider_image')->store('sliders');
        $slider->image_path = basename($imagePath);
    }

    $slider->save();

    return redirect()->route('slider_management')->with('success', 'Slider updated successfully.');
}

public function destroy($id)
{
    $slider = Slider::findOrFail($id);

    // Delete the slider image if it exists
    if ($slider->image_path) {
        Storage::delete('sliders/' . $slider->image_path);
    }

    // Delete the slider record
    $slider->delete();

    return redirect()->route('slider_management')->with('success', 'Slider deleted successfully.');
}

}