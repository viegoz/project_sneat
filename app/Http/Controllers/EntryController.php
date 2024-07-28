<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;
use Illuminate\Support\Facades\DB;

class EntryController extends Controller
{
    public function entry()
    {
        $regionals = DB::table('referensi')->distinct()->pluck('regional');
        return view('backend.home.entry', compact('regionals'));
    }

    public function getKantorByRegional($regional)
    {
        $kantors = DB::table('referensi')
            ->where('regional', $regional)
            ->select('nama_kantor', 'id_kantor')
            ->get();

        return response()->json($kantors);
    }

    public function getKantorDetails($nama_kantor)
    {
        $details = DB::table('referensi')->where('nama_kantor', $nama_kantor)->select('id_kantor', 'jenis_kantor', 'pso_non_pso', 'kcu', 'kc')->first();
        return response()->json($details);
    }

    public function create()
    {
        return view('entry');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kantor_id' => 'required|string',
            'jenis_kantor' => 'required|string',
            'pso_non_pso' => 'required|string',
            'regional' => 'required|string',
            'kcu_kc' => 'required|string',
            'nomor_nde' => 'required|string',
            'tanggal_nde' => 'required|date',
            'perihal' => 'required|string',
            'pejabat_pengirim_nde' => 'required|string',
            'jenis_pengajuan' => 'required|string',
            'biaya_yang_diajukan' => 'required|string|max:255',
            'masa_sewa' => 'required|string',
            'tmt' => 'required|date',
            'sd' => 'required|date',
            'kinerja_2021_kurlog' => 'required|numeric',
            'kinerja_2021_jaskug' => 'required|numeric',
            'kinerja_2021_ritel' => 'required|numeric',
            'kinerja_2021_biaya' => 'required|numeric',
            'kinerja_2022_kurlog' => 'required|numeric',
            'kinerja_2022_jaskug' => 'required|numeric',
            'kinerja_2022_ritel' => 'required|numeric',
            'kinerja_2022_biaya' => 'required|numeric',
            'kinerja_2023_kurlog' => 'required|numeric',
            'kinerja_2023_jaskug' => 'required|numeric',
            'kinerja_2023_ritel' => 'required|numeric',
            'kinerja_2023_biaya' => 'required|numeric',
        ]);

        // Calculate kinerja totals
        $data['kinerja_2021'] = ($request->input('kinerja_2021_kurlog') * 0.2 + $request->input('kinerja_2021_jaskug') * 0.6 + $request->input('kinerja_2021_ritel') * 0.2) - $request->input('kinerja_2021_biaya');
        $data['kinerja_2022'] = ($request->input('kinerja_2022_kurlog') * 0.2 + $request->input('kinerja_2022_jaskug') * 0.6 + $request->input('kinerja_2022_ritel') * 0.2) - $request->input('kinerja_2022_biaya');
        $data['kinerja_2023'] = ($request->input('kinerja_2023_kurlog') * 0.2 + $request->input('kinerja_2023_jaskug') * 0.6 + $request->input('kinerja_2023_ritel') * 0.2) - $request->input('kinerja_2023_biaya');

        list($nama_kantor, $id_kantor) = explode(' - ', $data['nama_kantor_id']);
        $data['nama_kantor'] = $nama_kantor;
        $data['id_kantor'] = $id_kantor;

        // Remove individual kinerja fields
        unset($data['kinerja_2021_kurlog']);
        unset($data['kinerja_2021_jaskug']);
        unset($data['kinerja_2021_ritel']);
        unset($data['kinerja_2021_biaya']);
        unset($data['kinerja_2022_kurlog']);
        unset($data['kinerja_2022_jaskug']);
        unset($data['kinerja_2022_ritel']);
        unset($data['kinerja_2022_biaya']);
        unset($data['kinerja_2023_kurlog']);
        unset($data['kinerja_2023_jaskug']);
        unset($data['kinerja_2023_ritel']);
        unset($data['kinerja_2023_biaya']);

        $data['tanggal_submit_surat'] = now();

        Entry::create($data);

        return redirect()->route('home.entry')->with('success', 'Data berhasil disimpan.');
    }
}
