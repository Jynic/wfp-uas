<?php

namespace App\Http\Controllers;

use App\Models\Fasum_model;
use App\Models\Jenisfasum_model;
use App\Models\Kota_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Fasum extends Controller
{
    public function index()
    {
        $idjabatan = Auth::user()->idjabatan;
        $data = DB::table('a_hak_akses_jabatan as ha')
            ->join('a_hak_akses as ha2', 'ha.idhak_akses', '=', 'ha2.idhak_akses')
            ->where('ha.idjabatan', $idjabatan)
            ->select('ha.idjabatan', 'ha2.kode_fitur', 'ha2.nama_fitur')
            ->get();
        foreach ($data as $key => $row) {
            if ($row->nama_fitur == "master_fasum") {
                return view('fasum_v');
            }
        }
        return view('dashboard_v');
    }

    public function edit(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];

        $result = DB::table('m_fasum as f')
            ->leftJoin('m_kategori_fasum_has_m_fasum as kfs', 'f.idfasum', '=', 'kfs.m_fasum_idfasum')
            ->leftJoin('m_kategori_fasum as kf', 'kfs.m_kategori_fasum_idkategori_fasum', '=', 'kf.idkategori_fasum')
            ->join('m_dinas as d', 'f.m_dinas_iddinas', '=', 'd.iddinas')
            ->join('m_kota_kabupaten as kk', 'd.idkota_kabupaten', '=', 'kk.idkota_kabupaten')
            ->where('f.status_aktif', 1)
            ->where('f.idfasum', $id)
            ->select(
                'f.idfasum as id',
                'f.nama',
                'f.luas_fasum',
                'f.kondisi_fasum',
                'f.asal_fasum',
                DB::raw("CONCAT(f.lat, ', ', f.lng) as lokasi"),
                'f.gambar',
                DB::raw('GROUP_CONCAT(kf.nama SEPARATOR ", ") as kategori'),
                DB::raw('GROUP_CONCAT(kf.idkategori_fasum SEPARATOR ", ") as kategori_id'),
                'd.nama as dinas',
                'd.iddinas as dinas_id',
                'kk.nama as nama_kota',
                'f.status_aktif'
            )
            ->groupBy(
                'f.idfasum',
                'f.nama',
                'f.luas_fasum',
                'f.kondisi_fasum',
                'f.asal_fasum',
                'f.lat',
                'f.lng',
                'f.gambar',
                'd.nama',
                'kk.nama',
                'd.iddinas',
                'f.status_aktif'
            )
            ->get();
        return json_encode($result);
    }

    public function update(Request $request)
    {
        $formData = $request->all();
        $id = $formData['id'];
        $fasum = Fasum_model::find($id);
        if (!$fasum) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
        $fasum->nama = $formData['nama'] ?? $fasum->nama;
        $fasum->m_dinas_iddinas = $formData['dinas'] ?? $fasum->m_dinas_iddinas;
        $fasum->luas_fasum = $formData['luasFasum'] ?? $fasum->luas_fasum;
        $fasum->kondisi_fasum = $formData['kondisiFasum'] ?? $fasum->kondisi_fasum;
        $fasum->asal_fasum = $formData['asalFasum'] ?? $fasum->asal_fasum;
        $fasum->lat = $formData['latitude'] ?? $fasum->lat;
        $fasum->lng = $formData['longitude'] ?? $fasum->lng;

        if ($request->hasFile('gambarFasum')) {
            $gambar = $request->file('gambarFasum');

            if (!$gambar->isValid()) {
                return response()->json(['error' => 'File gambar tidak valid'], 400);
            }

            $folder = 'public/img_fasum';
            $filename = $id . '_' . $formData['nama'] . '.' . $gambar->getClientOriginalExtension();

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder);
            }

            try {
                $path = $gambar->storeAs($folder, $filename);
                $gambarPath = "storage/img_fasum/" . $filename;
                $fasum->gambar = $gambarPath;
            } catch (\Exception $e) {
                return response()->json(['error' => 'Gagal menyimpan file gambar untuk fasum '], 500);
            }
        }

        $fasum->save();

        DB::table('m_kategori_fasum_has_m_fasum')
            ->where('m_fasum_idfasum', $id)
            ->delete();

        $kategori = $formData['kategori'] ?? [];
        foreach ($kategori as $item) {
            DB::table('m_kategori_fasum_has_m_fasum')->insert([
                'm_kategori_fasum_idkategori_fasum' => $item,
                'm_fasum_idfasum' => $id
            ]);
        }

        return response()->json(['status' => true, 'message' => 'Data berhasil diperbarui']);
    }

    public function getData()
    {
        $data = DB::table('m_fasum as f')
            ->leftJoin('m_kategori_fasum_has_m_fasum as kfs', 'f.idfasum', '=', 'kfs.m_fasum_idfasum')
            ->leftJoin('m_kategori_fasum as kf', 'kfs.m_kategori_fasum_idkategori_fasum', '=', 'kf.idkategori_fasum')
            ->join('m_dinas as d', 'f.m_dinas_iddinas', '=', 'd.iddinas')
            ->join('m_kota_kabupaten as kk', 'd.idkota_kabupaten', '=', 'kk.idkota_kabupaten')
            ->where('f.status_aktif', 1)
            ->select(
                'f.idfasum as id',
                'f.nama',
                'f.luas_fasum',
                'f.kondisi_fasum',
                'f.asal_fasum',
                DB::raw("CONCAT(f.lat, ', ', f.lng) as lokasi"),
                'f.gambar',
                DB::raw('GROUP_CONCAT(kf.nama SEPARATOR ", ") as kategori'),
                'd.nama as dinas',
                'kk.nama as nama_kota',
                'f.status_aktif'
            )
            ->groupBy(
                'f.idfasum',
                'f.nama',
                'f.luas_fasum',
                'f.kondisi_fasum',
                'f.asal_fasum',
                'f.lat',
                'f.lng',
                'f.gambar',
                'd.nama',
                'kk.nama',
                'f.status_aktif'
            )
            ->get();

        $fasum = [];
        foreach ($data as $key => $value) {
            $fasum[] = array(
                $value->nama,
                $value->kategori,
                $value->dinas,
                $value->nama_kota,
                $value->luas_fasum,
                $value->kondisi_fasum,
                $value->asal_fasum,
                $value->lokasi,
                '<img src="' . asset($value->gambar) . '" alt="Gambar" style="max-width: 100px; max-height: 100px;">',
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
        echo json_encode($fasum);
    }

    public function getDataKategori(Request $request)
    {
        $search_term = $request->input('search');
        $data = DB::table('m_kategori_fasum as kf')
            ->where('kf.status_aktif', 1)
            ->where('kf.nama', 'like', '%' . $search_term . '%')
            ->select('kf.idkategori_fasum as id', 'kf.nama', 'kf.status_aktif')
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
        $data = DB::table('m_dinas as d')
            ->where('d.status_aktif', 1)
            ->where('d.nama', 'like', '%' . $search_term . '%')
            ->select('d.iddinas as id', 'd.nama')
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

    public function simpan(Request $request)
    {
        $formData = $request->all();
        $fasum = new Fasum_model();
        $fasum->nama = $formData['nama'] ?? '';
        $fasum->m_dinas_iddinas = $formData['dinas'] ?? 1;
        $fasum->luas_fasum = $formData['luasFasum'] ?? 0;
        $fasum->kondisi_fasum = $formData['kondisiFasum'] ?? '';
        $fasum->asal_fasum = $formData['asalFasum'] ?? '';
        $fasum->lat = $formData['latitude'] ?? '';
        $fasum->lng = $formData['longitude'] ?? '';

        if ($request->hasFile('gambarFasum')) {
            $gambar = $request->file('gambarFasum');
            $folder = 'public/img_fasum';
            $filename = uniqid() . '.' . $gambar->getClientOriginalExtension();

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder);
            }

            try {
                $path = $gambar->storeAs($folder, $filename);
                $gambarPath = "storage/img_fasum/" . $filename;
                $fasum->gambar = $gambarPath;
            } catch (\Exception $e) {
                return response()->json(['error' => 'Gagal menyimpan gambar'], 500);
            }
        }

        $fasum->save();

        $kategori = $formData['kategori'] ?? [];
        foreach ($kategori as $item) {
            DB::table('m_kategori_fasum_has_m_fasum')->insert([
                'm_kategori_fasum_idkategori_fasum' => $item,
                'm_fasum_idfasum' => $fasum->idfasum
            ]);
        }

        return response()->json(['status' => true, 'message' => 'Data berhasil disimpan']);
    }
}
