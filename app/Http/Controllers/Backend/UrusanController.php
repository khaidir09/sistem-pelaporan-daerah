<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matter;
use App\Models\MatterCategory;

class UrusanController extends Controller
{
    public function index()
    {
        $matter = Matter::all();
        return view('urusan.index', compact('matter'));
    }

    public function create()
    {
        $categories = MatterCategory::all();
        return view('urusan.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'kode_urusan' => 'required',
            'category_id' => 'required',
        ]);

        Matter::create([
            'name' => $request->name,
            'kode_urusan' => $request->kode_urusan,
            'category_id' => $request->category_id,
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
        $categories = MatterCategory::all();
        return view('urusan.edit', compact('matter', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $matter = Matter::findOrFail($id);

        // Validate the request data
        $request->validate([
            'name' => 'required|max:255',
            'kode_urusan' => 'required',
            'category_id' => 'required',
        ]);

        $matter->update([
            'name' => $request->name,
            'kode_urusan' => $request->kode_urusan,
            'category_id' => $request->category_id,
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
