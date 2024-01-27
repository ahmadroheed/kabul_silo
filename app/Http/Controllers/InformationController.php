<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informations;
use Illuminate\Support\Facades\DB;


class InformationController extends Controller
{
    public function index()
    {
        // Fetch information data using Eloquent ORM and pass it to the view
        $informationList = Informations::all();
        return view('backend.informations.information', ['informationList' => $informationList]);
    }

    public function getInformationDetails($id)
    {
        // Fetch information details based on ID and return as JSON
        $information = Informations::find($id);
        return response()->json($information);
    }

    public function updateInformation(Request $request, $id = null)
    {
        try {
            \DB::beginTransaction();
            $id = $request->input('id'); // Assuming 'id' is the primary key field
            $data = [
                'type' => $request->input('InformationType'),
                'dr_text' => $request->input('dr_text'),
                'ps_text' => $request->input('ps_text'),
                'en_text' => $request->input('en_text'),
                // Add other fields as needed
            ];
            \DB::table('informations')->updateOrInsert(['type' => $data['type']], $data);
            \DB::commit();
            return response()->json(['message' => 'Information updated successfully']);
        }catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = $e->getMessage();
            // Log the exception trace for detailed error information
            \Log::error($e);
            return response()->json(['error' => $errorMessage], 500);
        }
    }
    public function deleteInformation($id)
    {
        try {
            // Delete information using Eloquent ORM
            Informations::destroy($id);

            return response()->json(['message' => 'Information deleted successfully']);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return response()->json(['error' => $errorMessage], 500);
        }
    }
}
