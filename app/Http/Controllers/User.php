<?php

namespace App\Http\Controllers;

use App\Models\Fasum_model;
use App\Models\Jenisfasum_model;
use App\Models\Kota_model;
use App\Models\Staff_model;
use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        FROM m_user u LEFT JOIN m_kota_kabupaten kk ON u.idkota_kabupaten=kk.idkota_kabupaten
        LEFT JOIN m_jabatan j ON u.idjabatan=j.idjabatan
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
        $user = ModelsUser::find($id);
        if (!$user) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        $user->nama = $formData['nama'] ?? $user->nama;
        $user->idkota_kabupaten = $formData['asal'] ?? $user->idkota_kabupaten;
        $user->idjabatan = $formData['jabatan'] ?? $user->idjabatan;
        $user->username = $formData['username'] ?? $user->username;
        $user->alamat = $formData['alamat'] ?? $user->alamat;
        $user->no_hp = $formData['no_hp'] ?? $user->no_hp;
        $user->email = $formData['email'] ?? $user->email;
        $user->save();

        if ($formData['jabatan'] != 2) {
            $idstaff = $user->idstaff;

            $staff = Staff_model::find($idstaff);
            if (!$staff) {
                $staff = new Staff_model();
                $insert_id = true;
            }

            $staff->idjabatan = $formData['jabatan'] ?? $staff->idjabatan;
            $staff->nama = $formData['nama'] ?? $staff->nama;
            $staff->username = $formData['username'] ?? $staff->username;
            $staff->alamat = $formData['alamat'] ?? '';
            $staff->email = $formData['email'] ?? '';
            $staff->save();

            if ($insert_id) {
                $user = ModelsUser::find($id);
                $user->idstaff = $staff->idm_staff;
                $user->save();
            }
        }

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
        $data = DB::select("
            SELECT 
                u.iduser AS id,
                COALESCE(u.nama, '') AS nama, 
                COALESCE(u.username, '') AS username,
                COALESCE(kk.nama, '-') AS kota_nama,
                COALESCE(j.nama, '') AS jabatan_nama,
                COALESCE(u.alamat, '-') AS alamat,
                COALESCE(u.no_hp, '-') AS no_hp,
                COALESCE(u.email, '-') AS email, 
                COALESCE(u.status_aktif, 1) AS status_aktif,
                COALESCE(kk.idkota_kabupaten, 0) AS kota_id
            FROM m_user u 
            LEFT JOIN m_kota_kabupaten kk ON u.idkota_kabupaten = kk.idkota_kabupaten
            LEFT JOIN m_jabatan j ON u.idjabatan = j.idjabatan
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

    public function getUserSeringMengadu()
    {
        $data = DB::select("
        SELECT 
            u.iduser AS id,
            u.nama, 
            u.username,
            u.alamat, 
            u.no_hp,
            u.email, 
            u.status_aktif,
            kk.idkota_kabupaten AS kota_id,
            kk.nama AS kota_nama,
            j.idjabatan AS jabatan_id,
            j.nama AS jabatan_nama,
            COUNT(p.idpelaporan) AS pelaporan_count
        FROM 
            m_user u 
        LEFT JOIN 
            m_kota_kabupaten kk ON u.idkota_kabupaten = kk.idkota_kabupaten
        LEFT JOIN 
            m_jabatan j ON u.idjabatan = j.idjabatan
        LEFT JOIN 
            t_pelaporan p ON u.iduser = p.iduser AND p.status_aktif = 1
        WHERE 
            u.status_aktif = 1
        GROUP BY 
            u.iduser, u.nama, u.username, u.alamat, u.no_hp, u.email, u.status_aktif, kk.idkota_kabupaten, kk.nama, j.idjabatan, j.nama
        ORDER BY 
            pelaporan_count DESC
        LIMIT 5
    ");

        $user = [];
        $rank = 1;

        foreach ($data as $key => $value) {
            $user[] = array(
                'rank' => $rank++,
                'name' => $value->nama,
                'username' => $value->username,
                'city' => $value->kota_nama,
                'position' => $value->jabatan_nama,
                'address' => $value->alamat,
                'phone' => $value->no_hp,
                'email' => $value->email,
                'status' => ($value->status_aktif == 1) ?
                    '<span class="badge bg-success">Active</span>' :
                    '<span class="badge bg-danger">Inactive</span>',
                'report_count' => $value->pelaporan_count,
            );
        }
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

        $user_idjabatan = auth()->user()->idjabatan;

        $query = DB::table('m_jabatan AS j')
            ->where('j.status_aktif', 1)
            ->where('j.nama', 'LIKE', '%' . $search_term . '%');

        if ($user_idjabatan != 1) {
            $query->whereNotIn('j.idjabatan', [1, 4]);
        }

        $data = $query->get();

        $dinas = [];
        foreach ($data as $row) {
            $dinas[] = array(
                'id' => $row->idjabatan,
                'text' => $row->nama
            );
        }

        return response()->json([
            'search' => $search_term,
            'location' => $dinas
        ]);
    }

    public function simpan(Request $request)
    {
        $formData = $request->all();
        $password = Hash::make($formData['password']);

        $user = new ModelsUser();
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

        if ($formData['jabatan'] != 2) {
            $idstaff = $user->idstaff;

            $staff = Staff_model::find($idstaff);
            if (!$staff) {
                $staff = new Staff_model();
                $insert_id = true;
            }

            $staff->idjabatan = $formData['jabatan'] ?? $staff->idjabatan;
            $staff->nama = $formData['nama'] ?? $staff->nama;
            $staff->username = $formData['username'] ?? $staff->username;
            $staff->alamat = $formData['alamat'] ?? '';
            $staff->email = $formData['email'] ?? '';
            $staff->save();

            if ($insert_id) {
                $user = ModelsUser::find($user->iduser);
                $user->idstaff = $staff->idm_staff;
                $user->save();
            }
        }

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
