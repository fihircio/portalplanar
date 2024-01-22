<?php

// App\Http\Controllers\Api\FetchContentController.php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class FetchContentController extends Controller
{
    public function fetchUserContent(Request $request)
    {
        // Debugging statement to check user authentication status
       // dd(Auth::id()); 
       // dd(Auth::check());

        // Retrieve the authenticated user
        $user = Auth::user();

        // Check if the user is authenticated
        if (!$user) {
            return Response::json(['error' => 'Unauthenticated'], 401);
        }

        // Retrieve content items associated with the user
        $contentItems = $user->contents;

        // Return the content items as a JSON response
        return Response::json(['contentItems' => $contentItems]);
    }
}
