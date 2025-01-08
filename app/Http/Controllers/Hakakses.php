<?php

namespace App\Http\Controllers;

use App\Models\Fasum_model;
use App\Models\Jenisfasum_model;
use App\Models\Kota_model;
use App\Models\Pelaporan_model;
use App\Models\Staff_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Hakakses extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idjabatan = Auth::user()->idjabatan;
        $data = DB::table('a_hak_akses_jabatan as ha')
            ->join('a_hak_akses as ha2', 'ha.idhak_akses', '=', 'ha2.idhak_akses')
            ->where('ha.idjabatan', $idjabatan)
            ->select('ha.idjabatan', 'ha2.kode_fitur', 'ha2.nama_fitur')
            ->get();
        foreach ($data as $key => $row) {
            if ($row->nama_fitur == "hak_akses") {
                return view('hak_akses_v');
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

        $result = DB::table('t_pelaporan as p')
            ->join('t_pelaporan_detail as pd', 'p.idpelaporan', '=', 'pd.t_pelaporan_idpelaporan')
            ->join('m_staff as s', 'p.idm_staff', '=', 's.idm_staff')
            ->join('m_user as u', 'p.iduser', '=', 'u.iduser')
            ->join('m_fasum as f', 'pd.m_fasum_idfasum', '=', 'f.idfasum')
            ->join('m_staff as s1', 'pd.idstaff', '=', 's1.idm_staff')
            ->where('p.status_aktif', 1)
            ->where('p.idpelaporan', $id)
            ->select(
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
                'f.nama as nama_fasum',
                'f.idfasum as id_fasum',
                'pd.status_perbaikkan as status_perbaikkan',
                'pd.foto_fasum as foto_fasum',
                'pd.keterangan as keterangan_fasum',
                's1.idm_staff as id_staff_detail',
                's1.nama as nama_staff_detail'
            )
            ->get();
        return response()->json($result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $formData = $request->all();
        $tgl = date('Y-m-d H:i:s', strtotime($formData['tgl']));
        $id = $formData['id'];

        $dataPelaporan = [
            'nomor' => $formData['nomor'],
            'tgl_pelaporan' => $tgl,
            'idm_staff' => 8,
            'iduser' => $formData['user'],
            'keterangan' => $formData['keterangan']
        ];

        DB::table('t_pelaporan')
            ->where('idpelaporan', $id)
            ->update($dataPelaporan);

        $dataold = DB::table('t_pelaporan_detail')
            ->where('t_pelaporan_idpelaporan', $id)
            ->first();
        $gambarPath = $dataold->foto_fasum;

        DB::table('t_pelaporan_detail')
            ->where('t_pelaporan_idpelaporan', $id)
            ->delete();

        $folder = public_path('img_pelaporan');

        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        foreach ($formData['fasum'] as $key => $value) {
            if (isset($request->file('gambarFasum')[$key])) {
                $gambar = $request->file('gambarFasum')[$key];

                if ($gambar->isValid()) {
                    $filename = $id . '_detail_' . $key . '.' . $gambar->getClientOriginalExtension();
                    try {
                        $gambar->move($folder, $filename);
                        $gambarPathNew = 'img_pelaporan/' . $filename;
                        $dataDetail = [
                            't_pelaporan_idpelaporan' => $id,
                            'm_fasum_idfasum' => $value,
                            'status_perbaikkan' => $formData['status_perbaikkan'][$key] ?? 'Antri',
                            'foto_fasum' => $gambarPathNew,
                            'keterangan' => $formData['keterangan_detail'][$key],
                            'idstaff' => 8
                        ];
                    } catch (\Exception $e) {
                        return response()->json(['error' => 'Gagal menyimpan file gambar untuk detail ' . ($key + 1)], 500);
                    }
                } else {
                    return response()->json(['error' => 'File gambar tidak valid untuk detail ' . ($key + 1)], 400);
                }
            } else {
                $dataDetail = [
                    't_pelaporan_idpelaporan' => $id,
                    'm_fasum_idfasum' => $value,
                    'status_perbaikkan' => $formData['status_perbaikkan'][$key] ?? 'Antri',
                    'foto_fasum' => $gambarPath,
                    'keterangan' => $formData['keterangan_detail'][$key],
                    'idstaff' => 8
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

    public function getData()
    {
        $data = DB::table('a_hak_akses_jabatan as haj')
            ->join('a_hak_akses as ha', 'haj.idhak_akses', '=', 'ha.idhak_akses')
            ->join('m_jabatan as j', 'haj.idjabatan', '=', 'j.idjabatan')
            ->where('ha.status_aktif', 1)
            ->groupBy('j.nama', 'haj.idjabatan')
            ->orderBy('j.nama')
            ->select('haj.idjabatan as id', 'j.nama as nama_jabatan', DB::raw('GROUP_CONCAT(CONCAT(ha.kode_fitur, " - ", ha.nama_fitur) SEPARATOR ", ") as fitur'))
            ->get();

        $pelaporan = [];
        foreach ($data as $key => $value) {
            $pelaporan[] = array(
                $value->nama_jabatan,
                $value->fitur,
                '<div class="d-flex justify-content-center">
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm ms-3" onclick="hapus(' . $value->id . ')">
                        <i class="bx bx-trash"></i>
                    </a> </div>'
            );
        }

        echo json_encode($pelaporan);
    }

    public function getDataListHakakses()
    {
        $data = DB::table('a_hak_akses as ha')
            ->where('ha.status_aktif', 1)
            ->select('ha.idhak_akses as id', 'ha.kode_fitur', 'ha.nama_fitur')
            ->get();

        $hakakses = [];
        foreach ($data as $key => $value) {
            $hakakses[] = array(
                '<div class="form-check">
                    <input class="form-check-input" type="checkbox" name="checkbox_hakakses[]" id="checkbox_' . $value->id . '" value="' . $value->id . '">
                </div>',
                '<div style="width:100%; overflow:hidden; white-space:nowrap;">' . $value->nama_fitur . '</div>'
            );
        }

        echo json_encode($hakakses);
    }

    public function getKota(Request $request)
    {
        $search_term = $request->input('search');
        $data = DB::table('m_kota_kabupaten as kk')
            ->where('kk.status_aktif', 1)
            ->where('kk.nama', 'like', '%' . $search_term . '%')
            ->select('kk.idkota_kabupaten as id', 'kk.nama')
            ->get();
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
        $data = DB::table('m_staff as s')
            ->where('s.status_aktif', 1)
            ->where('s.nama', 'like', '%' . $search_term . '%')
            ->select('s.idm_staff as id', 's.nama')
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

    public function getDataUser(Request $request)
    {
        $search_term = $request->input('search');
        $data = DB::table('m_user as u')
            ->where('u.status_aktif', 1)
            ->where('u.nama', 'like', '%' . $search_term . '%')
            ->select('u.iduser as id', 'u.nama')
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

    public function getDataJabatan(Request $request)
    {
        $search_term = $request->input('search');
        $data = DB::table('m_jabatan as j')
            ->where('j.status_aktif', 1)
            ->where('j.nama', 'like', '%' . $search_term . '%')
            ->select('j.idjabatan as id', 'j.nama')
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

    public function getDetailJabatan(Request $request)
    {
        $id = $request->input('id');
        $data = DB::table('a_hak_akses_jabatan as ha')
            ->join('a_hak_akses as ha2', 'ha.idhak_akses', '=', 'ha2.idhak_akses')
            ->where('ha.idjabatan', $id)
            ->select('ha.idhak_akses', 'ha2.kode_fitur', 'ha2.nama_fitur')
            ->get();

        echo json_encode($data);
    }

    public function simpan(Request $request)
    {
        $formData = $request->all();
        if (isset($formData['jabatan']) && !empty($formData['jabatan'])) {
            DB::table('a_hak_akses_jabatan')
                ->where('idjabatan', $formData['jabatan'])
                ->delete();
        }
        if (!empty($formData['checkbox_hakakses'])) {
            $uniqueHakakses = array_unique($formData['checkbox_hakakses']);

            foreach ($uniqueHakakses as $idhak_akses) {
                $hakAksesData = [
                    'idjabatan' => $formData['jabatan'],
                    'idhak_akses' => $idhak_akses,
                ];
                DB::table('a_hak_akses_jabatan')->insert($hakAksesData);
            }
        }

        echo json_encode(array("status" => TRUE));
    }

    public function hapus(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        DB::table('t_pelaporan')
            ->where('idpelaporan', $id)
            ->update(['status_aktif' => 0]);
        echo json_encode(array("status" => TRUE));
    }

    public function GetNomor()
    {
        $nomor = DB::table('t_pelaporan')
            ->select(DB::raw('count(idpelaporan) + 1 as nomor'))
            ->orderByDesc('idpelaporan')
            ->first();
        return intval($nomor->nomor);
    }

    public function detail(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $data = DB::table('t_pelaporan as p')
            ->join('t_pelaporan_detail as pd', 'p.idpelaporan', '=', 'pd.t_pelaporan_idpelaporan')
            ->join('m_staff as s', 'p.idm_staff', '=', 's.idm_staff')
            ->join('m_user as u', 'p.iduser', '=', 'u.iduser')
            ->join('m_fasum as f', 'pd.m_fasum_idfasum', '=', 'f.idfasum')
            ->join('m_staff as s1', 'pd.idstaff', '=', 's1.idm_staff')
            ->where('p.status_aktif', 1)
            ->where('p.idpelaporan', $id)
            ->select(
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
                'f.nama as nama_fasum',
                'f.idfasum as id_fasum',
                'pd.status_perbaikkan as status_perbaikkan',
                'pd.foto_fasum as foto_fasum',
                'pd.keterangan as keterangan_fasum',
                's1.idm_staff as id_staff_detail',
                's1.nama as nama_staff_detail'
            )
            ->get();
        return response()->json($data);
    }
}
