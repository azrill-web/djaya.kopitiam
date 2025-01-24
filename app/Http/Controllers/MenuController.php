<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'desc')->get();
        // $product = $menus->first();
        // $formattedPrice = $product ? number_format($product->price, 0, ',', '.') : null;

        return view('dashboard.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('dashboard.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'category' => 'required|string|in:coffee,non coffee,makanan berat,makanan ringan', // Validasi kategori
        ]);

        $menu = new Menu();
        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->category = $request->category; // Simpan kategori

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $menu->image = $imageName;
        }

        $menu->save();
        return redirect()->route('dashboard.menus.index')->with('success', 'Menu added successfully.');
    }

    public function edit(Menu $menu)
    {
        return view('dashboard.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|in:coffee,non coffee,makanan berat,makanan ringan', // Validasi kategori
        ]);

        $menu->name = $request->name;
        $menu->description = $request->description;
        $menu->price = $request->price;
        $menu->category = $request->category; // Update kategori

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete('images/' . $menu->image);
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $menu->image = $imageName;
        }

        $menu->save();

        return redirect()->route('dashboard.menus.index')->with('success', 'Menu berhasil diperbarui !');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            Storage::disk('public')->delete('images/' . $menu->image);
        }

        $menu->delete();

        return redirect()->route('dashboard.menus.index')->with('success', 'Menu berhasil dihapus!');
    }
}
