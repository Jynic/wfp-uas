<?php

namespace App\Http\Controllers;

use App\Models\Dinas_model;
use App\Models\Kota_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dinas extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dinas_v');
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
        SELECT d.iddinas AS id, 
        d.nama, 
        d.alamat, 
        d.status_aktif, 
        kk.nama AS kota_nama, 
        kk.idkota_kabupaten AS kota_id
        FROM m_dinas d
        INNER JOIN m_kota_kabupaten kk ON d.idkota_kabupaten=kk.idkota_kabupaten
        WHERE d.iddinas = :id", ['id' => $id]);
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
            $kota = $dataAssoc['kota_kabupaten'] ?? null;
            $alamat = $dataAssoc['alamat'] ?? null;
        } else {
            $id = $data['id'] ?? null;
            $nama = $data['nama'] ?? null;
            $kota = $data['kota_kabupaten'] ?? null;
            $alamat = $data['alamat'] ?? null;
        }
        $dinas = Dinas_model::where('iddinas', $id)->first();
        $dinas->nama = $nama ?? $dinas->nama;
        $dinas->idkota_kabupaten = $kota ?? $dinas->idkota_kabupaten;
        $dinas->alamat = $alamat ?? $dinas->alamat;
        $dinas->save();
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
        $data = DB::select('SELECT d.iddinas AS id, d.nama, d.alamat, d.status_aktif, kk.nama AS kota
        FROM m_dinas d 
        INNER JOIN m_kota_kabupaten kk ON d.idkota_kabupaten=kk.idkota_kabupaten
        WHERE d.status_aktif = 1');

        $dinas = [];
        foreach ($data as $key => $value) {
            $dinas[] = array(
                $value->nama,
                $value->kota,
                $value->alamat,
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
        echo json_encode($dinas);
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
            $kota = $dataAssoc['kota_kabupaten'] ?? null;
            $alamat = $dataAssoc['alamat'] ?? null;
        } else {
            $nama = $data['nama'] ?? null;
            $kota = $data['kota_kabupaten'] ?? null;
            $alamat = $data['alamat'] ?? null;
        }
        $dinas = new Dinas_model();
        $dinas->nama = $nama;
        $dinas->idkota_kabupaten = $kota;
        $dinas->alamat = $alamat;
        $dinas->save();
        echo json_encode(array("status" => TRUE));
    }
    public function hapus(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $update = DB::table('m_dinas')
            ->where('iddinas', $id)
            ->update(['status_aktif' => 0]);
        echo json_encode(array("status" => TRUE));
    }
}