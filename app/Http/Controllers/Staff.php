<?php

namespace App\Http\Controllers;

use App\Models\Fasum_model;
use App\Models\Jenisfasum_model;
use App\Models\Kota_model;
use App\Models\Staff_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Staff extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('staff_v');
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

        $result = DB::table('m_staff as s')
            ->select('s.idm_staff as id', 's.nama', 's.username', 's.status_aktif', 'd.nama as dinas_nama', 'd.iddinas as dinas_id', 'j.nama as jabatan_nama', 'j.idjabatan as jabatan_id')
            ->leftJoin('m_dinas as d', 's.iddinas', '=', 'd.iddinas')
            ->leftJoin('m_jabatan as j', 's.idjabatan', '=', 'j.idjabatan')
            ->where('s.status_aktif', 1)
            ->where('s.idm_staff', $id)
            ->get();


        return json_encode($result);
    }


    public function update(Request $request)
    {
        $formData = $request->all();
        $id = $formData['id'];
        // Ambil data staff berdasarkan ID
        $staff = Staff_model::find($id);
        if (!$staff) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        $staff->nama = $formData['nama'] ?? $staff->nama;
        $staff->iddinas = $formData['dinas'] ?? $staff->iddinas;
        $staff->idjabatan = $formData['jabatan'] ?? $staff->idjabatan;
        $staff->username = $formData['username'] ?? $staff->username;
        $staff->save();

        // Berikan respons sukses
        return response()->json(['status' => true, 'message' => 'Data berhasil diperbarui']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kota_model $kota_model)
    {
        //
    }
    public function getData()
    {
        $data = DB::table('m_staff as s')
            ->select('s.idm_staff as id', 's.nama', 's.username', 's.status_aktif', 'd.nama as dinas_nama', 'd.iddinas as dinas_id', 'j.nama as jabatan_nama', 'j.idjabatan as jabatan_id')
            ->leftJoin('m_dinas as d', 's.iddinas', '=', 'd.iddinas')
            ->leftJoin('m_jabatan as j', 's.idjabatan', '=', 'j.idjabatan')
            ->where('s.status_aktif', 1)
            ->get();

        $staff = [];
        foreach ($data as $key => $value) {
            $staff[] = array(
                $value->nama,
                $value->dinas_nama,
                $value->jabatan_nama,
                $value->username,
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
        echo json_encode($staff);
    }
    public function getDataKategori(Request $request)
    {
        $search_term = $request->input('search');
        $data = DB::table('m_kategori_fasum')
            ->select('idkategori_fasum AS id', 'nama', 'status_aktif')
            ->where('status_aktif', 1)
            ->where('nama', 'LIKE', '%' . $search_term . '%')
            ->get();
        $kategori = [];
        foreach ($data as $key => $row) {
            $kategori[] = array(
                'id' => $row->id,
                'text' => $row->nama
            );
        }

        echo json_encode(array(
            'search' => $search_term,
            'location' => $kategori
        ));
    }
    public function getDataDinas(Request $request)
    {
        $search_term = $request->input('search');
        $user = auth()->user();

        $query = DB::table('m_dinas')
            ->select('iddinas AS id', 'nama')
            ->where('status_aktif', 1)
            ->where('nama', 'LIKE', '%' . $search_term . '%');

        if (in_array($user->idjabatan, [3, 4])) {
            $query->where('iddinas', $user->staff->iddinas ?? 0);
        }

        $data = $query->get();

        $dinas = [];
        foreach ($data as $key => $row) {
            $dinas[] = array(
                'id' => $row->id,
                'text' => $row->nama
            );
        }

        echo json_encode(array(
            'search' => $search_term,
            'location' => $dinas
        ));
    }

    public function getDataJabatan(Request $request)
    {
        $search_term = $request->input('search');
        $data = DB::table('m_jabatan')
            ->select('idjabatan AS id', 'nama')
            ->where('status_aktif', 1)
            ->where('nama', 'LIKE', '%' . $search_term . '%')
            ->get();
        $dinas = [];
        foreach ($data as $key => $row) {
            $dinas[] = array(
                'id' => $row->id,
                'text' => $row->nama
            );
        }

        echo json_encode(array(
            'search' => $search_term,
            'location' => $dinas
        ));
    }

    public function hapus(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $update = DB::table('m_staff')
            ->where('idm_staff', $id)
            ->update(['status_aktif' => 0]);
        echo json_encode(array("status" => TRUE));
    }
}
