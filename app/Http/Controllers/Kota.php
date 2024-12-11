<?php

namespace App\Http\Controllers;

use App\Models\Kota_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Kota extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kota_v');
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
        SELECT k.idkota_kabupaten, k.kode, k.nama, k.jenis, k.status_aktif, 
               p.idprovinsi AS provinsi_id, p.nama AS provinsi_nama
        FROM m_kota_kabupaten AS k
        INNER JOIN m_provinsi AS p ON k.m_provinsi_idprovinsi = p.idprovinsi
        WHERE k.idkota_kabupaten = :id", ['id' => $id]);

        // Mengembalikan data dalam format JSON
        return json_encode($result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kota_model $kota_model)
    {
        $data = $request->all();
        if (isset($data['form']) && is_array($data['form'])) {
            $dataAssoc = [];
            foreach ($data['form'] as $item) {
                $dataAssoc[$item['name']] = $item['value'];
            }
            $id = $dataAssoc['id'] ?? null;
            $kode = $dataAssoc['kode'] ?? null;
            $nama = $dataAssoc['nama'] ?? null;
            $provinsi = $dataAssoc['provinsi'] ?? null;
            $jenis = $dataAssoc['jenis_kota_kabupaten'] ?? null;
        } else {
            $id = $data['id'] ?? null;
            $kode = $data['kode'] ?? null;
            $nama = $data['nama'] ?? null;
            $provinsi = $data['provinsi'] ?? null;
            $jenis = $data['jenis_kota_kabupaten'] ?? null;
        }
        $kota = Kota_model::where('idkota_kabupaten', $id)->first();
        $kota->kode = $kode ?? $kota->kode;
        $kota->nama = $nama ?? $kota->nama;
        $kota->m_provinsi_idprovinsi = $provinsi ?? $kota->m_provinsi_idprovinsi;
        $kota->jenis = $jenis ?? $kota->jenis;
        $kota->save();
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
        $data = DB::select('SELECT kk.idkota_kabupaten AS id, kk.kode, kk.nama, kk.jenis, kk.status_aktif, p.nama AS provinsi
        FROM m_kota_kabupaten kk INNER JOIN m_provinsi p ON kk.m_provinsi_idprovinsi=p.idprovinsi
        WHERE kk.status_aktif = 1');

        $kota = [];
        foreach ($data as $key => $value) {
            $kota[] = array(
                $value->jenis . ' - ' . $value->nama,
                $value->provinsi,
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
        echo json_encode($kota);
    }
    public function getDataProvinsi(Request $request)
    {
        $search_term = $request->input('search');
        $data = DB::select('SELECT idprovinsi as id, nama FROM m_provinsi WHERE status_aktif = 1 AND nama LIKE "%' . $search_term . '%"');
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

            $kode = $dataAssoc['kode'] ?? null;
            $nama = $dataAssoc['nama'] ?? null;
            $provinsi = $dataAssoc['provinsi'] ?? null;
            $jenis = $dataAssoc['jenis_kota_kabupaten'] ?? null;
        } else {
            $kode = $data['kode'] ?? null;
            $nama = $data['nama'] ?? null;
            $provinsi = $data['provinsi'] ?? null;
            $jenis = $data['jenis_kota_kabupaten'] ?? null;
        }
        $kota = new Kota_model();
        $kota->kode = $kode;
        $kota->nama = $nama;
        $kota->jenis = $jenis;
        $kota->m_provinsi_idprovinsi = $provinsi;
        $kota->save();
        echo json_encode(array("status" => TRUE));
    }
    public function hapus(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $update = DB::table('m_kota_kabupaten')
            ->where('idkota_kabupaten', $id)
            ->update(['status_aktif' => 0]);
        echo json_encode(array("status" => TRUE));
    }
}
