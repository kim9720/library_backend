<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::all();

        return response()->json($favorites);
    }

    public function show($id)
    {
        $favorite = Favorite::findOrFail($id);

        return response()->json($favorite);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $favorite = Favorite::create($data);

        return response()->json($favorite, 201);
    }

    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);
        $favorite->delete();

        return response()->json(['message' => 'Favorite deleted successfully'], 200);
    }
}
