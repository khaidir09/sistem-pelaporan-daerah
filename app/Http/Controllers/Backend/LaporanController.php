<?php

namespace App\Http\Controllers\Backend;

use App\Models\Report;
use App\Models\IkkMaster;
use App\Models\IkkReport;
use Illuminate\Http\Request;
use App\Models\ReportHistory;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $ikkMaster = []; // Inisialisasi variabel

        if ($user->hasRole('User')) {
            $ikkMaster = IkkMaster::whereHas('matter.agencies', function ($query) use ($user) {
                $query->where('agencies.id', $user->agency_id);
            })->get();
        } else {
            $ikkMaster = IkkMaster::with('matter.agencies')->get();
        }
        return view('report.index', compact('ikkMaster'));
    }

    public function create($id)
    {
        $reportLockStatus = SystemSetting::where('key', 'report_lock_status')->first();
        if ($reportLockStatus && $reportLockStatus->value == 'Locked') {
            $notification = array(
                'message' => 'Akses laporan sedang dikunci',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $item = IkkMaster::findOrFail($id);
        return view('report.create', compact('item'));
    }

    public function store(Request $request)
    {
        $reportLockStatus = SystemSetting::where('key', 'report_lock_status')->first();
        if ($reportLockStatus && $reportLockStatus->value == 'Locked') {
            $notification = array(
                'message' => 'Akses laporan sedang dikunci',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $user = Auth::user();
        $year = date('Y');
        $item = IkkMaster::find($request->ikk_master_id);

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // 2. Buat nama file yang unik (contoh: 178456982.pdf)
            $fileName = $item->matter->category_id . '.' . $item->matter->kode_urusan . '.' . $item->urutan . '_' . $user->agency->name . '_' . $year . '.' . $file->getClientOriginalExtension();

            // 3. Pindahkan file ke public/upload/laporan
            $file->move(public_path('upload/laporan'), $fileName);
        }

        $report = IkkReport::create([
            'ikk_master_id' => $request->ikk_master_id,
            'user_id' => $user->id,
            'ikk_output' => $request->ikk_output,
            'year' => $year,
            'nilai_pembilang' => $request->nilai_pembilang,
            'nilai_penyebut' => $request->nilai_penyebut,
            'capaian' => $request->nilai_penyebut != 0 ? ($request->nilai_pembilang / $request->nilai_penyebut) * 100 : 0,
            'file' => $fileName,
            'status' => 'Dikirim'
        ]);

        $dataSnapshot = $report->toArray();
        $dataSnapshot['ikk_output'] = $request->ikk_output;
        $dataSnapshot['nilai_pembilang'] = $request->nilai_pembilang;
        $dataSnapshot['nilai_penyebut'] = $request->nilai_penyebut;
        $dataSnapshot['capaian'] = $request->nilai_penyebut != 0 ? ($request->nilai_pembilang / $request->nilai_penyebut) * 100 : 0;

        ReportHistory::create([
            'ikk_report_id' => $report->id,
            'user_id' => $user->id,
            'status' => 'Dikirim',
            'keterangan' => null,
            'data_snapshot' => json_encode($dataSnapshot),
        ]);

        $notification = array(
            'message' => 'Laporan IKK berhasil ditambahkan',
            'alert-type' => 'success'
        );
        return redirect()->route('laporan.index')->with($notification);
    }

    public function edit($id)
    {
        $reportLockStatus = SystemSetting::where('key', 'report_lock_status')->first();
        $report = IkkReport::findOrFail($id);
        return view('report.edit', compact('report', 'reportLockStatus'));
    }

    public function update(Request $request, string $id)
    {
        $reportLockStatus = SystemSetting::where('key', 'report_lock_status')->first();
        if ($reportLockStatus && $reportLockStatus->value == 'Locked') {
            $notification = array(
                'message' => 'Akses laporan sedang dikunci',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
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
            'status' => 'Dikirim Ulang'
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

        $dataSnapshot = $report->toArray();
        $dataSnapshot['ikk_output'] = $request->ikk_output;
        $dataSnapshot['nilai_pembilang'] = $request->nilai_pembilang;
        $dataSnapshot['nilai_penyebut'] = $request->nilai_penyebut;
        $dataSnapshot['capaian'] = $request->nilai_penyebut != 0 ? ($request->nilai_pembilang / $request->nilai_penyebut) * 100 : 0;

        ReportHistory::create([
            'ikk_report_id' => $report->id,
            'user_id' => $user->id,
            'status' => 'Dikirim Ulang',
            'keterangan' => null,
            'data_snapshot' => json_encode($dataSnapshot),
        ]);

        $notification = array(
            'message' => 'Laporan IKK berhasil diperbarui',
            'alert-type' => 'success'
        );
        return redirect()->route('laporan.index')->with($notification);
    }

    public function history()
    {
        $user = Auth::user();
        if ($user->hasRole('APIP')) {
            $historyReport = ReportHistory::where('user_id', $user->id)->latest()->get();
        } else {
            $historyReport = ReportHistory::with('ikkReport')->whereIn('status', ['Disetujui', 'Revisi'])->latest()->get();
        }
        return view('report.history', compact('historyReport'));
    }

    public function destroy($id)
    {
        $reportLockStatus = SystemSetting::where('key', 'report_lock_status')->first();
        if ($reportLockStatus && $reportLockStatus->value == 'Locked') {
            $notification = array(
                'message' => 'Akses laporan sedang dikunci',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        IkkReport::find($id)->delete();

        $notification = array(
            'message' => 'Laporan IKK berhasil dihapus',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
