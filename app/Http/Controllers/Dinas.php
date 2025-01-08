<?php

namespace App\Http\Controllers;

use App\Models\Dinas_model;
use App\Models\Kota_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $result = DB::table('m_dinas')
    ->join('m_kota_kabupaten', 'm_dinas.idkota_kabupaten', '=', 'm_kota_kabupaten.idkota_kabupaten')
    ->select('m_dinas.iddinas AS id', 'm_dinas.nama', 'm_dinas.alamat', 'm_dinas.status_aktif', 'm_kota_kabupaten.nama AS kota_nama', 'm_kota_kabupaten.idkota_kabupaten AS kota_id')
    ->where('m_dinas.iddinas', $id)
    ->get();
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
        $data = DB::table('m_dinas')
    ->join('m_kota_kabupaten', 'm_dinas.idkota_kabupaten', '=', 'm_kota_kabupaten.idkota_kabupaten')
    ->select('m_dinas.iddinas AS id', 'm_dinas.nama', 'm_dinas.alamat', 'm_dinas.status_aktif', 'm_kota_kabupaten.nama AS kota')
    ->where('m_dinas.status_aktif', 1)
    ->get();

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
$data = DB::table('m_kota_kabupaten')
    ->select('idkota_kabupaten as id', 'nama')
    ->where('status_aktif', 1)
    ->where('nama', 'LIKE', '%' . $search_term . '%')
    ->get();
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
