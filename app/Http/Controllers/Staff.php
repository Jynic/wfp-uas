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
        $idjabatan = Auth::user()->idjabatan;
        $data = DB::select('select ha.idjabatan, ha2.kode_fitur, ha2.nama_fitur from a_hak_akses_jabatan ha inner join a_hak_akses ha2 on ha.idhak_akses=ha2.idhak_akses where idjabatan = :idjabat', ['idjabat' => $idjabatan]);
        foreach ($data as $key => $row) {
            if ($row->nama_fitur == "master_staff") {
                return view('staff_v');
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
        SELECT s.idm_staff AS id, s.nama, s.username, s.status_aktif, d.nama AS dinas_nama, d.iddinas AS dinas_id, j.nama AS jabatan_nama, j.idjabatan AS jabatan_id
        FROM m_staff s
        INNER JOIN m_dinas d ON s.iddinas=d.iddinas
        INNER JOIN m_jabatan j ON s.idjabatan=j.idjabatan
        WHERE s.status_aktif = 1 and s.idm_staff = :id", ['id' => $id]);
        return json_encode($result);
    }

    /**
     * Update the specified resource in storage.
     */
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
        $staff->password = Hash::make($formData['password']) ?? $staff->password;
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
        $data = DB::select("SELECT s.idm_staff AS id, s.nama, s.username, s.status_aktif, d.nama AS dinas_nama, d.iddinas AS dinas_id, j.nama AS jabatan_nama, j.idjabatan AS jabatan_id
        FROM m_staff s
        INNER JOIN m_dinas d ON s.iddinas=d.iddinas
        INNER JOIN m_jabatan j ON s.idjabatan=j.idjabatan
        WHERE s.status_aktif = 1
        ");

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
        $data = DB::select('SELECT kf.idkategori_fasum AS id, kf.nama, kf.status_aktif
        FROM m_kategori_fasum kf
        WHERE kf.status_aktif = 1 AND kf.nama LIKE :search', ['search' => '%' . $search_term . '%']);
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
        $data = DB::select('SELECT d.iddinas AS id, d.nama
        FROM m_dinas d 
        WHERE d.status_aktif = 1 AND d.nama LIKE :search', ['search' => '%' . $search_term . '%']);
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
        $data = DB::select('SELECT j.idjabatan AS id,
        j.nama
        FROM m_jabatan j
        WHERE j.status_aktif = 1 AND j.nama LIKE :search', ['search' => '%' . $search_term . '%']);
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
    public function simpan(Request $request)
    {
        // Proses data form
        $formData = $request->all();
        $password = Hash::make($formData['password']);
        $staff = new Staff_model();
        $staff->nama = $formData['nama'] ?? '';
        $staff->iddinas = $formData['dinas'] ?? 1;
        $staff->idjabatan = $formData['jabatan'] ?? 0;
        $staff->username = $formData['username'] ?? '';
        $staff->password = $password ?? '';
        $staff->save();
        return response()->json(['status' => true, 'message' => 'Data berhasil disimpan']);
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
