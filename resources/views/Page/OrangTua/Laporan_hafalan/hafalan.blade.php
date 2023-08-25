@extends('template.layout')
@section('style')
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/heroicons@1.0.4/dist/css/heroicons.min.css" rel="stylesheet">
    <link href="{{ asset('plugins/summernote/summernote-lite.css') }}" rel="stylesheet">
    <style>
        .search-input {
            padding: 8px;
            width: 300px;
            border-radius: 4px 0 0 4px;
        }

        .search-btn {
            padding: 8px;
            border-radius: 0 4px 4px 0;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card latest-update-card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h3>PROGRES HAFALAN SANTRI</h3>
                        <div class="flex">
                            @foreach ($rep as $item)
                                @php
                                    $baseURL = '/orangtua/laporan';
                                    $id = $item->siswa->id;         
                                @endphp
                            @endforeach
                            <a class="btn btn-outline-primary p-2" href="{{ $baseURL }}/{{ $id }}"
                                type="button">
                                <i class="fa fa-print"></i> LAPORAN</a>

                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="w-full pb-10 pt-2">
                        <table class="display" id="tables" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Santri</th>
                                    <th>Nama Guru</th>
                                    <th>Tanggal</th>
                                    <th>Juz</th>
                                    <th>Surat</th>
                                    <th>Mulai Ayat</th>
                                    <th>Sampai Ayat</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($rep as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->siswa->nama_lengkap }}</td>
                                        <td>{{ $item->guru->nama }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->juz }}</td>
                                        <td>{{ $item->nama_surat }}</td>
                                        <td>{{ $item->ayat_start }}</td>
                                        <td>{{ $item->ayat_end }}</td>
                                        <td>{{ $item->catatan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js">
    </script>
    <script src="{{ asset('plugins/summernote/summernote-lite.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script> --}}
    <script>
        $('#tables').DataTable({
            searching: false, // Menonaktifkan fitur pencarian
            paging: false, // Menonaktifkan paginasi
            info: false, // Menonaktifkan informasi jumlah data
            // scrollY: '50vh',
            // scrollCollapse: true,
        });
        $(".summernote").summernote({
            tabsize: 2,
            height: "100vh",
            toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["table", ["table"]],
                ["insert", ["link", "picture", "video"]],
                ["view", ["fullscreen", "codeview", "help"]],
            ],
        });
    </script>
@endsection
