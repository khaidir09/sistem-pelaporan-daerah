<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agency;
use App\Models\Matter;
use App\Models\IkkMaster;
use App\Models\IkkReport;
use App\Models\ReportHistory;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        $jumlahSkpd = Agency::all()->count();
        $jumlahUrusan = Matter::all()->count();
        $dibuat = IkkReport::where('year', date('Y'))
            ->count();
        $disetujui = IkkReport::where('year', date('Y'))
            ->where('status', 'Disetujui')
            ->count();
        $revisi = IkkReport::where('year', date('Y'))
            ->where('status', 'Revisi')
            ->count();
        $menunggu = IkkReport::where('year', date('Y'))
            ->whereIn('status', ['Dikirim', 'Dikirim Ulang'])
            ->count();

        // Menghitung jumlah laporan yang sudah dibuat oleh pengguna pada tahun ini
        $laporanDibuat = IkkReport::where('user_id', $user->id)
            ->where('year', date('Y'))
            ->count();

        // Menghitung jumlah laporan yang sudah disetujui pada tahun ini 
        $laporanDisetujui = IkkReport::where('user_id', $user->id)
            ->where('year', date('Y'))
            ->where('status', 'Disetujui')
            ->count();

        // Menghitung jumlah laporan yang statusnya revisi pada tahun ini
        $laporanRevisi = IkkReport::where('user_id', $user->id)
            ->where('year', date('Y'))
            ->where('status', 'Revisi')
            ->count();

        $laporanMenunggu = IkkReport::where('user_id', $user->id)
            ->where('year', date('Y'))
            ->where('status', 'Dikirim')
            ->count();

        $perluValidasi = IkkReport::where('status', 'Dikirim')->count();
        $sudahValidasi = IkkReport::where('status', 'Disetujui')->count();
        $dimintaPerbaikan = IkkReport::where('status', 'Revisi')->count();
        $kirimUlang = IkkReport::where('status', 'Dikirim Ulang')->count();

        $data = IkkReport::whereIn('status', ['Dikirim', 'Dikirim Ulang'])->latest()->get();

        if ($user->hasRole('Super Admin')) {
            return view('admin.index', compact('jumlahUrusan', 'jumlahSkpd', 'dibuat', 'disetujui', 'revisi', 'menunggu', 'data'));
        } elseif ($user->hasRole('User')) {
            // Menghitung total urusan IKK yang menjadi tanggung jawab agensi pengguna
            $totalUrusan = Matter::whereHas('agencies', function ($query) use ($user) {
                $query->where('agencies.id', $user->agency_id);
            })->count();

            $totalIndikator = IkkMaster::with('agencies')
                ->whereHas('agencies', function ($query) use ($user) {
                    $query->where('agency_id', $user->agency_id);
                })->count();

            $reportLockStatus = SystemSetting::where('key', 'report_lock_status')->first();

            $skpdHistoryReport = ReportHistory::whereHas('ikkReport', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->latest()->take(5)->get();

            return view('user.index', compact('user', 'totalUrusan', 'totalIndikator', 'laporanDibuat', 'laporanDisetujui', 'laporanRevisi', 'laporanMenunggu', 'reportLockStatus', 'skpdHistoryReport'));
        } elseif ($user->hasRole('APIP')) {
            return view('pengawas.index', compact('perluValidasi', 'sudahValidasi', 'dimintaPerbaikan', 'kirimUlang', 'data'));
        } else {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke dashboard.');
        }
    }
}
