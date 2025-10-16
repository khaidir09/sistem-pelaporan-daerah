<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\IkkMaster;
use App\Models\IkkReport;
use App\Models\Matter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        if ($user->hasRole('Super Admin')) {
            return view('admin.index');
        } elseif ($user->hasRole('User')) {
            // Menghitung total urusan IKK yang menjadi tanggung jawab agensi pengguna
            $totalUrusan = Matter::whereHas('agencies', function ($query) use ($user) {
                $query->where('agencies.id', $user->agency_id);
            })->count();

            $totalIndikator = IkkMaster::whereHas('matter', function ($query) use ($user) {
                $query->whereHas('agencies', function ($subQuery) use ($user) {
                    $subQuery->where('agencies.id', $user->agency_id);
                });
            })->count();

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

            return view('user.index', compact('totalUrusan', 'totalIndikator', 'laporanDibuat', 'laporanDisetujui', 'laporanRevisi', 'laporanMenunggu'));
        } elseif ($user->hasRole('APIP')) {
            $perluValidasi = IkkReport::where('status', 'Dikirim')->count();
            $sudahValidasi = IkkReport::where('status', 'Disetujui')->count();
            $dimintaPerbaikan = IkkReport::where('status', 'Revisi')->count();
            $kirimUlang = IkkReport::where('status', 'Dikirim Ulang')->count();

            $data = IkkReport::whereIn('status', ['Dikirim', 'Revisi', 'Dikirim Ulang'])->latest()->get();
            return view('pengawas.index', compact('perluValidasi', 'sudahValidasi', 'dimintaPerbaikan', 'kirimUlang', 'data'));
        } else {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke dashboard.');
        }
    }
}
