<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biography;
use Illuminate\Support\Facades\DB;


class BiographyController extends Controller
{
    public function index()
    {
        $biographies = Biography::all();
        $isTableEmpty = $biographies->isEmpty();
        return view('backend.biography.biography', compact('biographies','isTableEmpty'));
    }

    public function show($id)
    {
        $biography = Biography::findOrFail($id);
        return response()->json($biography);
    }

    public function store(Request $request)
    {
        // Validate and store the new biography
        // Make sure to add validation rules based on your requirements
        $biography = new Biography();
        $biography->name = $request->input('name');
        $biography->photo = $request->file('photo')->store('biography_photos', 'public');
        $biography->dr_text = $request->input('dr_text');
        $biography->ps_text = $request->input('ps_text');
        $biography->en_text = $request->input('en_text');
        $biography->save();

        return response()->json(['message' => 'Biography saved successfully']);
    }

    public function update(Request $request, $id)
    {
        // Validate and update the biography
        // Make sure to add validation rules based on your requirements
        $biography = Biography::findOrFail($id);
        $biography->name = $request->input('name');
        if ($request->hasFile('photo')) {
            $biography->photo = $request->file('photo')->store('biography_photos', 'public');
        }
        $biography->dr_text = $request->input('dr_text');
        $biography->ps_text = $request->input('ps_text');
        $biography->en_text = $request->input('en_text');
        $biography->save();

        return response()->json(['message' => 'Biography updated successfully']);
    }

    public function destroy($id)
    {
        // Delete the biography
        $biography = Biography::findOrFail($id);
        $biography->delete();

        return response()->json(['message' => 'Biography deleted successfully']);
    }

    public function create()
    {
        // Return the view for adding a new biography
        return view('backend.biography.biography');
    }
    public function getBiographyDetails($id)
    {
        try {
            // Fetch the biography record using the DB facade
            $biography = DB::table('biography')->find($id);
            // Check if the record was found
            if ($biography) {
                return response()->json($biography);
            } else {
                return response()->json(['error' => 'Biography not found.'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}