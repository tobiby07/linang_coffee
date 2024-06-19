<?php

namespace App\Http\Controllers;

use App\Models\KategoriMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KategoriMenuController extends Controller
{
    public function index()
    {
        try {
            $kategoriMenu = KategoriMenu::all();
            $menu = Menu::all();

            return view('menu', compact('kategoriMenu', 'menu'));
        } catch (\Exception $exception) {
            Log::error('Error fetching kategori_menu and menu data: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'Failed to retrieve data.');
        }
    }

    public function create()
    {
        return view('menu');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $kategoriMenu = KategoriMenu::create($validatedData);
            Log::info('Kategori Menu created successfully: ' . $kategoriMenu->name);

            return redirect()->route('kategori-menu.index')->with('success', 'Kategori Menu created successfully.');
        } catch (\Exception $exception) {
            Log::error('Error creating kategori_menu: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'Failed to create kategori menu.');
        }
    }

    public function show(KategoriMenu $kategoriMenu)
    {
        return view('menu', compact('kategoriMenu'));
    }

    public function edit(KategoriMenu $kategoriMenu)
    {
        return view('menu', compact('kategoriMenu'));
    }

    public function update(Request $request, KategoriMenu $kategoriMenu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $kategoriMenu->update($request->all());
            Log::info('Kategori Menu updated successfully: ' . $kategoriMenu->name);

            return redirect()->route('kategori-menu.index')->with('success', 'Kategori Menu updated successfully.');
        } catch (\Exception $exception) {
            Log::error('Error updating kategori_menu: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'Failed to update kategori menu.');
        }
    }

    public function destroy(KategoriMenu $kategoriMenu)
    {
        try {
            $kategoriMenu->delete();
            Log::info('Kategori Menu deleted successfully: ' . $kategoriMenu->name);

            return redirect()->route('kategori-menu.index')->with('success', 'Kategori Menu deleted successfully.');
        } catch (\Exception $exception) {
            Log::error('Error deleting kategori_menu: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'Failed to delete kategori menu.');
        }
    }
}
