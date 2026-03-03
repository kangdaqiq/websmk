<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = \App\Models\Teacher::latest()->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('teachers', 'public');
        }

        \App\Models\Teacher::create($data);
        return redirect()->route('admin.teachers.index')->with('success', 'Data guru berhasil ditambahkan');
    }

    public function edit(\App\Models\Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, \App\Models\Teacher $teacher)
    {
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($teacher->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($teacher->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($teacher->image);
            }
            $data['image'] = $request->file('image')->store('teachers', 'public');
        }

        $teacher->update($data);
        return redirect()->route('admin.teachers.index')->with('success', 'Data guru berhasil diupdate');
    }

    public function destroy(\App\Models\Teacher $teacher)
    {
        if ($teacher->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($teacher->image)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($teacher->image);
        }
        $teacher->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Data guru berhasil dihapus');
    }
}
