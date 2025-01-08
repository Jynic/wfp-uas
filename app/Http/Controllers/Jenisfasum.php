<?php

namespace App\Http\Controllers;

use App\Models\Jenisfasum_model;
use App\Models\Kota_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class Jenisfasum extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jenis_fasum_v');
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

      $result = DB::table('m_kategori_fasum')
    ->select('idkategori_fasum as id', 'nama', 'status_aktif')
    ->where('idkategori_fasum', $id)
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
       $data = DB::table('m_kategori_fasum')
    ->select('idkategori_fasum as id', 'nama', 'status_aktif')
    ->where('status_aktif', 1)
    ->get();

        $jenis_fasum = [];
        foreach ($data as $key => $value) {
            $action_buttons = '
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="edit(' . $value->id . ')">
                        <i class="bx bx-edit-alt"></i>
                    </a>';

            if (Gate::allows('accessManajerPages')) {
                $action_buttons .= '
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm ms-3" onclick="hapus(' . $value->id . ')">
                        <i class="bx bx-trash"></i>
                    </a>';
            }

            $action_buttons .= '</div>';

            $jenis_fasum[] = array(
                $value->nama,
                ($value->status_aktif == 1) ?
                    '<span class="badge bg-success">Active</span>' :
                    '<span class="badge bg-danger">Inactive</span>',
                $action_buttons
            );
        }
        echo json_encode($jenis_fasum);
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
