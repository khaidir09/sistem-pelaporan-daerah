<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agencies = [
            ['name' => 'Bagian Pemerintahan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Inspektorat Daerah', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Pendidikan dan Kebudayaan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Kesehatan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Pekerjaan Umum dan Perumahan Rakyat', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Perkim LH', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Satpol PP dan Damkar', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'BPBD', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Sosial', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Penanaman Modal dan PTSP', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Ketahanan Pangan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Dukcatpil', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Pemberdayaan Masyarakat dan Desa', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Pengendalian Penduduk dan Keluarga Berencana', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Perhubungan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Komunikasi, informatika dan Persandian', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Koperasi, UKM, Perindag', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Pemuda,Olahraga dan Pariwisata', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Perpustakaan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Perikanan', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dinas Pertanian', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Bagian Perekonomian dan SDA', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'BPKAD', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Bagian Pengadaan Barang dan Jasa - BKPSDM', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('agencies')->insert($agencies);
    }
}
