<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Categories::all(); // Ambil semua data categories
        return view('categories.index', compact('categories'));
    }
    public function create()
    {
        return view('categories.create');
    }
     public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);
        
        Categories::create([
            'name' => $request->name,
        ]);
        return redirect()->route('categories.index')->with('success', 'Data berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $categories = Categories::findOrFail($id);
        return view('categories.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100' . $id,
        ]);

        $categories = Categories::findOrFail($id);
        $categories->update([
            'name' => $request->name,
        ]);
        return redirect()->route('categories.index')->with('success', 'Data berhasil diupdate.');
    }
    public function destroy($id)
    {
        $categories = categories::findOrFail($id);
        $categories->delete();
        return redirect()->route('categories.index')->with('success', 'Data berhasil dihapus.');
    }    
}
