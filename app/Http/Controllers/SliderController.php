<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        return view('backend.sliders.add_slider');
    }

    public function viewSliderPage()
    {
        $sliders = Slider::all();
        return view('backend.sliders.view_slider', ['sliders' => $sliders]);
    }

    public function saveSlider(Request $request)
    {
        // Validate the form data
        $request->validate([
            'sliderLanguage' => 'required',
            'sliderTitle' => 'required',
            'sliderText' => 'required',
            'sliderFile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // Handle file upload
        $sliderFile = $request->file('sliderFile');
        $fileName = time() . '.' . $sliderFile->getClientOriginalExtension();
        $sliderFile->move(public_path('uploads'), $fileName);
        // Save data to the database
        Slider::create([
            'language' => $request->input('sliderLanguage'),
            'title' => $request->input('sliderTitle'),
            'text' => $request->input('sliderText'),
            'photo' => $fileName,
        ]);
        return response()->json(['message' => 'Slider saved successfully']);
    }

    // Add these methods in your SliderController.php file

    public function getSliderDetails($id)
    {
        $slider = Slider::find($id);
        return response()->json($slider);
    }

    public function deleteSlider($id)
    {
        $slider = Slider::find($id);
        $slider->delete();
        return response()->json(['message' => 'Slider deleted successfully.']);
    }

// In your SliderController.php file

    public function updateSlider(Request $request, $id)
    {
        $slider = Slider::find($id);
        // Update slider properties with the form data
        $slider->language = $request->input('sliderLanguage');
        $slider->title = $request->input('sliderTitle');
        $slider->text = $request->input('sliderText');

        // Update the image if a new file is provided
        if ($request->hasFile('sliderFile')) {
            $file = $request->file('sliderFile');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $slider->photo = $fileName;
        }

        // Save the updated slider
        $slider->save();

        return response()->json(['message' => 'Slider updated successfully.']);
    }


}
