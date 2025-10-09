<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Agency;
use Illuminate\Http\Request;

class SkpdController extends Controller
{
    public function index()
    {
        $agencies = Agency::latest()->get();
        return view('skpd.index', compact('agencies'));
    }

    public function create()
    {
        return view('skpd.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Agency::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'SKPD berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('skpd.index')->with($notification);
    }

    public function edit($id)
    {
        $agency = Agency::findOrFail($id);
        return view('skpd.edit', compact('agency'));
    }

    public function update(Request $request, string $id)
    {
        $agency = Agency::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $agency->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'SKPD berhasil diperbarui',
            'alert-type' => 'success'
        );
        return redirect()->route('skpd.index')->with($notification);
    }

    public function destroy($id)
    {
        Agency::find($id)->delete();

        $notification = array(
            'message' => 'SKPD berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}