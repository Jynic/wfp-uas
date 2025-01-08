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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idjabatan = Auth::user()->idjabatan;
        $data = DB::select('select ha.idjabatan, ha2.kode_fitur, ha2.nama_fitur from a_hak_akses_jabatan ha inner join a_hak_akses ha2 on ha.idhak_akses=ha2.idhak_akses where idjabatan = :idjabat', ['idjabat' => $idjabatan]);
        foreach ($data as $key => $row) {
            if ($row->nama_fitur == "master_fasum") {
                return view('fasum_v');
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
        SELECT 
            f.idfasum AS id, 
            f.nama, 
            f.luas_fasum, 
            f.kondisi_fasum, 
            f.asal_fasum, 
            CONCAT(f.lat, ', ', f.lng) AS lokasi, 
            f.gambar, 
            GROUP_CONCAT(kf.nama SEPARATOR ', ') AS kategori, 
            GROUP_CONCAT(kf.idkategori_fasum SEPARATOR ', ') AS kategori_id, 
            d.nama AS dinas,
            d.iddinas AS dinas_id,
            kk.nama AS nama_kota,
            f.status_aktif
        FROM 
            m_fasum f
        LEFT JOIN 
            m_kategori_fasum_has_m_fasum kfs 
            ON f.idfasum = kfs.m_fasum_idfasum
        LEFT JOIN 
            m_kategori_fasum kf 
            ON kfs.m_kategori_fasum_idkategori_fasum = kf.idkategori_fasum
        INNER JOIN 
            m_dinas d 
            ON f.m_dinas_iddinas = d.iddinas
        INNER JOIN 
            m_kota_kabupaten kk ON d.idkota_kabupaten=kk.idkota_kabupaten
        WHERE 
            f.status_aktif = 1 AND f.idfasum = :id
        GROUP BY 
            f.idfasum, f.nama, f.luas_fasum, f.kondisi_fasum, 
            f.asal_fasum, f.lat, f.lng, f.gambar, d.nama, kk.nama, d.iddinas, f.status_aktif;", ['id' => $id]);
        return json_encode($result);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $formData = $request->all();
        $id = $formData['id'];
        // Ambil data fasum berdasarkan ID
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

        // Proses file gambar jika ada
        if ($request->hasFile('gambarFasum')) {
            $gambar = $request->file('gambarFasum');

            // Validasi file gambar
            if (!$gambar->isValid()) {
                return response()->json(['error' => 'File gambar tidak valid'], 400);
            }

            // Hapus gambar lama jika ada
            if (!empty($fasum->gambar) && file_exists(public_path($fasum->gambar))) {
                unlink(public_path($fasum->gambar));
            }

            // Tentukan folder penyimpanan
            $folder = public_path('img_fasum');
            $filename = $id . '_' . preg_replace('/[^a-zA-Z0-9-_]/', '', $fasum->nama) . '.' . $gambar->getClientOriginalExtension();

            // Buat direktori jika belum ada
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            // Pindahkan file ke folder yang ditentukan
            try {
                $gambar->move($folder, $filename);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Gagal menyimpan file gambar'], 500);
            }

            // Simpan URL gambar ke database
            $fasum->gambar = 'img_fasum/' . $filename;
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
            f.idfasum AS id, 
            f.nama, 
            f.luas_fasum, 
            f.kondisi_fasum, 
            f.asal_fasum, 
            CONCAT(f.lat, ', ', f.lng) AS lokasi, 
            f.gambar, 
            GROUP_CONCAT(kf.nama SEPARATOR ', ') AS kategori, 
            d.nama AS dinas,
            kk.nama AS nama_kota,
            f.status_aktif
        FROM 
            m_fasum f
        LEFT JOIN 
            m_kategori_fasum_has_m_fasum kfs 
            ON f.idfasum = kfs.m_fasum_idfasum
        LEFT JOIN 
            m_kategori_fasum kf 
            ON kfs.m_kategori_fasum_idkategori_fasum = kf.idkategori_fasum
        INNER JOIN 
            m_dinas d 
            ON f.m_dinas_iddinas = d.iddinas
        INNER JOIN 
            m_kota_kabupaten kk ON d.idkota_kabupaten=kk.idkota_kabupaten
        WHERE 
            f.status_aktif = 1
        GROUP BY 
            f.idfasum, f.nama, f.luas_fasum, f.kondisi_fasum, 
            f.asal_fasum, f.lat, f.lng, f.gambar, d.nama, kk.nama,f.status_aktif;
        ");

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
    public function simpan(Request $request)
    {
        // Proses data form
        $formData = $request->all();
        // dd($formData);
        // Buat model Fasum baru
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

        $data = DB::select("SELECT DISTINCT
                m_fasum.nama AS fasum_nama, 
                m_kategori_fasum.nama AS kategori_fasum,
                t_pelaporan.tgl_pelaporan
            FROM 
                t_pelaporan
            JOIN 
                t_pelaporan_detail ON t_pelaporan.idpelaporan = t_pelaporan_detail.t_pelaporan_idpelaporan
            JOIN 
                m_fasum ON t_pelaporan_detail.m_fasum_idfasum = m_fasum.idfasum
            JOIN
                m_kategori_fasum_has_m_fasum ON m_fasum.idfasum = m_kategori_fasum_has_m_fasum.m_fasum_idfasum
            JOIN
                m_kategori_fasum ON m_kategori_fasum_has_m_fasum.m_kategori_fasum_idkategori_fasum = m_kategori_fasum.idkategori_fasum
            WHERE 
                m_kategori_fasum.idkategori_fasum = $category
                AND YEAR(t_pelaporan.tgl_pelaporan) = $year
                AND MONTH(t_pelaporan.tgl_pelaporan) = $month
            ORDER BY 
                t_pelaporan.tgl_pelaporan DESC;");

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
