@extends('layouts.app')

@section('title', 'Update')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Update</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div id="validation-alert" class="alert alert-danger" style="display: none;">
                    Isilah semua field
                </div>
                <form action="{{ route('home.update.update', $data->id ?? '') }}" method="post" id="updateForm">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nomor_nde" class="form-label">Nomor NDE</label>
                        <select class="form-control" name="nomor_nde" id="nomorNdeSelect">
                            <option value="">--Pilih Nomor NDE--</option>
                            @foreach($allData as $item)
                                <option value="{{ $item->id }}" {{ isset($data) && $data->nomor_nde == $item->nomor_nde ? 'selected' : '' }}>
                                    {{ $item->nomor_nde }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggalSubmitSurat" class="form-label">Tanggal NDE</label>
                        <input type="text" class="form-control" name="tanggal_submit_surat" id="SubmitSurat" value="{{ $data->tanggal_submit_surat ?? ''}}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="perihal" class="form-label">Perihal</label>
                        <input type="text" class="form-control" name="perihal" id="perihalField" value="{{ $data->perihal ?? '' }}" readonly>
                    </div>

                    
                    <h6 class="card-title">Balasan</h6>

                    <div class="mb-3">
                        <label for="nomor_nde" class="form-label">Nomor NDE Balasan</label>
                        <input type="text" class="form-control" name="nomor_nde" id="nomor_nde" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for = "tanggal_submit_surat" class = "form-label">Tanggal NDE Balasan</label>
                        <input type = "date" class = "form-control" name = "tanggal_submit_surat" value="{{ \Carbon\Carbon::now()->toDateString() }}" readonly>
                    </div>

                    <div class = "mb-3">
                        <label for = "perihal" class = "form-label">Perihal Balasan</label>
                        <input type = "text" class = "form-control" name = "perihal" required>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" id="KeteranganValue" value="{{ $data->keterangan ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status">
                            <option value="Diterima" {{ isset($data) && $data->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="Ditolak" {{ isset($data) && $data->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">UPDATE</button>
                    
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#nomorNdeSelect').change(function() {
                var selectedId = $(this).val();
                if (selectedId) {
                    $.ajax({
                        url: '{{ route("getPerihalByNde") }}',
                        type: 'GET',
                        data: { id: selectedId },
                        success: function(response) {
                            $('#perihalField').val(response.perihal);
                            $('#SubmitSurat').val(response.tanggal_submit_surat);
                            // $('#nomorNdeBalasan').val(response.nomor_nde + ' - ' + response.created_at + ' - ' + response.perihal);
                            $('#KeteranganValue').val(response.keterangan);
                            $('#updateForm').attr('action', '{{ url("home/update") }}/' + selectedId);
                        }
                    });
                } else {
                    $('#perihalField').val('');
                    $('#nomorNdeBalasan').val('');
                    $('#updateForm').attr('action', '{{ route("home.update.update", "") }}');
                }
            });

            $('#updateForm').submit(function(event) {
                let valid = true;
                $('#updateForm .form-control').each(function() {
                    if ($(this).val() === '') {
                        valid = false;
                        $(this).css('border-color', 'red');
                    } else {
                        $(this).css('border-color', '');
                    }
                });

                if (!valid) {
                    event.preventDefault();
                    $('#validation-alert').show();
                }
            });

            if ($('.alert-success').length) {
                alert($('.alert-success').text());
            }
        });
    </script>
@endsection