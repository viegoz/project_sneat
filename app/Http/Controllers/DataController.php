<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataModel;
use App\Models\Histori;
use Carbon\Carbon;

class DataController extends Controller
{
    public function edit()
    {
        $data = DataModel::first();
        $allData = DataModel::all();
        if (!$data) {
            return redirect()->route('home.entry')->with('error', 'Data tidak ditemukan');
        }
        return view('backend.home.update', compact('data', 'allData'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'perihal' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'status' => 'required|string|in:Diterima,Ditolak',
            'tanggal_edit' => 'required|date',
        ]);

        $data = DataModel::find($id);
        if (!$data) {
            return redirect()->route('entry')->with('error', 'Data tidak ditemukan');
        }

        Histori::create($data->toArray());

        $data->perihal = $request->perihal;
        $data->keterangan = $request->keterangan;
        $data->status = $request->status;
        $data->tanggal_edit = $request->tanggal_edit ?? Carbon::now()->toDateString();
        $data->save();

        return redirect()->route('home.update.edit', $data->id)->with('success', 'Berhasil melakukan UPDATE');
    }

    public function getPerihalByNde(Request $request)
    {
        $data = DataModel::find($request->id);
        if ($data) {
            return response()->json([
                'perihal' => $data->perihal, 
                'nomor_nde' => $data->nomor_nde,
                'tanggal_submit_surat' => $data->tanggal_submit_surat,
            ]);
        }
        return response()->json([], 404);
    }

    public function getPerihalByNdeInput(Request $request)
    {
        $data = DataModel::where('nomor_nde', $request->nomor_nde)->first();
        if ($data) {
            return response()->json(['perihal' => $data->perihal, 'id' => $data->id]);
        }
        return response()->json([], 404);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'id_kantor' => 'required|string|max:255',
            'nama_kantor' => 'required|string|max:255',
            'jenis_kantor' => 'required|string|max:255',
            'pso_non_pso' => 'required|string|max:255',
            'kcu_kc' => 'required|string|max:255',
            'nomor_nde' => 'required|string|max:255',
            'tanggal_nde' => 'required|date',
            'perihal' => 'required|string|max:255',
            'pejabat_pengirim_nde' => 'required|string|max:255',
            'regional' => 'required|string|max:255',
            'jenis_pengajuan' => 'required|string|max:255',
            'biaya_yang_diajukan' => 'required|string|max:255',
            'masa_sewa' => 'required|string|max:255',
            'tmt' => 'required|string|max:255',
            'sd' => 'required|string|max:255',
            'kinerja_2021' => 'required|string|max:255',
            'kinerja_2022' => 'required|string|max:255',
            'kinerja_2023' => 'required|string|max:255',
            'tanggal_submit_surat' => 'required|date',
        ]);

        DataModel::create($request->all());

        return redirect()->route('entry')->with('success', 'Data berhasil disimpan');
    }
}
