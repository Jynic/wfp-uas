<?php

namespace App\Http\Controllers;

use App\Models\Fasum_model;
use App\Models\Jenisfasum_model;
use App\Models\Kota_model;
use App\Models\Staff_model;
use App\Models\User_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user_v');
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
        SELECT u.iduser AS id,
        u.nama, u.username,
        u.alamat, 
        u.no_hp,
        u.email, 
        u.status_aktif,
        kk.idkota_kabupaten AS kota_id,
        kk.nama AS kota_nama,
        j.idjabatan AS jabatan_id,
        j.nama AS jabatan_nama
        FROM m_user u INNER JOIN m_kota_kabupaten kk ON u.idkota_kabupaten=kk.idkota_kabupaten
        INNER JOIN m_jabatan j ON u.idjabatan=j.idjabatan
        WHERE u.status_aktif = 1 and u.iduser = :id", ['id' => $id]);
        return json_encode($result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $formData = $request->all();
        $id = $formData['id'];
        $user = User_model::find($id);
        if (!$user) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        $user->nama = $formData['nama'] ?? $user->nama;
        $user->idkota_kabupaten = $formData['asal'] ?? $user->idkota_kabupaten;
        $user->idjabatan = $formData['jabatan'] ?? $user->idjabatan;
        $user->username = $formData['username'] ?? $user->username;
        $user->password = Hash::make($formData['password']) ?? $user->password;
        $user->alamat = $formData['alamat'] ?? $user->alamat;
        $user->no_hp = $formData['no_hp'] ?? $user->no_hp;
        $user->email = $formData['email'] ?? $user->email;
        $user->save();

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
        $data = DB::select("SELECT u.iduser AS id,
        u.nama, u.username,
        u.alamat, 
        u.no_hp,
        u.email, 
        u.status_aktif,
        kk.idkota_kabupaten AS kota_id,
        kk.nama AS kota_nama,
        j.idjabatan AS jabatan_id,
        j.nama AS jabatan_nama
        FROM m_user u INNER JOIN m_kota_kabupaten kk ON u.idkota_kabupaten=kk.idkota_kabupaten
        INNER JOIN m_jabatan j ON u.idjabatan=j.idjabatan
        WHERE u.status_aktif = 1
        ");

        $user = [];
        foreach ($data as $key => $value) {
            $user[] = array(
                $value->nama,
                $value->username,
                $value->kota_nama,
                $value->jabatan_nama,
                $value->alamat,
                $value->no_hp,
                $value->email,
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
        echo json_encode($user);
    }
    public function getKota(Request $request)
    {
        $search_term = $request->input('search');
        $data = DB::select('SELECT kk.idkota_kabupaten AS id,
        kk.nama
        FROM m_kota_kabupaten kk
        WHERE kk.status_aktif = 1 AND kk.nama LIKE :search', ['search' => '%' . $search_term . '%']);
        $kota = [];
        foreach ($data as $key => $row) {
            $kota[] = array(
                'id' => $row->id,
                'text' => $row->nama
            );
        }

        echo json_encode(array(
            'search' => $search_term,
            'location' => $kota
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
        $user = new User_model();
        $user->nama = $formData['nama'] ?? '';
        $user->idkota_kabupaten = $formData['asal'] ?? 1;
        $user->idjabatan = $formData['jabatan'] ?? 0;
        $user->username = $formData['username'] ?? '';
        $user->password = $password ?? '';
        $user->alamat = $formData['alamat'] ?? '';
        $user->no_hp = $formData['no_hp'] ?? '';
        $user->email = $formData['email'] ?? '';
        $user->status_aktif = 1;
        $user->save();
        return response()->json(['status' => true, 'message' => 'Data berhasil disimpan']);
    }





    public function hapus(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $update = DB::table('m_user')
            ->where('iduser', $id)
            ->update(['status_aktif' => 0]);
        echo json_encode(array("status" => TRUE));
    }
}
