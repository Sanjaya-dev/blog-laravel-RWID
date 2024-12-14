<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();

        return response()->json([
            'data' => $blogs
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        $validate = $request->validate([
            'title' => 'required|min:5',
            'content' => 'required',
        ]);

        //create blog
        $imagePath = $request->file('image')->store('images');

        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath
        ]);

        return response()->json([
            'data' => $blog
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::find($id);

        if(!$blog) {
            return response()->json([
                'message' => 'Blog not found'
            ], 404);
        }

        return response()->json([
            'data' => $blog
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = Blog::find($id);

        if(!$blog) {
            return response()->json([
                'message' => 'Blog not found'
            ], 404);
        }

        $validate = $request->validate([
            'title' => 'required|min:5',
            'content' => 'required',
        ]);

        $imagePath = $request->file('image')->store('images');

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'image_path' => $imagePath
        ]);

        return response()->json([
            'data' => $blog
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);

        if(!$blog) {
            return response()->json([
                'message' => 'Blog not found'
            ], 404);
        }

        $blog->delete();

        return response()->json([
            'message' => 'Blog deleted'
        ]);
    }
}
