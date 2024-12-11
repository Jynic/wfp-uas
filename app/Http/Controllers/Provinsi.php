<?php

namespace App\Http\Controllers;

use App\Models\Provinsi_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Provinsi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('provinsi_v');
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
        $data = $request->all();
        if (isset($data['form']) && is_array($data['form'])) {
            $dataAssoc = [];
            foreach ($data['form'] as $item) {
                $dataAssoc[$item['name']] = $item['value'];
            }

            $kode = $dataAssoc['kode'] ?? null;
            $nama = $dataAssoc['nama'] ?? null;
        } else {
            $kode = $data['kode'] ?? null;
            $nama = $data['nama'] ?? null;
        }
        echo $nama;
        // $citizen = new Citizen_model();
        // $citizen->citizen_id = $citizen_id;
        // $citizen->name = $name;
        // $citizen->address = $address;
        // $citizen->save();

        // echo json_encode(array("status" => TRUE));
    }

    /**
     * Display the specified resource.
     */
    public function show(Provinsi_model $provinsi_model)
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
        $provinsi = new Provinsi_model();
        $provinsi = $provinsi->find($id);
        echo json_encode($provinsi);
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
            $kode = $dataAssoc['kode'] ?? null;
            $nama = $dataAssoc['nama'] ?? null;
        } else {
            $id = $data['id'] ?? null;
            $kode = $data['kode'] ?? null;
            $nama = $data['nama'] ?? null;
        }
        $provinsi = Provinsi_model::where('idprovinsi', $id)->first();
        $provinsi->kode = $kode ?? $provinsi->kode;
        $provinsi->nama = $nama ?? $provinsi->nama;
        $provinsi->save();
        echo json_encode(array("status" => TRUE));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provinsi_model $provinsi_model)
    {
        //
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
        } else {
            $kode = $data['kode'] ?? null;
            $nama = $data['nama'] ?? null;
        }
        $provinsi = new Provinsi_model();
        $provinsi->kode = $kode;
        $provinsi->nama = $nama;
        $provinsi->save();
        echo json_encode(array("status" => TRUE));
    }
    public function getData(Request $request)
    {
        // Inisialisasi model Provinsi
        $provinsi = new Provinsi_model();

        $data = $provinsi->select('idprovinsi', 'kode', 'nama', 'status_aktif')
            ->where('status_aktif', 1) // Menambahkan filter status_aktif
            ->get();

        $provinsi = [];
        foreach ($data as $key => $value) {
            $provinsi[] = array(
                $value['kode'],
                $value['nama'],
                ($value['status_aktif'] == 1) ?
                    '<span class="badge bg-success">Active</span>' :
                    '<span class="badge bg-danger">Inactive</span>',
                '<div class="d-flex justify-content-center">
                <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="edit(' . $value['idprovinsi'] . ')">
                    <i class="bx bx-edit-alt"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="hapus(' . $value['idprovinsi'] . ')">
                    <i class="bx bx-trash"></i>
                </a>
            </div>'
            );
        }

        // Kirim data dalam format JSON
        echo json_encode($provinsi);
    }

    public function hapus(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $update = DB::table('m_provinsi')
            ->where('idprovinsi', $id)
            ->update(['status_aktif' => 0]);
        echo json_encode(array("status" => TRUE));
    }
}
