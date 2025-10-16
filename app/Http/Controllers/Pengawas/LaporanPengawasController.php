<?php

namespace App\Http\Controllers\Pengawas;

use App\Models\Report;
use App\Models\IkkMaster;
use App\Models\IkkReport;
use Illuminate\Http\Request;
use App\Models\ReportHistory;
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

    public function storeReviu(Request $request, string $id)
    {
        $report = IkkReport::findOrFail($id);

        $report->update([
            'reviu' => $request->input('action') === 'Setuju' ? 'Disetujui' : 'Revisi',
            'status' => $request->input('action') === 'Setuju' ? 'Disetujui' : 'Revisi',
            'keterangan' => $request->input('keterangan'),
            // 'updated_at' => now(),
        ]);

        ReportHistory::create([
            'ikk_report_id' => $report->id,
            'user_id' => Auth::id(),
            'status' => $request->input('action') === 'Setuju' ? 'Disetujui' : 'Revisi',
            'keterangan' => $request->input('keterangan'),
        ]);

        $notification = array(
            'message' => 'Laporan berhasil direviu',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
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
