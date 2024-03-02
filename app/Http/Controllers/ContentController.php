<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\AuditTrail;
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
        'description' => 'required|min:10|max:255',
       // 'model_file' => 'required_without:sketchfab_input|file|mimes:glb,gltf,obj,fbx|max:25600',
       // 'sketchfab_input' => 'required_without:model_file|url',
    ]);

    
    // Check if the user is authenticated
    if (auth()->check()) {
        $user = Auth::user();

        // Create a unique folder name using timestamp
        $folderName = 'models/' . now()->timestamp;

        AuditTrail::create([
            'user_id' => auth()->id(), // Assuming you're using Laravel's built-in authentication
            'activity' => 'Uploaded model onto server',
        ]);

        // Set common attributes
        $commonAttributes = [
            'user_id' => auth()->id(),
           // 'entry_key' => 'unique:contents,entry_key,NULL,id,user_id,' . auth()->id(),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ];

        if ($request->hasFile('model_file')) {
            // Handle file upload
            $file = $request->file('model_file');
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filePath = $file->storeAs($folderName, $fileName . '.' . $file->getClientOriginalExtension(), 'public');
            $commonAttributes['model_path'] = $filePath;
           
        } elseif ($request->filled('sketchfab_input')) {
            // Handle Sketchfab upload
            $commonAttributes['model_path'] = $request->input('sketchfab_input');
        } 
    }
    try {
        $content = Content::create($commonAttributes);
        $content->save();
        
        if ($request->ajax()) {
            return response()->json(['message' => 'Content created successfully']);
        } else {
            return redirect()->route('content.index')->with('success', 'Content created successfully');
        }
    
    } catch (\Exception $e) {
        // Log the exception for better error tracking
        dd($e->getMessage());
        \Log::error($e);
      // return response()->json(['error' => 'Failed to create content. ' . $e->getMessage()], 500);
       return response()->json(['error' => 'Failed to create content'], 500);
    }
    return response()->json(['error' => 'Please log in to create content'], 401);
}

    public function destroy($id)
    {
        // Find the content by ID
        $content = Content::findOrFail($id);
        //$modelPath = $request->input('modelPath');

        // Delete the content
        $content->delete();
       // Storage::delete($modelPath);
       AuditTrail::create([
        'user_id' => auth()->id(), // Assuming you're using Laravel's built-in authentication
        'activity' => 'User deleted content model',
        ]);

        // Return a response (e.g., JSON response)
        return response()->json(['message' => 'Content deleted successfully']);
    }

    public function deleteFile(Request $request)
    {
        $modelPath = $request->input('modelPath');

        // Delete the file from the storage
        Storage::delete($modelPath);

        return response()->json(['message' => 'File deleted successfully']);
    }

    public function generateQRCode(Request $request)
    {
        $contentId = $request->input('contentId');
        $mode = $request->input('mode');

        // Retrieve the content item by ID
        $contentItem = Content::findOrFail($contentId);

        // Generate QR code based on the selected mode
        $redirectURL = $mode === 'floor' ? '/floor-mode-url' : '/image-mode-url';
        $qrCodeURL = $this->generateQRCodeURL($contentItem, $redirectURL);

        // Return the QR code URL
        return response()->json(['qrCodeURL' => $qrCodeURL]);
    }

    private function generateQRCodeURL(Content $contentItem, $redirectURL)
    {
        // Customize this function to generate the QR code URL based on your needs
        // You can use the qrious library to generate QR codes

        $data = [
            'title' => $contentItem->title,
            'description' => $contentItem->description,
            'model_path' => asset($contentItem->model_path),
            'redirect_url' => $redirectURL,
        ];

        return json_encode($data);
    }

 
}
