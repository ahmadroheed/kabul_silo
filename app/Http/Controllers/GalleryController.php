<?php
namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class GalleryController extends Controller
{
    public function index()
    {
        $galleryList = Gallery::all();
        return view('backend.gallery.view_gallery', ['galleryList' => $galleryList]);
    }

    public function create()
    {
        return view('backend.gallery.add_gallery');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required',
                'galleryphoto.*' => 'required|file|mimes:jpeg,png,jpg,gif',
            ]);
            $files = $request->file('galleryphoto');
            $type = $request->input('type');
            foreach ($files as $file) {
                $gallery = new Gallery();
                $gallery->type = $type;
                $milliseconds = round(microtime(true) * 1000);
                $fileName = $milliseconds . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/gallery/' . $type), $fileName);
                $gallery->photo = 'uploads/gallery/' . $type . '/' . $fileName;
    
                $gallery->save();
            }
            return response()->json(['message' => 'Gallery photos created successfully.']);
        } catch (\Exception $e) {
            Log::error('Error in GalleryController@store: ' . $e->getMessage());
            return response()->json(['error' => 'Error creating gallery photos. Please try again.'], 500);
        }
    }
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('backend.gallery.edit', ['gallery' => $gallery]);
    }

    public function update(Request $request, $id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            $gallery->type = $request->input('type');
            // Check if a new photo is provided
            if ($request->hasFile('editGalleryPhoto')) {
                // Delete the previous photo if it exists
                if (!empty($gallery->photo)) {
                    $previousPhotoPath = public_path($gallery->photo);
                    if (File::exists($previousPhotoPath)) {
                        File::delete($previousPhotoPath);
                    }
                }
                $photoPath = $request->file('editGalleryPhoto')->store('upload/'.$gallery->type, 'public');
                $gallery->photo = $photoPath;
            }
                $gallery->save();
            return response()->json(['success' => 'Gallery updated successfully']);
        } catch (\Exception $e) {
            \Log::error('Error in GalleryController@updateGallery: ' . $e->getMessage());
            return response()->json(['error' => 'Error updating gallery'], 500);
        }
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();

        return response()->json(['message' => 'Gallery item deleted successfully']);
    }
    public function uploadImage(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation rules
            ]);
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->storeAs('gallery_images', $imageName, 'public');
            return response()->json(['message' => 'Image uploaded successfully', 'image' => $imageName]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getGalleryDetails($id)
    {
        try {
            $gallery = DB::table('gallary')->where('id', $id)->first();
            if ($gallery) {
                return response()->json($gallery);
            } else {
                return response()->json(['error' => 'Gallery not found.'], 404);
            }
        } catch (\Exception $e) {
            \Log::error('Error in GalleryController@getGalleryDetails: ' . $e->getMessage());
            return response()->json(['error' => 'Error fetching gallery details.'], 500);
        }
        
    }
}
