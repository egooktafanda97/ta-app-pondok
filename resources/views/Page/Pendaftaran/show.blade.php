@extends('template.layout')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="d-flex">
                        <h1 class="text-white text-bold mr-auto p-2" style="font-size: 1.5em">DATA PENDAFTARAN</h1>
                        <button class="btn btn-outline-light p-2 mr-1" data-target=".modal-form" data-toggle="modal"><i
                                class="fa fa-filter"></i></button>
                        <a class="btn btn-outline-light p-2" href="/register-siswa/form" type="button">
                            <i class="fa fa-save"></i> FORMULIR PENDAFTARAN</a> &nbsp;
                        @php
                            $baseURL = '/register-siswa/laporan/';
                            $queryParams = request()->query(); // Mengambil semua query parameter dari URL saat ini
                            $queryString = http_build_query($queryParams); // Membuat string query parameter dari array
                        @endphp
                        <a class="btn btn-outline-light p-2" href="{{ $baseURL }}?{{ $queryString }}" type="button">
                            <i class="fa fa-print"></i> LAPORAN</a>

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
                        <table class="display responsive nowrap" id="tables" style="width:100%">
                            <thead class="bg-gray-100 text-gray-500 shadow-md">
                                <tr>
                                    <th class="w-[25px]">No</th>
                                    <th>nis</th>
                                    <th>nama</th>
                                    <th>Tahun Ajaran</th>
                                    <th>alamat lengkap</th>
                                    <th>asal sekolah</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tfoot class="bg-gray-100 text-gray-500 shadow-md">
                                <tr>
                                    <th class="w-[25px]">No</th>
                                    <th>nis</th>
                                    <th>nama</th>
                                    <th>Tahun Ajaran</th>
                                    <th>alamat lengkap</th>
                                    <th>asal sekolah</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div aria-labelledby="myLargeModalLabel" aria-modal="true" class="modal fade modal-form" role="dialog"
        style="padding-right: 17px;" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title h4" id="myLargeModalLabel">Filter</h6>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="get">
                        <div class="form-group">
                            <label for="nuptk">Thun Ajaran:</label>
                            <select class="form-control" id="" name="tahun_ajaran">
                                <option value="2023/2024">2023/2024</option>
                                <option value="2022/2023">2022/2023</option>
                                <option value="2021/2022">2021/2022</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nuptk">Status:</label>
                            <select class="form-control" id="" name="status">
                                <option value="valid">Valid</option>
                                <option value="pending">Pending</option>
                                <option value="reject">Tolak</option>
                            </select>
                        </div>
                        <div class="flex justify-end" style="width: 100%">
                            <button class="btn btn-primary bg-blue-500 w-[200px]" type="submit">Submit</button>
                        </div>
                    </form>
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
    <script>
        const tahun_ajaran = "2023";

        function safeJsonStringify(obj) {
            try {
                return JSON.stringify(obj);
            } catch (error) {
                console.error('Error in safeJsonStringify:', error);
                return '{}'; // Mengembalikan objek kosong jika parsing gagal
            }
        }
        // Get the current URL

        let URI = "/register-siswa/show-data?";
        const urlString = window.location.href;
        const url = new URL(urlString);
        const searchParams = url.searchParams;
        const param1Value = searchParams.get('tahun_ajaran');
        const param2Value = searchParams.get('status');
        if (param1Value != null && param1Value != undefined)
            URI += `tahun_ajaran=${param1Value}&`
        if (param1Value != null && param1Value != undefined)
            URI += `status=${param2Value}&`
        const tables = new DataTable("#tables", {
            processing: true,
            serverSide: true,
            ajax: {
                url: URI,
                headers: {
                    "Accept": "application/ld+json",
                    "Content-Type": "text/json; charset=utf-8"
                },
                beforeSend: function(request) {
                    console.error(request);
                    request.setRequestHeader("Accept", 'application/ld+json');
                },
                dataSrc: function(response) {
                    localStorage.removeItem("data");
                    const data = safeJsonStringify(response.aaData);
                    localStorage.setItem('data', data);
                    return response.aaData;
                }
            },
            stripeClasses: [],
            columns: [{
                    data: 'no'
                },
                {
                    data: "nis",
                    className: 'editable'
                },
                {
                    data: "nama",
                    render: function(data, type, row) {
                        return `<a href="/register-siswa/show_detail/${row.id}" class="text-green-500">${data}</a>`
                    }
                },
                {
                    data: "tahun_ajaran",
                    className: 'editable'
                },
                {
                    data: "alamat_lengkap",
                    className: 'editable'
                },
                {
                    data: "asal_sekolah",
                    className: 'editable'
                },
                {
                    data: "status",
                    render: function(data, type, row) {
                        if (data == 'valid')
                            return `<span class="c-pill c-pill--success">${data}</span>`
                        if (data == 'pending')
                            return `<span class="c-pill c-pill--warning">${data}</span>`
                        if (data == 'invalid')
                            return `<span class="c-pill c-pill--danger">Outstanding</span>`

                    }
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        console.log(row);
                        return `<div class="flex justify-between">
                                    <a href="/register-siswa/show_update/${row.id}" class="btn btn-success btn-sm mr-1 w-[50px] data-update" data-id="${row?.id}"><i class="fa fa-edit"></i></a> 
                                    <button  class="btn btn-danger btn-sm ml-1 w-[50px] data-destroy" data-id="${row?.id}"><i class="fa fa-trash"></i></button> 
                                </div>`;
                    }
                }
            ],
        });
        $(document).on("click", ".data-destroy", function() {
            const id = $(this).data("id");
            const url = "/register-siswa/destroy/" + id;
            destory(url);
        });
    </script>
@endsection
