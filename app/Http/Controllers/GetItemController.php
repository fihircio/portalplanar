<?php

// app/Http/Controllers/GetItemController.php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class GetItemController extends Controller
{
    public function show($itemId)
    {
        $item = Content::find($itemId, ['title', 'description']);

        if ($item) {
            return response()->json($item);
        } else {
            return response()->json(['error' => 'Item not found'], 404);
        }
    }
}
