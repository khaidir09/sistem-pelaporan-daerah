<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matter;

class UrusanController extends Controller
{
    public function index()
    {
        $matter = Matter::all();
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
            'category' => $request->category,
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
            'category' => 'required|in:Urusan Pemerintahan Wajib Berkaitan Pelayanan Dasar,Urusan Pemerintahan Wajib Tidak Berkaitan Pelayanan Dasar,Pilihan',
        ]);

        $matter->update([
            'name' => $request->name,
            'category' => $request->category,
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
