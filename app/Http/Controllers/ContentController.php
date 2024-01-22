<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ContentController extends Controller
{
   
    public function index(): View
    {
          // Retrieve the currently authenticated user
        $user = Auth::user();
        // Retrieve content items associated with the user
        $contentItems = $user->contents;
        

        // Pass content items to the view
        return view('content.index', compact('contentItems'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'model_file' => 'required_without:sketchfab_input|file|mimes:glb,gltf|max:25600',
            'sketchfab_input' => 'required_without:model_file|url', // Adjust the validation rules as needed
        ]);

        // Check if the user is authenticated
        if (auth()->check()) {
            $user = Auth::user();
             // Create a unique folder name using timestamp
             $folderName = 'models/' . now()->timestamp;
             // Local File Upload
             if ($request->hasFile('model_file')) {
                $file = $request->file('model_file');
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $filePath = $file->storeAs($folderName, $fileName . '.' . $file->getClientOriginalExtension(), 'public');

                // Add the file path to the request data
                $request->merge([
                    'user_id' => $user->id,
                    'entry_key' => uniqid(), // Adjust this based on your requirements
                    'model_path' => $filePath,
                ]);
            }

             // Sketchfab Upload
             if ($request->filled('sketchfab_input')) {
                $request->merge([
                    'user_id' => $user->id,
                    'entry_key' => uniqid(), // Adjust this based on your requirements
                    'model_path' => $request->input('sketchfab_input'),
                ]);
   
             // Save the content to the database
            Content::create($request->all());
  
            if ($request->ajax()) {
                return response()->json(['message' => 'Content created successfully']);
            } else {
                return redirect()->route('content.index')->with('success', 'Content created successfully');
            }
        }
    
        // Handle the case where the user is not authenticated (optional)
        return redirect()->route('login')->with('error', 'Please log in to create content.');
        }
    }

    public function destroy($id)
    {
        // Find the content by ID
        $content = Content::findOrFail($id);
        

        // Delete the content
        $content->delete();

        // Return a response (e.g., JSON response)
        return response()->json(['message' => 'Content deleted successfully']);
    }

 
}
