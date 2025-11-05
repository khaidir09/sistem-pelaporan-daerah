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
        $ikkMaster = IkkMaster::orderBy('id', 'asc')->get();
        return view('outcome.index', compact('ikkMaster'));
    }

    public function create()
    {
        $matters = Matter::all();
        return view('outcome.create', compact('matters'));
    }

    public function store(Request $request)
    {
        $data = [
            'matter_id' => $request->matter_id,
            'urutan' => $request->urutan,
            'ikk_outcome' => $request->ikk_outcome,
            'calculation_type' => $request->calculation_type,
        ];

        if ($request->calculation_type === 'formula') {
            $data['definisi_pembilang'] = $request->definisi_pembilang;
            $data['definisi_penyebut'] = $request->definisi_penyebut;
        } elseif ($request->calculation_type === 'checklist') {
            $data['calculation_meta'] = json_encode(['questions' => $request->calculation_meta['questions']]);
        }

        IkkMaster::create($data);

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

        $data = [
            'matter_id' => $request->matter_id,
            'urutan' => $request->urutan,
            'ikk_outcome' => $request->ikk_outcome,
            'calculation_type' => $request->calculation_type,
            'definisi_pembilang' => null,
            'definisi_penyebut' => null,
            'calculation_meta' => null,
        ];

        if ($request->calculation_type === 'formula') {
            $data['definisi_pembilang'] = $request->definisi_pembilang;
            $data['definisi_penyebut'] = $request->definisi_penyebut;
        } elseif ($request->calculation_type === 'checklist') {
            $data['calculation_meta'] = json_encode(['questions' => $request->calculation_meta['questions']]);
        }

        $outcome->update($data);

        $notification = array(
            'message' => 'Outcome berhasil diperbarui',
            'alert-type' => 'success'
        );
        return redirect()->route('outcome.index')->with($notification);
    }

    public function destroy($id)
    {
        IkkMaster::find($id)->delete();

        $notification = array(
            'message' => 'Outcome berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
