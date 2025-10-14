<?php

namespace App\Http\Controllers;

use App\Models\IkkReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        if ($user->hasRole('Super Admin')) {
            return view('admin.index');
        } elseif ($user->hasRole('User')) {
            return view('user.index');
        } elseif ($user->hasRole('APIP')) {
            $perluValidasi = IkkReport::where('reviu', null)->count();
            $sudahValidasi = IkkReport::whereNotNull('reviu')->count();
            $dimintaPerbaikan = IkkReport::where('reviu', 'Perbaikan')->count();

            $data = IkkReport::where('reviu', null)->latest()->get();
            return view('pengawas.index', compact('perluValidasi', 'sudahValidasi', 'dimintaPerbaikan', 'data'));
        } else {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke dashboard.');
        }
    }
}
