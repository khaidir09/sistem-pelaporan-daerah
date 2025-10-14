<?php

namespace App\Http\Controllers\Pengawas;

use App\Models\Report;
use App\Models\IkkMaster;
use App\Models\IkkReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanPengawasController extends Controller
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

    public function show($id)
    {
        $report = IkkReport::findOrFail($id);
        return view('pengawas.detail', compact('report'));
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
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // 2. Buat nama file yang unik (contoh: 178456982.pdf)
            $fileName = $report->ikkMaster->matter->category_id . '.' . $report->ikkMaster->matter->kode_urusan . '.' . $report->ikkMaster->urutan . '_' . $user->agency->name . '_' . $year . '.' . $file->getClientOriginalExtension();

            // 3. Pindahkan file ke public/upload/laporan
            $file->move(public_path('upload/laporan'), $fileName);

            // Hapus file lama jika ada
            if ($report->file && file_exists(public_path('upload/laporan/' . $report->file))) {
                unlink(public_path('upload/laporan/' . $report->file));
            }

            // Update nama file di database
            $report->update(['file' => $fileName]);
        }

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
