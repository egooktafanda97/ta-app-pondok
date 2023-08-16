@extends('layouts.app')
@section('style')
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/heroicons@1.0.4/dist/css/heroicons.min.css" rel="stylesheet">
    <link href="{{ asset('plugins/summernote/summernote-lite.css') }}" rel="stylesheet">
    <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        referrerpolicy="no-referrer" rel="stylesheet" />

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
                        <h5>Tentang</h5>
                        <div class="flex">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                                id="save">
                                <i class="fas fa-save"></i>
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="w-full pb-10 pt-2">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="block font-bold mb-2" for="kontak_email">Kontak Email</label>
                                    <input class="form-control" name="kontak_email" placeholder="Kontak Email"
                                        type="email">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="block font-bold mb-2" for="kontak_telepon">Kontak Telepon</label>
                                    <input class="form-control" name="kontak_telepon" placeholder="Kontak Telepon"
                                        type="tel">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="block font-bold mb-2" for="alamat">Alamat</label>
                                    <textarea class="form-control" name="alamat" placeholder="Alamat"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="block font-bold mb-2" for="kontak_telepon">Logo</label>
                                    <input class="form-control" name="logo" type="file">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="block font-bold mb-2" for="kontak_telepon">Banner</label>
                                    <input class="form-control" name="banner" type="file">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="block font-bold mb-2" for="tentang">Tentang</label>
                                    <textarea class="form-control summernote" name="tentang" placeholder="Tentang"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="block font-bold mb-2" for="manfaat">Manfaat</label>
                                    <textarea class="form-control summernote" name="manfaat" placeholder="Manfaat"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="block font-bold mb-2" for="tujuan">Tujuan</label>
                                    <textarea class="form-control summernote" name="tujuan" placeholder="Tujuan"></textarea>
                                </div>
                            </div>

                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            const reQuesset = async (url) => {
                try {
                    const response = await axios.get(url);

                    const {
                        kontak_email,
                        kontak_telepon,
                        alamat,
                        tentang,
                        manfaat,
                        tujuan,
                    } = response?.data?.data ?? {};
                    $(`[name='kontak_email']`).val(kontak_email)
                    $(`[name='kontak_telepon']`).val(kontak_telepon)
                    $(`[name='alamat']`).val(alamat)
                    $(`[name='tentang']`).summernote("code", tentang);
                    $(`[name='manfaat']`).summernote("code", manfaat);
                    $(`[name='tujuan']`).summernote("code", tujuan);
                } catch (e) {
                    console.log(e.response?.data?.message || "Server error");
                }
            }
            const id = `{{ empty($result->id) ? null : $result->id }}`;
            if (id != '' || id != undefined || id != null || id != 'null') {
                const url = `{{ url('about/get-id') }}/${id}`
                reQuesset(url);
            } else {
                return;
            }
        });


        $('#tables').DataTable({
            searching: false, // Menonaktifkan fitur pencarian
            paging: false, // Menonaktifkan paginasi
            info: false, // Menonaktifkan informasi jumlah data
            // scrollY: '50vh',
            // scrollCollapse: true,
        });
        $(".summernote").summernote({
            tabsize: 2,
            height: "40vh",
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

        const UpPost = async (param) => {
            const {
                url,
                data,
                success,
                error
            } = param;
            try {
                const response = await axios.post(url, data);

                if (response?.data?.message ?? false) {
                    success(response.data);
                    return;
                }
                toastr.error("server error", "Error");
            } catch (e) {
                if (axios.isAxiosError(e)) {
                    error({
                        title: "error",
                        message: e.response?.data?.message,
                    });
                    if (Array.isArray(e.response?.data)) {
                        e.response?.data.forEach((errorItem) => {
                            toastr.error(JSON.stringify(errorItem), "Error");
                        });
                    } else {

                        toastr.error(
                            e.response?.data?.message ?? "action error",
                            "Error"
                        );
                    }
                } else {
                    toastr.error("server error", "Error");
                }
            }
        };

        $("#save").click(function() {
            const form_data = new FormData();
            ['tentang', 'manfaat', 'tujuan', 'kontak_email', 'kontak_telepon', 'alamat', 'banner', 'logo'].map((
                x) => {
                if (x == 'banner' || x == 'logo')
                    form_data.append(x, $(`[name='${x}']`)[0].files[0])
                form_data.append(x, $(`[name='${x}']`).val());
            });
            let url = `{{ url('about/store/') }}`
            const id = `{{ empty($result->id) ? null : $result->id }}`;
            if (id != '' || id != undefined || id != null || id != 'null')
                url = `{{ url('about/store') }}/${id}`
            const props = {
                url: url,
                data: form_data,
                success: (res) => {
                    toastr.success("Data berhasil disimpan", "Success");
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                },
                error: () => {

                }
            }

            UpPost(props);

        });
    </script>
@endsection
