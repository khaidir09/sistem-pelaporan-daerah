<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matter;

class UrusanController extends Controller
{
    public function index()
    {
        $matter = Matter::latest()->get();
        return view('urusan.index', compact('matter'));
    }

    public function create()
    {
        return view('urusan.create');
    }

    public function store(Request $request)
    {

        Matter::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Urusan berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('urusan.index')->with($notification);
    }

    public function edit($id)
    {
        $matter = Matter::findOrFail($id);
        return view('urusan.edit', compact('matter'));
    }

    public function update(Request $request, string $id)
    {
        $matter = Matter::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $matter->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Urusan berhasil diperbarui',
            'alert-type' => 'success'
        );
        return redirect()->route('urusan.index')->with($notification);
    }

    public function destroy($id)
    {
        Matter::find($id)->delete();

        $notification = array(
            'message' => 'Urusan berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
