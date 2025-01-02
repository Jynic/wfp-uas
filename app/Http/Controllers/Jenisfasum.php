<?php

namespace App\Http\Controllers;

use App\Models\Jenisfasum_model;
use App\Models\Kota_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Jenisfasum extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idjabatan = Auth::user()->idjabatan;
        $data = DB::select('select ha.idjabatan, ha2.kode_fitur, ha2.nama_fitur from a_hak_akses_jabatan ha inner join a_hak_akses ha2 on ha.idhak_akses=ha2.idhak_akses where idjabatan = :idjabat', ['idjabat' => $idjabatan]);
        foreach ($data as $key => $row) {
            if ($row->nama_fitur == "master_jenis_fasilitas_umum") {
                return view('jenis_fasum_v');
            }
        }
        return view('dashboard_v');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kota_model $kota_model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];

        $result = DB::select("
        select kf.idkategori_fasum as id, kf.nama, kf.status_aktif from m_kategori_fasum kf where kf.idkategori_fasum = :id", ['id' => $id]);
        return json_encode($result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();
        if (isset($data['form']) && is_array($data['form'])) {
            $dataAssoc = [];
            foreach ($data['form'] as $item) {
                $dataAssoc[$item['name']] = $item['value'];
            }
            $id = $dataAssoc['id'] ?? null;
            $nama = $dataAssoc['nama'] ?? null;
        } else {
            $id = $data['id'] ?? null;
            $nama = $data['nama'] ?? null;
        }
        $jenis_fasum = Jenisfasum_model::where('idkategori_fasum', $id)->first();
        $jenis_fasum->nama = $nama ?? $jenis_fasum->nama;
        $jenis_fasum->save();
        echo json_encode(array("status" => TRUE));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kota_model $kota_model)
    {
        //
    }
    public function getData(Request $request)
    {
        $data = DB::select('SELECT kf.idkategori_fasum AS id, kf.nama, kf.status_aktif
                FROM m_kategori_fasum kf
                WHERE kf.status_aktif = 1');

        $jenis_fasum = [];
        foreach ($data as $key => $value) {
            $jenis_fasum[] = array(
                $value->nama,
                ($value->status_aktif == 1) ?
                    '<span class="badge bg-success">Active</span>' :
                    '<span class="badge bg-danger">Inactive</span>',
                '<div class="d-flex justify-content-center">
                <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="edit(' . $value->id . ')">
                    <i class="bx bx-edit-alt"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm ms-3" onclick="hapus(' . $value->id . ')">
                    <i class="bx bx-trash"></i>
                </a>
                </div>'
            );
        }
        // Kirim data dalam format JSON
        echo json_encode($jenis_fasum);
    }
    public function getDataKota(Request $request)
    {
        $search_term = $request->input('search');
        $data = DB::select('SELECT idkota_kabupaten as id, nama FROM m_kota_kabupaten WHERE status_aktif = 1 AND nama LIKE "%' . $search_term . '%"');
        $provinsi = [];
        foreach ($data as $key => $row) {
            $provinsi[] = array(
                'id' => $row->id,
                'text' => $row->nama
            );
        }

        echo json_encode(array(
            'search' => $search_term,
            'location' => $provinsi
        ));
    }
    public function simpan(Request $request)
    {
        $data = $request->all();
        if (isset($data['form']) && is_array($data['form'])) {
            $dataAssoc = [];
            foreach ($data['form'] as $item) {
                $dataAssoc[$item['name']] = $item['value'];
            }

            $nama = $dataAssoc['nama'] ?? null;
        } else {
            $nama = $data['nama'] ?? null;
        }
        $jenis_fasum = new Jenisfasum_model();
        $jenis_fasum->nama = $nama;
        $jenis_fasum->save();
        echo $nama;
        echo json_encode(array("status" => TRUE));
    }
    public function hapus(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $update = DB::table('m_kategori_fasum')
            ->where('idkategori_fasum', $id)
            ->update(['status_aktif' => 0]);
        echo json_encode(array("status" => TRUE));
    }
}
