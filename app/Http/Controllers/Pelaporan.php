<?php

namespace App\Http\Controllers;

use App\Models\Fasum_model;
use App\Models\Historypelaporan_model;
use App\Models\Jenisfasum_model;
use App\Models\Kota_model;
use App\Models\Pelaporan_model;
use App\Models\Staff_model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Pelaporan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pelaporan_v');
    }

    public function indexUser()
    {
        return view('pelaporanku');
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
        u.nama AS nama_user,
        u.iduser AS id_user,
        f.nama AS nama_fasum,
        f.idfasum AS id_fasum,
        pd.foto_fasum AS foto_fasum,
        pd.keterangan AS keterangan_fasum
        FROM 
            t_pelaporan p
        INNER JOIN 
            t_pelaporan_detail pd ON p.idpelaporan = pd.t_pelaporan_idpelaporan
        INNER JOIN 
            m_user u ON p.iduser = u.iduser
        INNER JOIN 
            m_fasum f ON pd.m_fasum_idfasum = f.idfasum
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
            // 'idm_staff' => $formData['pic_utama'],
            'iduser' => $formData['user'],
            'keterangan' => $formData['keterangan'] ?? '-'
        ];

        DB::table('t_pelaporan')
            ->where('idpelaporan', $id) // Asumsi primary key bernama idpelaporan
            ->update($dataPelaporan);

        $dataold = DB::table('t_pelaporan_detail')->where('t_pelaporan_idpelaporan', $id)->get()[0];
        $gambarPath = $dataold->foto_fasum;

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
        $dataDetail = [];

        // Insert ulang detail baru
        foreach ($formData['fasum'] as $key => $value) {
            $gambarPath = "-";

            if (isset($request->file('gambarFasum')[$key])) {
                $gambar = $request->file('gambarFasum')[$key];

                if (!$gambar->isValid()) {
                    return response()->json(['error' => 'File gambar tidak valid untuk detail ' . ($key + 1)], 400);
                }

                $folder = 'public/img_pelaporan';
                $filename = $id . '_detail_' . $key . '.' . $gambar->getClientOriginalExtension();

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder);
                }

                try {
                    $path = $gambar->storeAs($folder, $filename);
                    $gambarPath = "storage/img_pelaporan/" . $filename;
                } catch (\Exception $e) {
                    return response()->json(['error' => 'Gagal menyimpan file gambar untuk detail ' . ($key + 1)], 500);
                }
            } else {
                $dataDetail = [
                    't_pelaporan_idpelaporan' => $id,
                    'm_fasum_idfasum' => $value,
                    'foto_fasum' => $gambarPath,
                    'keterangan' => $formData['keterangan_detail'][$key] ?? '-',
                    // 'idstaff' => $formData['pic_fasum'][$key]
                ];
            }
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
    public function getData(Request $request)
    {
        $id = $request->input('id');
        $data = DB::select("SELECT 
    p.idm_staff,
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
    GROUP_CONCAT(pd.foto_fasum SEPARATOR ', ') AS foto_fasum,
    GROUP_CONCAT(pd.keterangan SEPARATOR ', ') AS keterangan_fasum
    FROM 
        t_pelaporan p
    LEFT JOIN 
        t_pelaporan_detail pd ON p.idpelaporan = pd.t_pelaporan_idpelaporan
    LEFT JOIN 
        m_staff s ON p.idm_staff = s.idm_staff
    LEFT JOIN 
        m_user u ON p.iduser = u.iduser
    LEFT JOIN 
        m_fasum f ON pd.m_fasum_idfasum = f.idfasum
    WHERE 
        p.status_aktif = 1
    GROUP BY 
    p.idm_staff,
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
            $action_buttons = '
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="detail(' . $value->id . ')">
                        <i class="bx bx-info-circle"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm ms-3" onclick="edit(' . $value->id . ')">
                        <i class="bx bx-edit-alt"></i>
                    </a>';

            if (Gate::allows('accessManajerPages')) {
                $action_buttons .= '
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm ms-3" onclick="hapus(' . $value->id . ')">
                        <i class="bx bx-trash"></i>
                    </a>';
            }

            $action_buttons .= '</div>';

            $staff = Staff_model::all();

            $pelaporan[] = array(
                (auth()->user()->can('accessManajerPages') ?
                    '<select class="form-select form-select-sm" onchange="assignStaff(' . $value->id . ', this.value)">
            <option value="">Select Staff</option>' .
                    implode('', $staff->map(function ($staffMember) use ($value) {
                        return '<option value="' . $staffMember->idm_staff . '" ' .
                            ($staffMember->idm_staff == $value->id_staff ? 'selected' : '') . '>' .
                            $staffMember->username . '</option>';
                    })->toArray()) .
                    '</select>' :
                    $value->nama_staff),
                $value->nomor,
                $value->tgl_pelaporan,
                $value->status_pelaporan == 'Antri' ?
                    $value->status_pelaporan :
                    '<select class="form-select form-select-sm" onchange="updateStatus(' . $value->id . ', this.value)">
            <option value="Dikerjakan" ' . ($value->status_pelaporan == 'Dikerjakan' ? 'selected' : '') . '>Dikerjakan</option>
            <option value="Outsource" ' . ($value->status_pelaporan == 'Outsource' ? 'selected' : '') . '>Outsource</option>
            <option value="Selesai" ' . ($value->status_pelaporan == 'Selesai' ? 'selected' : '') . '>Selesai</option>
            <option value="Tidak Terselesaikan" ' . ($value->status_pelaporan == 'Tidak Terselesaikan' ? 'selected' : '') . '>Tidak Terselesaikan</option>
        </select>',
                $value->keterangan,
                $value->nama_user,
                $value->nama_fasum,
                ($value->status_aktif == 1) ?
                    '<span class="badge bg-success">Active</span>' :
                    '<span class="badge bg-danger">Inactive</span>',
                $action_buttons
            );
        }
        echo json_encode($pelaporan);
    }

    public function getDataForUser(Request $request)
    {
        $userId = auth()->user()->iduser;

        $data = DB::table('t_pelaporan')
            ->select('idpelaporan AS id', 'nomor', 'tgl_pelaporan', 'status_pelaporan', 'iduser', 'keterangan')
            ->where('iduser', $userId)
            ->get();

        $pelaporan = [];
        foreach ($data as $value) {
            $action_buttons = '
                <div class="d-flex justify-content-center">
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="detail(' . $value->id . ')">
                        <i class="bx bx-info-circle"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm ms-3" onclick="edit(' . $value->id . ')">
                        <i class="bx bx-edit-alt"></i>
                    </a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm ms-3" onclick="hapus(' . $value->id . ')">
                        <i class="bx bx-trash"></i>
                    </a>
                </div>';

            $pelaporan[] = array(
                $value->nomor,
                $value->tgl_pelaporan,
                $value->status_pelaporan,
                $value->keterangan,
                $action_buttons
            );
        }

        echo json_encode($pelaporan);
    }




    public function getPelaporanBelumSelesai(Request $request)
    {
        $id = $request->input('id');
        $dateFilter = $request->input('date_filter');

        $query = DB::table('t_pelaporan as p')
            ->leftJoin('t_pelaporan_detail as pd', 'p.idpelaporan', '=', 'pd.t_pelaporan_idpelaporan')
            ->leftJoin('m_staff as s', 'p.idm_staff', '=', 's.idm_staff')
            ->leftJoin('m_user as u', 'p.iduser', '=', 'u.iduser')
            ->leftJoin('m_fasum as f', 'pd.m_fasum_idfasum', '=', 'f.idfasum')
            ->where('p.status_aktif', 1)
            ->where('p.status_pelaporan', '!=', 'Selesai')
            ->groupBy(
                'p.idpelaporan',
                'p.nomor',
                'p.tgl_pelaporan',
                'p.status_pelaporan',
                'p.keterangan',
                'p.status_aktif',
                's.nama',
                's.idm_staff',
                'u.nama',
                'u.iduser'
            );

        if ($dateFilter) {
            $dateRange = Carbon::now()->subDays((int)$dateFilter);
            $query->where('p.tgl_pelaporan', '>=', $dateRange);
        }

        $data = $query->select(
            'p.idpelaporan as id',
            'p.nomor',
            'p.tgl_pelaporan',
            'p.status_pelaporan',
            'p.keterangan',
            'p.status_aktif',
            's.nama as nama_staff',
            's.idm_staff as id_staff',
            'u.nama as nama_user',
            'u.iduser as id_user',
            DB::raw('GROUP_CONCAT(f.nama SEPARATOR ", ") AS nama_fasum'),
            DB::raw('GROUP_CONCAT(f.idfasum SEPARATOR ", ") AS id_fasum'),
            DB::raw('GROUP_CONCAT(pd.foto_fasum SEPARATOR ", ") AS foto_fasum'),
            DB::raw('GROUP_CONCAT(pd.keterangan SEPARATOR ", ") AS keterangan_fasum')
        )->get();

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
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="detail(' . $value->id . ')">
                        <i class="bx bx-info-circle"></i>
                    </a>
                </div>'
            );
        }

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

    public function getDataFasumForUser(Request $request)
    {
        $search_term = $request->input('search');
        $user_kota_id = auth()->user()->idkota_kabupaten;

        $data = DB::select(
            '
        SELECT f.idfasum as id, f.nama 
        FROM m_fasum f
        JOIN m_dinas d ON f.m_dinas_iddinas = d.iddinas
        WHERE f.status_aktif = 1
        AND d.idkota_kabupaten = :user_kota_id
        AND f.nama LIKE :search',
            [
                'user_kota_id' => $user_kota_id,
                'search' => '%' . $search_term . '%'
            ]
        );

        $dinas = [];
        foreach ($data as $row) {
            $dinas[] = array(
                'id' => $row->id,
                'text' => $row->nama
            );
        }

        // Return the response as JSON
        return response()->json([
            'search' => $search_term,
            'location' => $dinas
        ]);
    }


    public function simpan(Request $request)
    {
        // Proses data form
        $formData = $request->all();
        $tgl = date('Y-m-d H:i:s', strtotime($formData['tgl']));
        $data = [
            'nomor' => $formData['nomor'],
            'tgl_pelaporan' => $tgl,
            // 'idm_staff' => $formData['pic_utama'],
            'iduser' => $formData['user'],
            // 'iduser' => $formData['user'],
            'status_pelaporan' => 'Antri',
            'keterangan' => $formData['keterangan'] ?? '-'
        ];
        $id = DB::table('t_pelaporan')->insertGetId($data);

        foreach ($formData['fasum'] as $key => $value) {
            $gambarPath = "-";

            if (isset($request->file('gambarFasum')[$key])) {
                $gambar = $request->file('gambarFasum')[$key];

                if (!$gambar->isValid()) {
                    return response()->json(['error' => 'File gambar tidak valid untuk detail ' . ($key + 1)], 400);
                }

                $folder = 'public/img_pelaporan';
                $filename = $id . '_detail_' . $key . '.' . $gambar->getClientOriginalExtension();

                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder);
                }

                try {
                    $path = $gambar->storeAs($folder, $filename);
                    $gambarPath = "storage/img_pelaporan/" . $filename;
                } catch (\Exception $e) {
                    return response()->json(['error' => 'Gagal menyimpan file gambar untuk detail ' . ($key + 1)], 500);
                }
            }
            $data = [
                't_pelaporan_idpelaporan' => $id,
                'm_fasum_idfasum' => $value,
                'foto_fasum' => $gambarPath,
                'keterangan' => $formData['keterangan_detail'][$key] ?? '-',
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
        $nomor = DB::select('SELECT count(idpelaporan) + 1 as nomor FROM t_pelaporan');
        return intval($nomor[0]->nomor);
    }
    public function detail(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $data = DB::select("
        SELECT 
        p.idpelaporan AS id,
        p.nomor,
        p.tgl_pelaporan,
        p.status_pelaporan,
        p.keterangan,
        p.status_aktif,
        u.nama AS nama_user,
        u.iduser AS id_user,
        f.nama AS nama_fasum,
        f.idfasum AS id_fasum,
        pd.foto_fasum AS foto_fasum,
        pd.keterangan AS keterangan_fasum
        FROM 
            t_pelaporan p
        LEFT JOIN 
            t_pelaporan_detail pd ON p.idpelaporan = pd.t_pelaporan_idpelaporan
        LEFT JOIN 
            m_user u ON p.iduser = u.iduser
        LEFT JOIN 
            m_fasum f ON pd.m_fasum_idfasum = f.idfasum
        WHERE 
            p.status_aktif = 1 and p.idpelaporan = :id;", ['id' => $id]);

        $pelaporan = [];
        foreach ($data as $key => $value) {
            $pelaporan[] = array(
                $value->nama_fasum,
                '<img src="' . asset($value->foto_fasum) . '" alt="Gambar Fasum" style="max-width: 100px; max-height: 100px;">',
                $value->keterangan_fasum,
            );
        }
        echo json_encode($pelaporan);
    }

    public function detailBelumSelesai(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $data = DB::select("
        SELECT 
        p.idpelaporan AS id,
        p.nomor,
        p.tgl_pelaporan,
        p.status_pelaporan,
        p.keterangan,
        p.status_aktif,
        u.nama AS nama_user,
        u.iduser AS id_user,
        f.nama AS nama_fasum,
        f.idfasum AS id_fasum,
        pd.foto_fasum AS foto_fasum,
        pd.keterangan AS keterangan_fasum
        FROM 
            t_pelaporan p
        INNER JOIN 
            t_pelaporan_detail pd ON p.idpelaporan = pd.t_pelaporan_idpelaporan
        INNER JOIN 
            m_user u ON p.iduser = u.iduser
        INNER JOIN 
            m_fasum f ON pd.m_fasum_idfasum = f.idfasum
        WHERE 
            p.status_aktif = 1 and p.idpelaporan = :id;", ['id' => $id]);

        $pelaporan = [];
        foreach ($data as $key => $value) {
            $pelaporan[] = array(
                $value->nama_fasum,
                '<img src="' . asset($value->foto_fasum) . '" alt="Gambar Fasum" style="max-width: 100px; max-height: 100px;">',
                $value->keterangan_fasum,
            );
        }
        echo json_encode($pelaporan);
    }

    public static function assignStaff($report_id, $staff_id)
    {
        $report = Pelaporan_model::find($report_id);
        $report->idm_staff = $staff_id;
        if ($report->status_pelaporan == "Antri") {
            $report->status_pelaporan = 'Dikerjakan';
            Historypelaporan_model::create([
                'idpelaporan' => $report_id,
                'status_sebelumnya' => "Antri",
                'status_setelahnya' => 'Dikerjakan',
                'keterangan' => 'Perubahan status karena assign staff',
                'idstaff' => Auth::user()->idstaff,
                'tgl_perubahan' => now()
            ]);
        }
        $report->save();
    }

    public static function ubahState($report_id, $state)
    {
        $report = Pelaporan_model::find($report_id);
        Historypelaporan_model::create([
            'idpelaporan' => $report_id,
            'status_sebelumnya' => $report->status_pelaporan,
            'status_setelahnya' => $state,
            'keterangan' => 'Perubahan status oleh staff',
            'idstaff' => Auth::user()->idstaff,
            'tgl_perubahan' => now()
        ]);
        $report->status_pelaporan = $state;
        $report->save();
    }
}
