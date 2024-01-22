<?php

// app/Http/Controllers/GetItemsIDController.php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class GetItemsIDController extends Controller
{
    public function show($userId)
    {
        $items = Content::where('userID', $userId)->pluck('itemID');

        return response()->json($items);
    }
}
