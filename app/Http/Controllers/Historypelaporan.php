<?php

namespace App\Http\Controllers;

use App\Models\Fasum_model;
use App\Models\Historypelaporan_model;
use App\Models\Jenisfasum_model;
use App\Models\Kota_model;
use App\Models\Pelaporan_model;
use App\Models\Staff_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Historypelaporan extends Controller
{

    public function index()
    {
        return view('historypelaporan_v');
    }
    public function getData()
    {
        $data = DB::select("SELECT
        h.idhistory,
        h.tgl_perubahan,
        p.nomor AS nomor_pelaporan,
        s.nama AS nama_staff,
        h.status_sebelumnya,
        h.status_setelahnya,
        h.keterangan
        FROM t_history_perbaikan h LEFT JOIN m_staff s ON s.idm_staff = h.idstaff
        LEFT JOIN t_pelaporan p ON p.idpelaporan = h.idpelaporan;
        ");
        $pelaporan = [];
        foreach ($data as $key => $value) {
            $escaped_keterangan = addslashes($value->keterangan);

            $tombol = '<a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="editKeterangan(' . $value->idhistory . ', \'' . $escaped_keterangan . '\')">
                Edit
            </a>';

            $pelaporan[] = array(
                $value->tgl_perubahan,
                $value->nomor_pelaporan,
                $value->nama_staff,
                $value->status_sebelumnya,
                $value->status_setelahnya,
                $value->keterangan ?? "Keterangan belum ditambahkan",
                $tombol
            );
        }

        echo json_encode($pelaporan);
    }

    public static function updateKeterangan(Request $request)
    {
        $history = Historypelaporan_model::find($request->id);
        $history->keterangan = $request->keterangan;
        $history->save();

        return response()->json(['success' => "hello"]);
    }
}
