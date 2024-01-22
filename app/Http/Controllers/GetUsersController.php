<?php

// app/Http/Controllers/GetUsersController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GetUsersController extends Controller
{
    public function show($userId)
    {
        $user = User::find($userId);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
