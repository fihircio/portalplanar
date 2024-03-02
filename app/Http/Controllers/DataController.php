<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\Content;

class DataController extends Controller
{
    public function index()
    {
         // Get the authenticated user
         $user = auth()->user();
        /// Fetch content items associated with the user
        $contentItems = $user->contents;
        $dataItems = Data::all(); // Get all data items

        // Fetch data items for each content item
        $dataItemsByContent = [];

        foreach ($contentItems as $contentItem) {
            $dataItemsByContent[$contentItem->id] = Data::where('content_id', $contentItem->id)->get();
        }
        
        return view('data.index', compact('dataItemsByContent'));
        return view('data.index', compact('dataItems'));

    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'content_id' => 'required',
            'entry_key' => 'required',
            'data1' => 'required', // Add validation rules for data1
          /*  'data2' => 'required', // Add validation rules for data2
            'data3' => 'required', // Add validation rules for data3
            'data4' => 'required', // Add validation rules for data4
            'data5' => 'required', // Add validation rules for data5*/
            'input_text' => 'required', // Add validation rules for input_text
            // Add validation rules for other fields as needed
        ]);

        AuditTrail::create([
            'user_id' => auth()->id(), // Assuming you're using Laravel's built-in authentication
            'activity' => 'Created new data entry',
        ]);
        // Create a new Data model instance
        $data = new Data();
        $data->content_id = $request->input('content_id');
        //$data->entry_key = $request->input('entry_key');
        $data->key = $request->input('data1');
      /*  $data->key = $request->input('data2');
        $data->key = $request->input('data3');
        $data->key = $request->input('data4');
        $data->key = $request->input('data5');*/
        $data->value = $request->input('input_text');
        // Set other fields as needed

        // Save the data to the database
        $data->save();

        // You can return a response if needed
        return response()->json(['message' => 'Data stored successfully', 'data' => $data]);
    }

    public function destroy($id)
    {
        $data = Data::find($id);

        AuditTrail::create([
            'user_id' => auth()->id(), // Assuming you're using Laravel's built-in authentication
            'activity' => 'delete data entry',
        ]);
    
        if (!$data) {
            return response()->json(['message' => 'Data not found'], 404);
        }
    
        $data->delete();
    
        return response()->json(['message' => 'Data deleted successfully']);
    }
}
