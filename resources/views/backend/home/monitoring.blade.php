@extends('layouts.app')

@section('title', 'Monitoring')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Monitoring</h5>
            <div class="card-body">
                <form method="GET" action="{{ route('home.monitoring') }}">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="month" class="form-label">Bulan</label>
                            <input type="number" class="form-control" name="month" id="month" placeholder="MM" min="1" max="12" value="{{ request('month') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="year" class="form-label">Tahun</label>
                            <input type="number" class="form-control" name="year" id="year" placeholder="YYYY" value="{{ request('year') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="regional" class="form-label">Regional</label>
                            <input type="text" class="form-control" name="regional" id="regional" placeholder="Regional" value="{{ request('regional') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="{{ request('status') }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('monitoring.export', request()->only(['month', 'year', 'regional', 'status'])) }}" class="btn btn-success">Download Excel</a>
                </form>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Kantor</th>
                            <th>Jenis Kantor</th>
                            <th>PSO/Non-PSO</th>
                            <th>KCU/KC</th>
                            <th>Nomor NDE</th>
                            <th>Tanggal NDE</th>
                            <th>Perihal</th>
                            <th>Pejabat Pengirim NDE</th>
                            <th>Regional</th>
                            <th>Jenis Pengajuan</th>
                            <th>Biaya yang Diajukan</th>
                            <th>Masa Sewa</th>
                            <th>TMT</th>
                            <th>SD</th>
                            <th>Kinerja 2021</th>
                            <th>Kinerja 2022</th>
                            <th>Kinerja 2023</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Tanggal Edit</th>
                            <th>Tanggal Submit Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data->isEmpty())
                            <tr>
                                <td colspan="22" class="text-center">No data available</td>
                            </tr>
                        @else
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->nama_kantor }}</td>
                                    <td>{{ $item->jenis_kantor }}</td>
                                    <td>{{ $item->pso_non_pso }}</td>
                                    <td>{{ $item->kcu_kc }}</td>
                                    <td>{{ $item->nomor_nde }}</td>
                                    <td>{{ $item->tanggal_nde }}</td>
                                    <td>{{ $item->perihal }}</td>
                                    <td>{{ $item->pejabat_pengirim_nde }}</td>
                                    <td>{{ $item->regional }}</td>
                                    <td>{{ $item->jenis_pengajuan }}</td>
                                    <td>{{ $item->biaya_yang_diajukan }}</td>
                                    <td>{{ $item->masa_sewa }}</td>
                                    <td>{{ $item->tmt }}</td>
                                    <td>{{ $item->sd }}</td>
                                    <td>{{ $item->kinerja_2021 }}</td>
                                    <td>{{ $item->kinerja_2022 }}</td>
                                    <td>{{ $item->kinerja_2023 }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>{{ $item->tanggal_edit }}</td>
                                    <td>{{ $item->tanggal_submit_surat }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection