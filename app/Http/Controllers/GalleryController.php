<?php

// app/Http/Controllers/GalleryController.php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Implement logic to fetch and display all gallery items
        $galleryList = Gallery::all();
        return view('backend.gallery.index', ['galleryList' => $galleryList]);
    }

    public function create()
    {
        // Implement logic to show the form for creating a new gallery item
        return view('backend.gallery.add_gallery');
    }

    public function store(Request $request)
    {
        // Implement logic to store a new gallery item
        // Make sure to validate and handle the file upload
        // ...

        // Example: Saving a gallery item
        $gallery = new Gallery();
        $gallery->type = $request->input('type');
        // Handle other fields and file upload
        // ...
        $gallery->save();

        return response()->json(['message' => 'Gallery item created successfully']);
    }

    public function edit($id)
    {
        // Implement logic to show the form for editing a gallery item
        $gallery = Gallery::findOrFail($id);
        return view('backend.gallery.edit', ['gallery' => $gallery]);
    }

    public function update(Request $request, $id)
    {
        // Implement logic to update a gallery item
        // Make sure to validate and handle the file upload
        // ...

        // Example: Updating a gallery item
        $gallery = Gallery::findOrFail($id);
        $gallery->type = $request->input('type');
        // Handle other fields and file upload
        // ...
        $gallery->save();

        return response()->json(['message' => 'Gallery item updated successfully']);
    }

    public function destroy($id)
    {
        // Implement logic to delete a gallery item
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();

        return response()->json(['message' => 'Gallery item deleted successfully']);
    }
    public function uploadImage(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation rules
            ]);

            // Handle file upload
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->storeAs('gallery_images', $imageName, 'public');

            // You may save the image name or URL in the database here
            // For example:
            // $galleryItem = new Gallery();
            // $galleryItem->image = $imageName;
            // $galleryItem->save();

            return response()->json(['message' => 'Image uploaded successfully', 'image' => $imageName]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
