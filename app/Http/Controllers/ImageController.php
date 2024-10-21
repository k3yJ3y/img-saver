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
            $image_name = str_replace(' ', '_', $request->title) . '-' . time() . '.' . $image->extension();
            $image_path = $image->storeAs('images', $image_name, 'public');

            $image = Image::create([
                'title' => $request->title,
                'description' => $request->description,
                'file_path' => $image_path,
                'file_type' => $image->extension(),
                'file_size' => $image->getSize(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded successfully...',
                'data' => [
                    'file_type' => $image->file_type,
                    'file_size' => $image->file_size,
                    'file_path' => $image->file_path,
                    'file_url' => asset('storage/' . $image->file_path),
                ]
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while storing the image: ' . $e->getMessage()
            ], 500);
        }
    }
}
