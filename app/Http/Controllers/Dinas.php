<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Dinas_model;

class Dinas extends Controller
{
    public function index()
    {
        $idjabatan = Auth::user()->idjabatan;
        $data = DB::table('a_hak_akses_jabatan as ha')
            ->join('a_hak_akses as ha2', 'ha.idhak_akses', '=', 'ha2.idhak_akses')
            ->where('ha.idjabatan', $idjabatan)
            ->select('ha.idjabatan', 'ha2.kode_fitur', 'ha2.nama_fitur')
            ->get();

        foreach ($data as $row) {
            if ($row->nama_fitur == "master_dinas") {
                return view('dinas_v');
            }
        }
        return view('dashboard_v');
    }

    public function edit(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];

        $result = DB::table('m_dinas as d')
            ->join('m_kota_kabupaten as kk', 'd.idkota_kabupaten', '=', 'kk.idkota_kabupaten')
            ->where('d.iddinas', $id)
            ->select('d.iddinas as id', 'd.nama', 'd.alamat', 'd.status_aktif', 'kk.nama as kota_nama', 'kk.idkota_kabupaten as kota_id')
            ->get();

        return json_encode($result);
    }

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

        DB::table('m_dinas')
            ->where('iddinas', $id)
            ->update([
                'nama' => $nama,
                'idkota_kabupaten' => $kota,
                'alamat' => $alamat
            ]);

        echo json_encode(array("status" => TRUE));
    }

    public function getData(Request $request)
    {
        $data = DB::table('m_dinas as d')
            ->join('m_kota_kabupaten as kk', 'd.idkota_kabupaten', '=', 'kk.idkota_kabupaten')
            ->where('d.status_aktif', 1)
            ->select('d.iddinas as id', 'd.nama', 'd.alamat', 'd.status_aktif', 'kk.nama as kota')
            ->get();

        $dinas = [];
        foreach ($data as $value) {
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
        echo json_encode($dinas);
    }

    public function getDataKota(Request $request)
    {
        $search_term = $request->input('search');
        $data = DB::table('m_kota_kabupaten')
            ->where('status_aktif', 1)
            ->where('nama', 'like', '%' . $search_term . '%')
            ->select('idkota_kabupaten as id', 'nama')
            ->get();

        $provinsi = [];
        foreach ($data as $row) {
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

        DB::table('m_dinas')->insert([
            'nama' => $nama,
            'idkota_kabupaten' => $kota,
            'alamat' => $alamat
        ]);

        echo json_encode(array("status" => TRUE));
    }

    public function hapus(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];

        DB::table('m_dinas')
            ->where('iddinas', $id)
            ->update(['status_aktif' => 0]);

        echo json_encode(array("status" => TRUE));
    }
}
