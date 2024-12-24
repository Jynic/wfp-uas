<?php

namespace App\Http\Controllers;

use App\Models\Fasum_model;
use App\Models\Jenisfasum_model;
use App\Models\Kota_model;
use App\Models\Pelaporan_model;
use App\Models\Staff_model;
use App\Models\User_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Pelaporan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pelaporan_v');
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
        SELECT 
        p.idpelaporan AS id,
        p.nomor,
        p.tgl_pelaporan,
        p.status_pelaporan,
        p.keterangan,
        p.status_aktif,
        s.nama AS nama_staff,
        s.idm_staff AS id_staff,
        u.nama AS nama_user,
        u.iduser AS id_user,
        f.nama AS nama_fasum,
        f.idfasum AS id_fasum,
        pd.status_perbaikkan AS status_perbaikkan,
        pd.foto_fasum AS foto_fasum,
        pd.keterangan AS keterangan_fasum,
        s1.idm_staff AS id_staff_detail,
        s1.nama as nama_staff_detail
        FROM 
            t_pelaporan p
        INNER JOIN 
            t_pelaporan_detail pd ON p.idpelaporan = pd.t_pelaporan_idpelaporan
        INNER JOIN 
            m_staff s ON p.idm_staff = s.idm_staff
        INNER JOIN 
            m_user u ON p.iduser = u.iduser
        INNER JOIN 
            m_fasum f ON pd.m_fasum_idfasum = f.idfasum
            INNER JOIN m_staff s1 ON pd.idstaff=s1.idm_staff
        WHERE 
            p.status_aktif = 1 and p.idpelaporan = :id;", ['id' => $id]);
        return json_encode($result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Proses data form
        $formData = $request->all();
        $tgl = date('Y-m-d H:i:s', strtotime($formData['tgl']));
        $id = $formData['id'];

        // Update data utama di tabel t_pelaporan
        $dataPelaporan = [
            'nomor' => $formData['nomor'],
            'tgl_pelaporan' => $tgl,
            'idm_staff' => $formData['pic_utama'],
            'iduser' => $formData['user'],
            'keterangan' => $formData['keterangan']
        ];

        DB::table('t_pelaporan')
            ->where('idpelaporan', $id) // Asumsi primary key bernama idpelaporan
            ->update($dataPelaporan);

        // Hapus detail yang ada sebelumnya
        DB::table('t_pelaporan_detail')
            ->where('t_pelaporan_idpelaporan', $id)
            ->delete();

        // Folder penyimpanan gambar
        $folder = public_path('img_pelaporan');

        // Buat folder jika belum ada
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        // Insert ulang detail baru
        foreach ($formData['fasum'] as $key => $value) {
            $gambarPath = '-';

            // Proses file gambar jika ada
            if (isset($request->file('gambarFasum')[$key])) {
                $gambar = $request->file('gambarFasum')[$key];

                // Validasi file gambar
                if ($gambar->isValid()) {
                    $filename = $id . '_detail_' . $key . '.' . $gambar->getClientOriginalExtension();

                    // Pindahkan file ke folder yang ditentukan
                    try {
                        $gambar->move($folder, $filename);
                        $gambarPath = 'img_pelaporan/' . $filename; // Path gambar yang akan disimpan
                    } catch (\Exception $e) {
                        return response()->json(['error' => 'Gagal menyimpan file gambar untuk detail ' . ($key + 1)], 500);
                    }
                } else {
                    return response()->json(['error' => 'File gambar tidak valid untuk detail ' . ($key + 1)], 400);
                }
            }

            // Simpan detail ke database
            $dataDetail = [
                't_pelaporan_idpelaporan' => $id,
                'm_fasum_idfasum' => $value,
                'status_perbaikkan' => $formData['status_perbaikkan'][$key] ?? 'Antri',
                'foto_fasum' => $gambarPath,
                'keterangan' => $formData['keterangan_detail'][$key],
                'idstaff' => $formData['pic_fasum'][$key]
            ];
            DB::table('t_pelaporan_detail')->insert($dataDetail);
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
        $data = DB::select("SELECT 
    p.idpelaporan AS id,
    p.nomor,
    p.tgl_pelaporan,
    p.status_pelaporan,
    p.keterangan,
    p.status_aktif,
    s.nama AS nama_staff,
    s.idm_staff AS id_staff,
    u.nama AS nama_user,
    u.iduser AS id_user,
    GROUP_CONCAT(f.nama SEPARATOR ', ') AS nama_fasum,
    GROUP_CONCAT(f.idfasum SEPARATOR ', ') AS id_fasum,
    GROUP_CONCAT(pd.status_perbaikkan SEPARATOR ', ') AS status_perbaikkan,
    GROUP_CONCAT(pd.foto_fasum SEPARATOR ', ') AS foto_fasum,
    GROUP_CONCAT(pd.keterangan SEPARATOR ', ') AS keterangan_fasum
    FROM 
        t_pelaporan p
    INNER JOIN 
        t_pelaporan_detail pd ON p.idpelaporan = pd.t_pelaporan_idpelaporan
    INNER JOIN 
        m_staff s ON p.idm_staff = s.idm_staff
    INNER JOIN 
        m_user u ON p.iduser = u.iduser
    INNER JOIN 
        m_fasum f ON pd.m_fasum_idfasum = f.idfasum
    WHERE 
        p.status_aktif = 1
    GROUP BY 
        p.idpelaporan, 
        p.nomor, 
        p.tgl_pelaporan, 
        p.status_pelaporan, 
        p.keterangan, 
        p.status_aktif, 
        s.nama, 
        s.idm_staff, 
        u.nama, 
        u.iduser;
        ");

        $pelaporan = [];
        foreach ($data as $key => $value) {
            $pelaporan[] = array(
                $value->nomor,
                $value->tgl_pelaporan,
                $value->status_pelaporan,
                $value->keterangan,
                $value->nama_user,
                $value->nama_fasum,
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
        echo json_encode($pelaporan);
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
    public function getDataStaff(Request $request)
    {
        $search_term = $request->input('search');
        $data = DB::select('select s.idm_staff as id, s.nama from m_staff s where s.status_aktif = 1 and s.nama like :search', ['search' => '%' . $search_term . '%']);
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
    public function getDataUser(Request $request)
    {
        $search_term = $request->input('search');
        $data = DB::select('select u.iduser as id, u.nama from m_user u where u.status_aktif = 1 and u.nama like :search', ['search' => '%' . $search_term . '%']);
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
    public function getDataFasum(Request $request)
    {
        $search_term = $request->input('search');
        $data = DB::select('select f.idfasum as id, f.nama from m_fasum f where f.status_aktif = 1 and f.nama like :search', ['search' => '%' . $search_term . '%']);
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
        $tgl = date('Y-m-d H:i:s', strtotime($formData['tgl']));
        $data = [
            'nomor' => $formData['nomor'],
            'tgl_pelaporan' => $tgl,
            'idm_staff' => $formData['pic_utama'],
            'iduser' => $formData['user'],
            'status_pelaporan' => 'Antri',
            'keterangan' => $formData['keterangan']
        ];
        $id = DB::table('t_pelaporan')->insertGetId($data);

        foreach ($formData['fasum'] as $key => $value) {
            $gambarPath = "";
            if (isset($request->file('gambarFasum')[$key])) {
                $gambar = $request->file('gambarFasum')[$key];

                // Validasi file gambar
                if (!$gambar->isValid()) {
                    return response()->json(['error' => 'File gambar tidak valid untuk detail ' . ($key + 1)], 400);
                }

                // Tentukan folder penyimpanan
                $folder = public_path('img_pelaporan');
                $filename = $id . '_detail_' . $key . '.' . $gambar->getClientOriginalExtension();

                // Buat direktori jika belum ada
                if (!file_exists($folder)) {
                    mkdir($folder, 0755, true);
                }

                // Pindahkan file ke folder yang ditentukan
                try {
                    $gambar->move($folder, $filename);
                } catch (\Exception $e) {
                    return response()->json(['error' => 'Gagal menyimpan file gambar untuk detail ' . ($key + 1)], 500);
                }

                // Path gambar yang akan disimpan
                $gambarPath = 'img_fasum/' . $filename;
            } else {
                // Jika tidak ada gambar untuk detail ini
                $gambarPath = '-';
            }
            $data = [
                't_pelaporan_idpelaporan' => $id,
                'm_fasum_idfasum' => $value,
                'status_perbaikkan' => 'Antri',
                'foto_fasum' => $gambarPath,
                'keterangan' => $formData['keterangan_detail'][$key],
                'idstaff' => $formData['pic_fasum'][$key]
            ];
            DB::table('t_pelaporan_detail')->insert($data);
        }

        return response()->json(['status' => true, 'message' => 'Data berhasil disimpan']);
    }

    public function hapus(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $update = DB::table('t_pelaporan')
            ->where('idpelaporan', $id)
            ->update(['status_aktif' => 0]);
        echo json_encode(array("status" => TRUE));
    }

    public function GetNomor()
    {
        $nomor = DB::select('SELECT count(idpelaporan) + 1 as nomor FROM t_pelaporan ORDER BY idpelaporan DESC');
        return intval($nomor[0]->nomor);
    }
}
