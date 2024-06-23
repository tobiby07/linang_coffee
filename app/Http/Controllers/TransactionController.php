<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\KategoriMenu;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;


class TransactionController extends Controller
{

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
    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);
        $menu = Menu::find($request->menu_id);

        if(isset($cart[$request->menu_id])) {
            $cart[$request->menu_id]['quantity'] += $request->quantity;
        } else {
            $cart[$request->menu_id] = [
                "name" => $menu->name,
                "quantity" => $request->quantity,
                "price" => $menu->price,
                "image" => $menu->image
            ];
        }

        session()->put('cart', $cart);
        return redirect('kasir')->with('success', 'Item added to cart successfully!');
    }

    public function viewCart()
    {
       

        $kategoriMenus = KategoriMenu::all();
        $menus = Menu::all();

     
        return view('kasir', compact('kategoriMenus', 'menus'));
    }

    public function removeFromCart($id)
    {
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->back()->with('success', 'Item removed from cart successfully!');
    }


    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_column($cart, 'price'));

        $transaction = Transaction::create([
            'total' => $total,
            'user_id' => Auth::id(),
        ]);

        foreach ($cart as $id => $details) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'menu_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }

        session()->forget('cart');


        // Generate PDF
        $pdf = FacadePdf::loadView('invoice', compact('transaction', 'cart'))
                ->setPaper('a5', 'potrait');       
        return $pdf->download('invoicce.pdf');
            
        
    }
}
