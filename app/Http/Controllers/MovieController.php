<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Get all movies.
     */
    public function index()
    {
        $movies = Movie::all()->map(function ($movie) {
            return [
                'id' => $movie->id,
                'title' => $movie->title,
                'description' => $movie->description,
                'poster' => url('/api/v1/posters/' . basename($movie->poster)) // Generate API path for poster
            ];
        });

        return response()->json(['movies' => $movies], 200);
    }

    /**
     * Store a new movie record.
     */
    public function store(Request $request)
    {
    // ✅ Validate input fields
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'poster' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Ensures poster is an actual image
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => $validator->errors()->first(),
            'errors' => $validator->errors()
        ], 422);
    }

    // ✅ Handle poster image upload
    if ($request->hasFile('poster')) {
        $posterPath = $request->file('poster')->store('posters', 'public');
    } else {
        return response()->json([
            'message' => 'Poster upload failed'
        ], 400);
    }

    // ✅ Save movie details in the database
    $movie = Movie::create([
        'title' => $request->title,
        'description' => $request->description,
        'poster' => $posterPath // Saves relative path like "posters/the-movie-poster.png"
    ]);

    return response()->json([
        'message' => 'Movie created successfully',
        'movie' => $movie
    ], 201);
    }
}
