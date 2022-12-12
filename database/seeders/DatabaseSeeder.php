<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Ncr;
use App\Models\Ofi;
use App\Models\TLNcr;
use App\Models\TLOfi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'nip' => "001",
            'role' => "Admin",
            'name' => "Administrator",
            'username' => 'admin',
            // 'email' => 'admin@simtl.test',
            'password' => Hash::make('123'),
        ]);

        \App\Models\User::factory()->create([
            'nip' => "002",
            'role' => "Auditor",
            'name' => "Auditor",
            'username' => 'auditor',
            // 'email' => 'auditor@simtl.test',
            'password' => Hash::make('123'),
        ]);

        \App\Models\User::factory()->create([
            'nip' => "003",
            'role' => "Auditee",
            'name' => "Auditee",
            'username' => 'auditee',
            // 'email' => 'auditee@simtl.test',
            'password' => Hash::make('123'),
        ]);

        \App\Models\User::factory()->create([
            'nip' => "004",
            'role' => "Auditee",
            'name' => "Auditee2",
            'username' => 'auditee2',
            // 'email' => 'auditee@simtl.test',
            'password' => Hash::make('123'),
        ]);

        for ($i = 1; $i <= 3; $i++)
        {
            Ncr::create([
                'id_ncr' => $i,
                'no_ncr' => '123',
                'proses_audit' => 'Internal',
                'tema_audit' => 'ISO 9001',
                'objek_audit' => $i == 2 ? '4' : '3',
                'jenis_temuan' => 'Ketidaksesuaian',
                'dokumen' => '',
                'tgl_terbitncr' => '2022-11-12',
                'status' => $i == 2 ? 'Belum Ditindaklanjuti' : 'Sudah Ditindaklanjuti',
                'bukti' => '',
                'bab_audit' => '1',
                'dok_acuan' => '2',
                'uraian_ncr' => '3',
                'kategori' => 'Mayor',
                'nama_auditor' => '4',
                'tgl_deadline' => $i == 2 ? '2022-11-30' : '2022-11-14',
                'diakui_oleh' => '5',
                'disetujui_oleh' => '6',
                'tgl_accgm' => '2022-11-12',
                'tgl_planaction' => '2022-11-12',
            ]);

            TLNcr::create([
                'id_ncr' => $i,
                'akar_masalah' => '1',
                'uraian_perbaikan' => '2',
                'uraian_pencegahan' => '3',
                'tgl_action' => '2022-11-12',
                'tgl_accgm' => '2022-11-12',
                'uraian_verifikasi' => '4',
                'hasil_verif' => 'efektif',
                'verifikator' => '5',
                'tgl_verif' => '2022-11-12',
                'rekomendasi' => '6',
                'namasm_verif' => '7',
            ]);
        }

        for ($i = 1; $i <= 3; $i++)
        {
            Ofi::create([
                'id_ofi' => $i,
                'no_ofi' => '123',
                'proses_audit' => 'Eksternal',
                'tema_audit' => 'ISO 9001',
                'objek_audit' => $i != 2 ? '4' : '3',
                'jenis_temuan' => 'Ketidaksesuaian',
                'dokumen' => '',
                'tgl_terbitofi' => '2022-11-12',
                'status' => $i != 2 ? 'Belum Ditindaklanjuti' : 'Sudah Ditindaklanjuti',
                'bukti' => '',
                'asal_dept' => '1',
                'proyek' => '2',
                'dept_ygmngrjkn' => '4',
                'usulan_ofi' => '3',
                'uraian_permasalahan' => '5',
                'usulan_peningkatan' => '6',
                'dept_pengusul' => '7',
                'tgl_diusulkan' => '2022-11-12',
                'disetujui_oleh' => '8',
                'tgl_disetujui' => '2022-11-12',
                'disposisi' => 'OFI ditolak',
                'tgl_deadline' => $i != 2 ? '2022-11-10' : '2022-11-14',
            ]);

            TLOfi::create([
                'id_ofi' => $i,
                'tl_usulanofi' => '1',
                'nama_pekerjatl' => '2',
                'tgl_tl' => '2022-11-12',
                'uraian_verif' => '3',
                'hasil_verif' => '4',
                'nama_verifikator' => '5',
                'tgl_verif' => '2022-11-12',
                'eval_saran' => '6',
                'nama_evaluator' => '7',
                'skor' => '8',
                'rekom_tinjauan' => '9',
                'namasm_verifikator' => '10',
            ]);
        }
    }
}
