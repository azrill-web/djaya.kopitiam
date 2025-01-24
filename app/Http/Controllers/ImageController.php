<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::orderBy('created_at', 'desc')->get();
        return view('dashboard.images.index', compact('images'));
    }

    public function create()
    {
        return view('dashboard.images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $image = new Image();

        // Proses upload gambar
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $image->image_path = $imageName; // Simpan nama file gambar ke database
        }

        $image->user_id = auth()->id(); // Simpan ID pengguna yang meng-upload
        $image->save();

        return redirect()->route('dashboard.images.index')->with('success', 'Image uploaded successfully.');
    }

    public function edit(Image $image)
    {
        return view('dashboard.images.edit', compact('image'));
    }
    

    public function update(Request $request, Image $image)
    {
        // Validasi data yang diterima
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Perbaiki validasi
        ]);

        // Update data gambar jika ada file baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($image->image_path) {
                Storage::delete('images/' . $image->image_path); // Pastikan ini benar
            }
            // Simpan gambar baru
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $image->image_path = $imageName; // Simpan nama file gambar ke database
        }

        $image->save();

        return redirect()->route('dashboard.images.index')->with('success', 'Image updated successfully.');
    }

    public function destroy(Image $image)
    {
        // Hapus gambar dari storage
        if ($image->image_path) {
            Storage::delete('images/' . $image->image_path); // Pastikan ini benar
        }

        // Hapus data gambar dari database
        $image->delete();

        return redirect()->route('dashboard.images.index')->with('success', 'Image deleted successfully.');
    }
}