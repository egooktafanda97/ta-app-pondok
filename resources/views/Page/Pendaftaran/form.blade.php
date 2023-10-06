@extends('template.layout')
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="flex justify-start">
                        <h1 class="text-white text-bold" style="font-size: 1.5em">FORMULIR PENDAFTARAN</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <form action="/register-siswa/store" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h1>DATA SANTRI</h1>
                    </div>
                    <div class="card-body">
                        <div class="w-full pb-10 pt-2">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nis">NIS:</label>
                                        <input class="form-control" id="nis" maxlength="5" name="nis"
                                            type="text">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap:</label>
                                        <input class="form-control" id="nama_lengkap" name="nama_lengkap" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin:</label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="Laki-Laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir:</label>
                                        <input class="form-control" id="tempat_lahir" name="tempat_lahir" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir:</label>
                                        <input class="form-control" id="tanggal_lahir" name="tanggal_lahir" type="date">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="agama">Agama:</label>
                                        <select class="form-control" id="agama" name="agama">
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="tahun_ajaran">Tahun Ajaran</label>
                                        <input class="form-control" id="tahun_ajaran" name="tahun_ajaran" readonly
                                            type="text" value="2023/2024">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="asal_sekolah">Asal Sekolah</label>
                                        <input class="form-control" id="asal_sekolah" name="asal_sekolah" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat_lengkap">Alamat Lengkap:</label>
                                <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="3"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="orang_tua_checkbox">Orang Tua sudah ada :</label>
                                        <input type="checkbox" id="orang_tua_checkbox">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6" id="orang_tua_id" style="display:none;">
                                    <div class="form-group">
                                        <label for="orang_tua_id">Orang Tua:</label>
                                        <select class="form-control w-full" id="orang_tua_id" name="orang_tua_id">
                                            <option value="">-- Pilih Orang Tua --</option>
                                            @foreach ($orangtua as $orangtua)
                                                <option value="{{ $orangtua->id }}">{{ $orangtua->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="ortu_telepon">Lampiran:</label>
                                    <div><small><i class="text-green-500">lampiran berupa scann (SKL/Ijazah) dan syarat
                                                lainnya</i></small></div>
                                    <input class="form-control" id="lampiran" name="lampiran" type="file">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card orang_tua" id="orang_tua_section">
                    <div class="card-header">
                        <h1>DATA ORANGTUA</h1>
                    </div>
                    <div class="card-body">
                        <div class="w-full pb-10 pt-2">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="ortu_nik">NIK:</label>
                                        <input class="form-control" id="ortu_nik" name="ortu_nik" type="text">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="ortu_nama">Nama:</label>
                                        <input class="form-control" id="ortu_nama" name="ortu_nama" type="text">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="ortu_jenis_kelamin">Jenis Kelamin:</label>
                                        <select class="form-control" id="ortu_jenis_kelamin" name="ortu_jenis_kelamin">
                                            <option value="Laki-Laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="ortu_tempat_lahir">Tempat Lahir:</label>
                                        <input class="form-control" id="ortu_tempat_lahir" name="ortu_tempat_lahir"
                                            type="text">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="ortu_tanggal_lahir">Tanggal Lahir:</label>
                                        <input class="form-control" id="ortu_tanggal_lahir" name="ortu_tanggal_lahir"
                                            type="date">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="ortu_telepon">Telepon:</label>
                                        <input class="form-control" id="ortu_telepon" name="ortu_telepon"
                                            type="text">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="alamat_lengkap">Alamat Lengkap:</label>
                                        <textarea class="form-control" id="ortu_alamat_lengkap" name="ortu_alamat_lengkap" rows="3"></textarea>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="form-group w-full flex justify-end">
                        <button class="w-50 btn btn-primary bg-blue-500" type="submit">DAFTAR</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
        const URI = "/pengasuh/show-data";
        // const tables = new DataTable("#tables", {
        //     processing: true,
        //     serverSide: true,
        //     ajax: {
        //         url: URI,
        //         headers: {
        //             "Accept": "application/ld+json",
        //             "Content-Type": "text/json; charset=utf-8"
        //         },
        //         beforeSend: function(request) {
        //             console.error(request);
        //             request.setRequestHeader("Accept", 'application/ld+json');
        //         },
        //         dataSrc: function(response) {
        //             localStorage.removeItem("data");
        //             const data = safeJsonStringify(response.aaData);
        //             localStorage.setItem('data', data);
        //             return response.aaData;
        //         }
        //     },
        //     stripeClasses: [],
        //     columns: [{
        //             data: 'no'
        //         },
        //         {
        //             data: "nama",
        //             className: 'editable'
        //         },
        //         {
        //             data: "jenis_kelamin"
        //         },
        //         {
        //             data: "tempat_lahir"
        //         },
        //         {
        //             data: "tanggal_lahir"
        //         },
        //         {
        //             data: "alamat_lengkap"
        //         },
        //         {
        //             data: "jabatan"
        //         },
        //         {
        //             data: "telepon"
        //         },
        //         {
        //             data: null,
        //             render: function(data, type, row) {
        //                 console.log(row);
        //                 return `<div class="flex justify-between">
    //                             <button data-target=".modal-form" data-toggle="modal" class="btn btn-success btn-sm mr-1 w-[50px] data-update" data-id="${row?.id}"><i class="fa fa-edit"></i></button> 
    //                             <button  class="btn btn-danger btn-sm ml-1 w-[50px] data-destroy" data-id="${row?.id}"><i class="fa fa-trash"></i></button> 
    //                         </div>`;
        //             }
        //         }
        //     ],
        // });

        $(document).on("click", ".data-update", function() {
            try {
                const id = $(this).data("id");
                const InMemory = localStorage.getItem('data');
                if (InMemory) {
                    const parsedObject = JSON.parse(InMemory);
                    const selectedData = parsedObject.find(item => item.id === id);

                    if (selectedData) {
                        $('#nama').val(selectedData.nama);
                        $('#jenis_kelamin').val(selectedData.jenis_kelamin);
                        $('#tempat_lahir').val(selectedData.tempat_lahir);
                        $('#tanggal_lahir').val(selectedData.tanggal_lahir);
                        $('#alamat_lengkap').val(selectedData.alamat_lengkap);
                        $('#jabatan').val(selectedData.jabatan);
                        $('#email').val(selectedData.user.email);
                        $('#telepon').val(selectedData.telepon);
                        //untuk pasword tidak di edit disini
                        $("#form-entry").attr("action", "/pengasuh/update/" + id);
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
            const url = "/pengasuh/destroy/" + id;
            destory(url);
        });
    </script>
     <script>
        $(document).ready(function () {
            $('#orang_tua_checkbox').change(function () {
                if (this.checked) {
                    $('#orang_tua_section').hide();
                    $('#orang_tua_id').show();
                    
                } else {
                    $('#orang_tua_section').show();
                    $('#orang_tua_id').hide();
                }
            });
        });
    </script>
@endsection
