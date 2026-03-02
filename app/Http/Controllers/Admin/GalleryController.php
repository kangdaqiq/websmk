<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image',
            'description' => 'nullable'
        ]);

        $data = $request->all();
        $data['image'] = $request->file('image')->store('galleries', 'public');

        Gallery::create($data);
        return redirect()->route('admin.galleries.index')->with('success', 'Foto berhasil ditambahkan');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image',
            'description' => 'nullable'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            $data['image'] = $request->file('image')->store('galleries', 'public');
        }

        $gallery->update($data);
        return redirect()->route('admin.galleries.index')->with('success', 'Foto berhasil diupdate');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Foto berhasil dihapus');
    }
}
