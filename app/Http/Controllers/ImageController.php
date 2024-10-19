<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|min:3|max:255',
                'description' => 'required|string|min:3|max:1000',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            $image = $request->file('image');
            $image_name = $request->title . '-' . time() . '.' . $image->extension();
            $path = $image->storeAs('images', $image_name, 'public');

            $image = Image::create([
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $path,
                'file_type' => $image->extension(),
                'file_size' => $image->getSize(),
            ]);

            return response()->json([
                'file_type' => $image->file_type,
                'file_size' => $image->file_size,
                'file_path' => asset('storage/' . $image->file_path),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while storing the image ...',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
