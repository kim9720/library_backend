<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book);
    }

    public function store(Request $request)
    {
    
        $book = new Book([
            'title' => $request->get('title'),
            'author' => $request->get('author'),
            'description' => $request->get('description'),
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images/books'), $imageName);
            $book->image = $imageName;
        }
    
        $book->save();
    
        return response()->json($book, 201);
    }
    

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $book->update($data);

        return response()->json($book, 200);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully'], 200);
    }

    public function getImage($id)
{
    $book = Book::findOrFail($id);

    if ($book->image) {
        $path = public_path('images/books/' . $book->image);

        if (file_exists($path)) {
            $file = file_get_contents($path);
            $type = mime_content_type($path);

            return response($file, 200)->header('Content-Type', $type);
        }
    }

    return response()->json(['message' => 'Image not found'], 404);
}
public function getNumberOfBooks()
{
    $numberOfBooks = Book::count();

    return response()->json(['number_of_books' => $numberOfBooks]);
}


}
