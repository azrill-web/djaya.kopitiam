<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $menus = Menu::all(); // Ambil semua menu
        return view('dashboard.orders.index', compact('menus'));
    }

    public function adminIndex()
    {
        // Ambil semua pesanan dengan relasi menu dan user, diurutkan berdasarkan created_at terbaru
        $orders = Order::with('menu', 'user')->orderBy('created_at', 'desc')->get(); 
        return view('dashboard.admin.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
        ]);

        Order::create([
            'menu_id' => $request->menu_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard.orders.index')->with('success', 'Order berhasil dibuat.');
    }

    public function checkout(Menu $menu)
    {
        return view('dashboard.orders.checkout', compact('menu'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'quantity' => 'required|string|max:255',
            'grand_total' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);
    
        // Simpan data pesanan
        $order = Order::create([
            'menu_id' => $request->menu_id,
            'user_id' => Auth::id(),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'quantity' => $request->quantity,
            'grand_total' => $request->grand_total,
            'status' => $request->status,
        ]);
    
        // Notifikasi sukses
        session()->flash('success', 'Pesanan Anda telah berhasil dikirim!');
    
        // Simpan data pemesan
        $orderDetails = [
            'menu' => $order->menu,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'quantity' => $request->quantity,
            'grand_total' => $request->grand_total,
            'status' => $request->status,
        ];
    
        return view('dashboard.orders.confirmation', compact('orderDetails'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:Baru,Diproses,Diantar,Dilokasi,Selesai',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('dashboard.admin.orders.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('dashboard.admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Mencari menu berdasarkan nama
        $menus = Menu::where('name', 'LIKE', '%' . $query . '%')->get();

        return view('dashboard.orders.index', compact('menus'));
    }

    public function generateNota(Order $order)
    {
        $data = [
            'order' => $order,
        ];

        return view('dashboard.admin.orders.nota', $data);
    }

    public function filterByCategory(Request $request)
    {
        $category = $request->input('category');

        // Jika kategori dipilih, filter menu berdasarkan kategori
        if ($category) {
            $menus = Menu::where('category', $category)->get();
        } else {
            // Jika tidak ada kategori yang dipilih, tampilkan semua menu
            $menus = Menu::all();
        }

        return view('dashboard.orders.index', compact('menus'));
    }
}