<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Matter;
use Illuminate\Http\Request;
use App\Models\Outcome;

class OutcomeController extends Controller
{
    public function index()
    {
        $outcome = Outcome::all();
        $matters = Matter::all();
        return view('outcome.index', compact('outcome', 'matters'));
    }

    public function create()
    {
        return view('outcome.create');
    }

    public function store(Request $request)
    {

        Outcome::create([
            'description' => $request->description,
            'matter_id' => $request->matter_id,
        ]);

        $notification = array(
            'message' => 'Outcome berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('outcome.index')->with($notification);
    }

    public function edit($id)
    {
        $outcome = Outcome::findOrFail($id);
        $matters = Matter::all();
        return view('outcome.edit', compact('outcome', 'matters'));
    }

    public function update(Request $request, string $id)
    {
        $outcome = Outcome::findOrFail($id);

        // Validate the request data
        $request->validate([
            'description' => 'required',
            'matter_id' => 'required',
        ]);

        $outcome->update([
            'description' => $request->description,
            'matter_id' => $request->matter_id,
        ]);

        $notification = array(
            'message' => 'Outcome berhasil diperbarui',
            'alert-type' => 'success'
        );
        return redirect()->route('outcome.index')->with($notification);
    }

    public function destroy($id)
    {
        Outcome::find($id)->delete();

        $notification = array(
            'message' => 'Outcome berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
