@extends('template.layout')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="flex justify-between">
                        <h1 class="text-white text-bold" style="font-size: 1.5em"> <a class="hover:text-gray-100 text-gray-300"
                                href="/register-siswa"><i class="fa fa-arrow-left"></i></a> Data
                            Pendaftaran</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="w-full pb-10 pt-2">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="p-2 border border-dashed border-gray-400  h-full">
                                    <table class="w-50">
                                        <tr>
                                            <td class="p-2">Tahun Ajaran</td>
                                            <td class="p-2">:</td>
                                            <td class="p-2">{{ $pendaftar->tahun_ajaran }}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Metode Pendaftaran</td>
                                            <td class="p-2">:</td>
                                            <td class="p-2">
                                                {{ $pendaftar->metode_pendaftaran == 'operator' ? 'Admin Sekolah' : $pendaftar->metode_pendaftaran }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="p-2">Lampiran</td>
                                            <td class="p-2">:</td>
                                            <td class="p-2">
                                                <a href="{{ asset('lampiran/' . $pendaftar->lampiran) }}">
                                                    <i class="fas fa-file-pdf"></i> Lampiran
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="p-2 border border-dashed border-gray-400  h-full">
                                    <h2>Data Siswa</h2>
                                    <hr>
                                    <table class="w-full">
                                        @foreach ($siswa as $key => $item)
                                            <tr>
                                                <td class="p-2">{{ $key }}</td>
                                                <td class="p-2">:</td>
                                                <td class="p-2">{{ $item }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="p-2">Asal Sekolah</td>
                                            <td class="p-2">:</td>
                                            <td class="p-2">{{ $pendaftar->asal_sekolah }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="p-2 border border-dashed border-gray-400 h-full">
                                    <h2>Data Orangtua</h2>
                                    <hr>
                                    <table class="w-full">
                                        @foreach ($orangtua as $key => $item)
                                            <tr>
                                                <td class="p-2">{{ $key }}</td>
                                                <td class="p-2">:</td>
                                                <td class="p-2">{{ $item }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <link href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        .c-pill {
            align-items: center;
            font-family: "Open Sans", Arial, Verdana, sans-serif;
            font-weight: bold;
            font-size: 11px;
            display: inline-block;
            height: 100%;
            white-space: nowrap;
            width: auto;

            position: relative;
            border-radius: 100px;
            line-height: 1;
            overflow: hidden;
            padding: 0px 12px 0px 20px;
            text-overflow: ellipsis;
            line-height: 1.25rem;
            color: #595959;

            word-break: break-word;

            &:before {
                border-radius: 50%;
                content: "";
                height: 10px;
                left: 6px;
                margin-top: -5px;
                position: absolute;
                top: 50%;
                width: 10px;
            }
        }

        .c-pill--success {
            background: #b4eda0;
        }

        .c-pill--success:before {
            background: #6bc167;
        }

        .c-pill--warning {
            background: #ffebb6;
        }

        .c-pill--warning:before {
            background: #ffc400;
        }

        .c-pill--danger {
            background: #ffd5d1;
        }

        .c-pill--danger:before {
            background: #ff4436;
        }

        .jumbotrons {
            position: absolute;
            width: 100%;
            height: 250px;
            background: rgb(29 48 69);
        }
    </style>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@endsection
