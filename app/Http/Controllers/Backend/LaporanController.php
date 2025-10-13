<?php

namespace App\Http\Controllers\Backend;

use App\Models\Report;
use App\Models\IkkMaster;
use App\Models\IkkReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $reports = IkkReport::latest()->get();

        $user = Auth::user();
        $skpd = $user->agency;
        $relevantMatterIds = $skpd->matters()->pluck('matters.id');
        $ikkMaster = IkkMaster::whereHas('matter', function ($query) use ($relevantMatterIds) {
            $query->whereIn('id', $relevantMatterIds);
        })->get();
        return view('report.index', compact('reports', 'ikkMaster'));
    }

    public function create($id)
    {
        $item = IkkMaster::findOrFail($id);
        return view('report.create', compact('item'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        // ]);
        $user = Auth::user();
        $year = date('Y');
        // $existingReport = IkkReport::where('ikk_master_id', $request->ikk_master_id)
        //     ->where('user_id', $request->user_id)
        //     ->where('year', $year)
        //     ->first();

        // if ($existingReport) {
        //     $notification = array(
        //         'message' => 'Laporan IKK untuk tahun ini sudah ada',
        //         'alert-type' => 'error'
        //     );
        //     return redirect()->back()->with($notification);
        // }

        IkkReport::create([
            'ikk_master_id' => $request->ikk_master_id,
            'user_id' => $user->id,
            'ikk_output' => $request->ikk_output,
            'year' => $year,
            'nilai_pembilang' => $request->nilai_pembilang,
            'nilai_penyebut' => $request->nilai_penyebut,
            'capaian' => $request->nilai_penyebut != 0 ? ($request->nilai_pembilang / $request->nilai_penyebut) * 100 : 0,
            'file' => $request->file('file') ? $request->file('file')->store('report') : null,
        ]);

        $notification = array(
            'message' => 'Laporan IKK berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('laporan.index')->with($notification);
    }

    public function edit($id)
    {
        $report = IkkReport::findOrFail($id);
        return view('report.edit', compact('report'));
    }

    public function update(Request $request, string $id)
    {
        $report = IkkReport::findOrFail($id);
        $user = Auth::user();
        $year = date('Y');

        $report->update([
            'ikk_master_id' => $report->ikk_master_id,
            'user_id' => $user->id,
            'ikk_output' => $request->ikk_output,
            'year' => $year,
            'nilai_pembilang' => $request->nilai_pembilang,
            'nilai_penyebut' => $request->nilai_penyebut,
            'capaian' => $request->nilai_penyebut != 0 ? ($request->nilai_pembilang / $request->nilai_penyebut) * 100 : 0,
            'file' => $request->file('file') ? $request->file('file')->store('report') : null,
        ]);

        $notification = array(
            'message' => 'SKPD berhasil diperbarui',
            'alert-type' => 'success'
        );
        return redirect()->route('laporan.index')->with($notification);
    }

    public function destroy($id)
    {
        IkkReport::find($id)->delete();

        $notification = array(
            'message' => 'SKPD berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
