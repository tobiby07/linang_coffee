<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function kasir()
    {
        $menus = Menu::all();
        return view('kasir', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $total = 0;
        $items = [];

        foreach ($request->items as $item) {
            $menu = Menu::find($item['menu_id']);
            $total += $menu->price * $item['quantity'];
            $items[] = [
                'menu_id' => $menu->id,
                'quantity' => $item['quantity'],
                'price' => $menu->price,
            ];
        }

        $transaction = Transaction::create([
            'total' => $total,
            'user_id' => Auth::id(),
        ]);

        foreach ($items as $item) {
            $item['transaction_id'] = $transaction->id;
            TransactionItem::create($item);
        }

        return redirect()->route('kasir')->with('success', 'Transaction completed successfully.');
    }

    public function laporan()
    {
        $transactions = Transaction::with('items.menu', 'user')->get();
        return view('laporan', compact('transactions'));
    }
    public function show(Transaction $transaction) 
    {
        $transaction->load('items.menu');  
        return view('laporan', compact('transaction')); 
    }
}
