<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\DB;


class NewsController extends Controller
{
    public function index()
    {
        $newsList = News::all();
        return view('backend.news.view_news', ['newsList' => $newsList]);
    }
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();
            // Validate the incoming request data
            $request->validate([
                'newsTitleDari' => 'nullable|string|max:55',
                'newsTitlePashto' => 'nullable|string|max:100',
                'newsTitleEnglish' => 'nullable|string|max:55',
                'newsTextDari' => 'nullable|string',
                'newsTextPashto' => 'nullable|string',
                'newsTextEnglish' => 'nullable|string',
                'newsPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Adjust image validation rules
                'persian_date' => 'nullable|string|max:20',
                'gregorian_date' => 'nullable|date',
            ]);
            // Handle file upload
            $newsFile = $request->file('newsPhoto');
            $fileName = time() . '.' . $newsFile->getClientOriginalExtension();
            $newsFile->move(public_path('uploads/news'), $fileName);
            // Create a new News instance
            $news = new News();
            $news->dr_title = $request->input('newsTitleDari');
            $news->ps_title = $request->input('newsTitlePashto');
            $news->en_title = $request->input('newsTitleEnglish');
            $news->dr_text = $request->input('newsTextDari');
            $news->ps_text = $request->input('newsTextPashto');
            $news->en_text = $request->input('newsTextEnglish');
            $news->photo = $fileName; // Save the file path instead of the file name
            $news->persian_date = $request->input('persian_date');
            $news->gregorian_date = $request->input('gregorian_date');
            $news->save();
            \DB::commit();
            return response()->json(['message' => 'News created successfully']);
        } catch (\Exception $e) {
            \DB::rollBack();
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            \DB::beginTransaction();
        
            $request->validate([
                'newsTitleDari' => 'nullable|string|max:100',
                'newsTitlePashto' => 'nullable|string|max:100',
                'newsTitleEnglish' => 'nullable|string|max:100',
                'newsFile' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Adjust image validation rules
                'persian_date' => 'nullable|string|max:20',
                'gregorian_date' => 'nullable|date',
                // Add other validation rules as needed
            ]);
        
            // Find the news record by ID
            $news = DB::table('news')->where('id', $id)->first();
        
            if (!$news) {
                return response()->json(['error' => 'News not found'], 404);
            }
        
            // Handle file upload if a new file is provided
            if ($request->hasFile('newsFile')) {
                $newsFile = $request->file('newsFile');
                $fileName = time() . '.' . $newsFile->getClientOriginalExtension();
                $newsFile->move(public_path('uploads/news'), $fileName);
        
                // Delete the old file if it exists
                if (file_exists(public_path('uploads/news/' . $news->photo))) {
                    unlink(public_path('uploads/news/' . $news->photo));
                }
        
                // Update the photo column in the database
                DB::table('news')->where('id', $id)->update(['photo' => $fileName]);
            }
        
            // Update other columns in the database
            DB::table('news')
                ->where('id', $id)
                ->update([
                    'dr_title' => $request->input('newsTitleDari'),
                    'ps_title' => $request->input('newsTitlePashto'),
                    'en_title' => $request->input('newsTitleEnglish'),
                    'dr_text' => $request->input('newsTextDari'),
                    'ps_text' => $request->input('newsTextPashto'),
                    'en_text' => $request->input('newsTextEnglish'),
                    'persian_date' => $request->input('persian_date'),
                    'gregorian_date' => $request->input('gregorian_date'),
                ]);
        
            \DB::commit();
            return response()->json(['message' => 'News updated successfully']);
        } catch (\Exception $e) {
            \DB::rollBack();
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage], 500);
        }
    }
    public function viewAddNewsPage(){
        return view('backend.news.add_news');
    }
    public function getNewsDetails($id)
    {
        try {
            $news = DB::table('news')->where('id', $id)->first();
        
            if ($news) {
                return response()->json($news);
            } else {
                return response()->json(['error' => 'News not found'], 404);
            }
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            \Log::error($e);
            return response()->json(['error' => $errorMessage], 500);
        }
    }
    public function deleteNews($id)
    {
        try {
            News::destroy($id);
            return response()->json(['message' => 'News deleted successfully']);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage], 500);
        }
    }
}
