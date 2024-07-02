<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\KategoriMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
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
        $kategoriMenu = KategoriMenu::all();
        return view('menu', compact('kategoriMenu'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kategori_menu_id' => 'required|exists:kategori_menu,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $validatedData['image'] = $imagePath;
            }

            $menu = Menu::create($validatedData);
            Log::info('Menu created successfully: ' . $menu->name);

            return redirect()->route('menu.index')->with('success', 'Menu created successfully.');
        } catch (\Exception $exception) {
            Log::error('Error creating menu: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'Failed to create menu.');
        }
    }

    public function show(Menu $menu)
    {
        return view('menu', compact('menu'));
    }

    public function edit(Menu $menu)
    {
        $kategoriMenu = KategoriMenu::all();
        return view('menu', compact('menu', 'kategoriMenu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'kategori_menu_id' => 'required|exists:kategori_menu,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $validatedData['image'] = $imagePath;
            }

            $menu->update($validatedData);
            Log::info('Menu updated successfully: ' . $menu->name);

            return redirect()->route('menu.index')->with('success', 'Menu updated successfully.');
        } catch (\Exception $exception) {
            Log::error('Error updating menu: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'Failed to update menu.');
        }
    }

    public function destroy(Menu $menu)
{
    try {
        $menu->delete();
        Log::info('Menu deleted successfully: ' . $menu->name);

        return redirect()->route('menu')->with('success', 'Menu deleted successfully.');
    } catch (\Exception $exception) {
        Log::error('Error deleting menu: ' . $exception->getMessage());
        return redirect()->back()->with('error', 'Failed to delete menu.');
    }
}

    public function toggleStatus($id)
    {
        try {
            $menu = Menu::findOrFail($id);
            $menu->status = !$menu->status;
            $menu->save();
            return redirect()->back()->with('success', 'Menu status updated successfully.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Failed to update menu status.');
    }
    }
}
