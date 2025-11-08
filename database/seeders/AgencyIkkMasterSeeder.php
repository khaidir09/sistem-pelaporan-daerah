<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AgencyIkkMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Tentukan path ke file CSV Anda
        $csvFile = fopen(database_path('seeders/csv/ikk_agency.csv'), 'r');

        // 2. Siapkan array untuk menampung semua data
        $dataToInsert = [];
        $isHeader = true; // Flag untuk melewati baris header
        $now = Carbon::now(); // Waktu saat ini untuk timestamps

        // 3. Kosongkan tabel terlebih dahulu agar tidak ada duplikasi
        //    jika seeder dijalankan berulang kali.
        DB::table('agency_ikk_master')->truncate();

        // 4. Baca file CSV baris per baris
        while (($row = fgetcsv($csvFile, 2000, ',')) !== FALSE) {
            // Lewati baris header pertama
            if ($isHeader) {
                $isHeader = false;
                continue;
            }

            // 5. Tambahkan data ke array
            //    $row[0] adalah agency_id
            //    $row[1] adalah ikk_master_id
            $dataToInsert[] = [
                'agency_id'     => $row[0],
                'ikk_master_id' => $row[1],
                'created_at'    => $now,
                'updated_at'    => $now,
            ];
        }

        fclose($csvFile);

        // 6. Insert semua data ke database sekaligus
        //    Ini jauh lebih efisien daripada insert satu per satu
        DB::table('agency_ikk_master')->insert($dataToInsert);

        $this->command->info('Tabel agency_ikk_master telah di-seed dari CSV.');
    }
}
