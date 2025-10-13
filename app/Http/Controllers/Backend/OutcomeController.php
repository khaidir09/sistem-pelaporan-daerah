<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\IkkMaster;
use App\Models\Matter;
use Illuminate\Http\Request;
use App\Models\Outcome;

class OutcomeController extends Controller
{
    public function index()
    {
        $ikkMaster = IkkMaster::all();
        return view('outcome.index', compact('ikkMaster'));
    }

    public function create()
    {
        $matters = Matter::all();
        return view('outcome.create', compact('matters'));
    }

    public function store(Request $request)
    {

        IkkMaster::create([
            'matter_id' => $request->matter_id,
            'urutan' => $request->urutan,
            'ikk_outcome' => $request->ikk_outcome,
            'definisi_pembilang' => $request->definisi_pembilang,
            'definisi_penyebut' => $request->definisi_penyebut,
        ]);

        $notification = array(
            'message' => 'Outcome berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('outcome.index')->with($notification);
    }

    public function edit($id)
    {
        $ikkMaster = IkkMaster::findOrFail($id);
        $matters = Matter::all();
        return view('outcome.edit', compact('ikkMaster', 'matters'));
    }

    public function update(Request $request, string $id)
    {
        $outcome = IkkMaster::findOrFail($id);

        $outcome->update([
            'matter_id' => $request->matter_id,
            'urutan' => $request->urutan,
            'ikk_outcome' => $request->ikk_outcome,
            'definisi_pembilang' => $request->definisi_pembilang,
            'definisi_penyebut' => $request->definisi_penyebut,
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
