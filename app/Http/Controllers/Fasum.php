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
        return view('fasum_v');
    }
    public function edit(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];

        $result = DB::table('m_fasum AS f')
        ->leftJoin('m_kategori_fasum_has_m_fasum AS kfs', 'f.idfasum', '=', 'kfs.m_fasum_idfasum')
        ->leftJoin('m_kategori_fasum AS kf', 'kfs.m_kategori_fasum_idkategori_fasum', '=', 'kf.idkategori_fasum')
        ->join('m_dinas AS d', 'f.m_dinas_iddinas', '=', 'd.iddinas')
        ->join('m_kota_kabupaten AS kk', 'd.idkota_kabupaten', '=', 'kk.idkota_kabupaten')
        ->where('f.status_aktif', 1)
        ->where('f.idfasum', $id)
        ->groupBy('f.idfasum', 'f.nama', 'f.luas_fasum', 'f.kondisi_fasum', 'f.asal_fasum', 'f.lat', 'f.lng', 'f.gambar', 'd.nama', 'kk.nama', 'd.iddinas', 'f.status_aktif')
        ->selectRaw('
            f.idfasum AS id,
            f.nama,
            f.luas_fasum,
            f.kondisi_fasum,
            f.asal_fasum,
            CONCAT(f.lat, ", ", f.lng) AS lokasi,
            f.gambar,
            GROUP_CONCAT(kf.nama SEPARATOR ", ") AS kategori,
            GROUP_CONCAT(kf.idkategori_fasum SEPARATOR ", ") AS kategori_id,
            d.nama AS dinas,
            d.iddinas AS dinas_id,
            kk.nama AS nama_kota,
            f.status_aktif
        ')
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

        // Simpan perubahan pada fasum
        $fasum->save();

        // Hapus semua kategori lama
        DB::table('m_kategori_fasum_has_m_fasum')
            ->where('m_fasum_idfasum', $id)
            ->delete();

        // Insert kategori baru
        $kategori = $formData['kategori'] ?? [];
        foreach ($kategori as $item) {
            DB::table('m_kategori_fasum_has_m_fasum')->insert([
                'm_kategori_fasum_idkategori_fasum' => $item,
                'm_fasum_idfasum' => $id
            ]);
        }

        // Berikan respons sukses
        return response()->json(['status' => true, 'message' => 'Data berhasil diperbarui']);
    }
    public function getData()
    {
        $data = DB::table('m_fasum AS f')
    ->leftJoin('m_kategori_fasum_has_m_fasum AS kfs', 'f.idfasum', '=', 'kfs.m_fasum_idfasum')
    ->leftJoin('m_kategori_fasum AS kf', 'kfs.m_kategori_fasum_idkategori_fasum', '=', 'kf.idkategori_fasum')
    ->join('m_dinas AS d', 'f.m_dinas_iddinas', '=', 'd.iddinas')
    ->join('m_kota_kabupaten AS kk', 'd.idkota_kabupaten', '=', 'kk.idkota_kabupaten')
    ->where('f.status_aktif', 1)
    ->groupBy('f.idfasum', 'f.nama', 'f.luas_fasum', 'f.kondisi_fasum', 'f.asal_fasum', 'f.lat', 'f.lng', 'f.gambar', 'd.nama', 'kk.nama', 'f.status_aktif')
    ->selectRaw('
        f.idfasum AS id,
        f.nama,
        f.luas_fasum,
        f.kondisi_fasum,
        f.asal_fasum,
        CONCAT(f.lat, ", ", f.lng) AS lokasi,
        f.gambar,
        GROUP_CONCAT(kf.nama SEPARATOR ", ") AS kategori,
        d.nama AS dinas,
        kk.nama AS nama_kota,
        f.status_aktif
    ')
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
        // Kirim data dalam format JSON
        echo json_encode($fasum);
    }
    public function getDataKategori(Request $request)
    {
        $search_term = $request->input('search');
       $data = DB::table('m_kategori_fasum')
    ->where('status_aktif', 1)
    ->where('nama', 'LIKE', '%' . $search_term . '%')
    ->select('idkategori_fasum AS id', 'nama', 'status_aktif')
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
        $data = DB::table('m_dinas')
    ->where('status_aktif', 1)
    ->where('nama', 'LIKE', '%' . $search_term . '%')
    ->select('iddinas AS id', 'nama')
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
        // Proses data form
        $formData = $request->all();

        $fasum = new Fasum_model();
        $fasum->nama = $formData['nama'] ?? '';
        $fasum->m_dinas_iddinas = $formData['dinas'] ?? 1;
        $fasum->luas_fasum = $formData['luasFasum'] ?? 0;
        $fasum->kondisi_fasum = $formData['kondisiFasum'] ?? '';
        $fasum->asal_fasum = $formData['asalFasum'] ?? '';
        $fasum->lat = $formData['latitude'] ?? '';
        $fasum->lng = $formData['longitude'] ?? '';
        $fasum->save();

        $kategori = $formData['kategori'];
        foreach ($kategori as $item) {
            DB::table('m_kategori_fasum_has_m_fasum')->insert([
                'm_kategori_fasum_idkategori_fasum' => $item,
                'm_fasum_idfasum' => $fasum->idfasum
            ]);
        }

        $id = $fasum->idfasum;
        $nama = preg_replace('/[^a-zA-Z0-9-_]/', '', $fasum->nama); // Sanitasi nama untuk digunakan sebagai nama file

        if ($request->hasFile('gambarFasum')) {
            $gambar = $request->file('gambarFasum');

            if (!$gambar->isValid()) {
                return response()->json(['error' => 'File gambar tidak valid'], 400);
            }

            $folder = 'public/img_fasum';
            $filename = $id . '_' . $nama . '.' . $gambar->getClientOriginalExtension();

            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder);
            }

            try {
                $path = $gambar->storeAs($folder, $filename);
                $gambarPath = "storage/img_fasum/" . $filename;
            } catch (\Exception $e) {
                return response()->json(['error' => 'Gagal menyimpan file gambar untuk fasum'], 500);
            }

            $fasum->gambar = $gambarPath;
            $fasum->save();
        }

        // Berikan respons sukses
        return response()->json(['status' => true, 'message' => 'Data berhasil disimpan']);
    }





    public function hapus(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $update = DB::table('m_fasum')
            ->where('idfasum', $id)
            ->update(['status_aktif' => 0]);
        echo json_encode(array("status" => TRUE));
    }

    public function getFasumRusak(Request $request)
    {
        $category = $request->input('category');
        $month = $request->input('month');
        $year = $request->input('year');

        $data = DB::table('t_pelaporan')
    ->join('t_pelaporan_detail', 't_pelaporan.idpelaporan', '=', 't_pelaporan_detail.t_pelaporan_idpelaporan')
    ->join('m_fasum', 't_pelaporan_detail.m_fasum_idfasum', '=', 'm_fasum.idfasum')
    ->join('m_kategori_fasum_has_m_fasum', 'm_fasum.idfasum', '=', 'm_kategori_fasum_has_m_fasum.m_fasum_idfasum')
    ->join('m_kategori_fasum', 'm_kategori_fasum_has_m_fasum.m_kategori_fasum_idkategori_fasum', '=', 'm_kategori_fasum.idkategori_fasum')
    ->where('m_kategori_fasum.idkategori_fasum', $category)
    ->whereYear('t_pelaporan.tgl_pelaporan', $year)
    ->whereMonth('t_pelaporan.tgl_pelaporan', $month)
    ->select('m_fasum.nama as fasum_nama', 'm_kategori_fasum.nama as kategori_fasum', 't_pelaporan.tgl_pelaporan')
    ->distinct()
    ->orderBy('t_pelaporan.tgl_pelaporan', 'desc')
    ->get();

        $fasum = [];
        foreach ($data as $key => $value) {
            $fasum[] = array(
                'fasum_nama' => $value->fasum_nama,
                'kategori_fasum' => $value->kategori_fasum,
                'tgl_pelaporan' => $value->tgl_pelaporan,
            );
        }

        echo json_encode($fasum);
    }

    public function getKategoriFasum(Request $request)
    {
        $categories = DB::table('m_kategori_fasum')
            ->where('status_aktif', 1)
            ->get();
        return response()->json($categories);
    }
}
