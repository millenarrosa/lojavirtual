<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pendente',
            'total' => $product->price,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => $product->price,
        ]);

        return redirect()->back()->with('success', 'Pedido realizado com sucesso!');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

public function adminIndex()
{
    $orders = Order::with('items.product', 'user')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('orders.admin', compact('orders'));
}
}