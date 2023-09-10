@extends('template.layout')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="flex justify-between">
                        <h1 class="text-white text-bold" style="font-size: 1.5em">DATA HAFALAN SANTRI</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card" id="card-hafalan">
                <div class="card-body">
                    <div class="card-header">
                        <div class="flex justify-end">
                            @php
                                $baseURL = '/hafalan/laporan/' . $santri->id;
                            @endphp
                            <a class="btn btn-primary" href="{{ $baseURL }}" style="color:#111" target="_blank"
                                type="button">
                                <i class="fa fa-print"></i> LAPORAN</a>
                        </div>
                    </div>
                    <div class="w-full pb-10 pt-2">
                        <table class="display responsive nowrap" id="tables" style="width:100%">
                            <thead class="bg-gray-100 text-gray-500 shadow-md">
                                <tr>
                                    <th class="w-[25px]">No</th>
                                    <th>Nama Siswa</th>
                                    <th>Nama Guru</th>
                                    <th>Tanggal</th>
                                    <th>Juz</th>
                                    <th>Surat</th>
                                    <th>Mulai Ayat</th>
                                    <th>Sampai Ayat</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                            <tfoot class="bg-gray-100 text-gray-500 shadow-md">
                                <tr>
                                    <th class="w-[25px]">No</th>
                                    <th>Nama Siswa</th>
                                    <th>Nama Guru</th>
                                    <th>Tanggal</th>
                                    <th>Juz</th>
                                    <th>Surat</th>
                                    <th>Mulai Ayat</th>
                                    <th>Sampai Ayat</th>
                                    <th>Catatan</th>
                                </tr>
                            </tfoot>
                        </table>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const segment = `{{ $santri->id ?? '' }}`


        function safeJsonStringify(obj) {
            try {
                return JSON.stringify(obj);
            } catch (error) {
                console.error('Error in safeJsonStringify:', error);
                return '{}';
            }
        }

        $("#btn-hafalan").click(function() {
            $("#juz").val("");
            $("#nama_surat").val("");
            $("#ayat_start").val("");
            $("#ayat_end").val("");
            $("#catatan").val("");
            $("#form-entry").attr("action", "/hafalan/store");
        })

        let UrlId = "/hafalan/siswa-hafalan-show/";
        const tables = new DataTable("#tables", {
            processing: true,
            serverSide: true,
            ajax: {
                url: UrlId,
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
                    data: 'nama_siswa'
                },
                {
                    data: 'nama_guru'
                },
                {
                    data: 'tanggal'
                },
                {
                    data: 'juz'
                },
                {
                    data: 'nama_surat'
                },
                {
                    data: 'ayat_start'
                },
                {
                    data: 'ayat_end'
                },
                {
                    data: 'catatan'
                }
            ],
        });



        if (segment != undefined && segment != "" && segment != "undefined" && segment != null) {
            UrlId = "/hafalan/siswa-hafalan-show/" + segment;
            $("#card-hafalan").removeClass("hidden");
            $("#btn-hafalan").removeClass("hidden");
            $("[name='siswa_id']").val(segment);
            tables.ajax.url(UrlId).load();
        }



        $(document).on("click", ".data-update", function() {
            try {
                const id = $(this).data("id");
                const InMemory = localStorage.getItem('data');
                if (InMemory) {
                    const parsedObject = JSON.parse(InMemory);
                    const selectedData = parsedObject.find(item => item.id === id);
                    if (selectedData) {
                        $("[name='siswa_id']").val(selectedData.siswa.id);
                        $("#juz").val(selectedData?.juz);
                        $("#nama_surat").val(selectedData?.nama_surat);
                        $("#ayat_start").val(selectedData?.ayat_start);
                        $("#ayat_end").val(selectedData?.ayat_end);
                        $("#catatan").val(selectedData?.catatan);
                        $("#form-entry").attr("action", "/hafalan/update/" + id);
                    } else {
                        toastr.info('Data dengan ID tersebut tidak ditemukan.');
                    }
                } else {
                    toastr.info('Data tidak tersedia di dalam memori.');
                }
            } catch (error) {
                toastr.info('aksi gagal?')
            }
        })
        $(document).on("click", ".data-destroy", function() {
            const id = $(this).data("id");
            const url = "/hafalan/destroy/" + id;
            destory(url);
        });

        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            // $('.js-juz').select2();
            // $('.js-surat').select2();
        });
    </script>
@endsection
