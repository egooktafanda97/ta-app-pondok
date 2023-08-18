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
                        <h5>BERITA</h5>
                        <div class="flex">
                            <div class="flex mr-2">
                                <input
                                    class="search-input border border-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Search" type="text">
                                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded add"
                                data-target=".bd-example-modal-lg" data-toggle="modal">
                                <i class="fas fa-plus-square"></i>
                                Add Data
                            </button>
                            <button class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-2"
                                onclick="window.print()">
                                <i class="fas fa-print"></i>
                                Print
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="w-full pb-10 pt-2">
                        <table class="display" id="tables" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 20px">No</th>
                                    <th class="w-full">Judul</th>
                                    <th class="w-[50px]">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($result as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>
                                            <div class="d-flex justify-between">
                                                <button
                                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold rounded px-3 py-1 views"
                                                    data-target=".bd-example-modal-lg-berita" data-toggle="modal"
                                                    data-url="{{ url('news/get-id/' . $item->id) }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button
                                                    class="bg-green-500 hover:bg-green-600 text-white font-bold rounded px-3 py-1 costum-edit"
                                                    data-target=".bd-example-modal-lg" data-toggle="modal"
                                                    data-url="{{ url('news/get-id/' . $item->id) }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button
                                                    class="bg-red-500 hover:bg-red-600 text-white font-bold rounded px-3 py-1 destroy"
                                                    data-url="{{ url('news/destroy/' . $item->id) }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex items-center justify-center mt-4">
                            {{ $result->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div aria-hidden="true" aria-labelledby="myLargeModalLabel" class="modal fade bd-example-modal-lg" role="dialog"
        style="display: none;" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">{{ $title ?? 'FORM' }}</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert-box"></div>
                    <form action="/news/store" data-update="false" id="form-input-data" method="POST">
                        @csrf
                        <input name="id" type="hidden">
                        <div>
                            <div class="form-group">
                                <label class="block font-bold mb-2" for="">Judul</label>
                                <input class="form-control" name="judul" placeholder="Judul Berita" type="text">
                            </div>
                            <div class="form-group">
                                <label class="block font-bold mb-2" for="">Konten</label>
                                <textarea class="summernote" data-summer="true" name="artikel"></textarea>
                            </div>
                            <div class="w-full flex justify-end items-center">
                                <button class="bg-gray-500 hover:bg-gray-600  mr-2 text-white font-bold py-2 px-4 rounded"
                                    onclick="window.location.reload()" type="button">
                                    <i class="fas fa-save"></i>
                                    Batal
                                </button>

                                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
                                    data-target=".bd-example-modal-lg" data-toggle="modal">
                                    <i class="fas fa-save"></i>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div aria-hidden="true" aria-labelledby="myLargeModalLabel" class="modal fade bd-example-modal-lg-berita" role="dialog"
        style="display: none;" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="titles">...</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="articles"></div>
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


        $(document).on("click", ".costum-edit", function() {
            const id = $(this).data("id");
            $("#id").val(id);
            const reQuesset = async (url) => {
                try {
                    const response = await axios.get(url);
                    const {
                        id,
                        judul,
                        artikel,
                    } = response?.data?.data ?? {};
                    $(`[name='id']`).val(id);
                    $(`[name='judul']`).val(judul);
                    $(`[name='artikel']`).summernote('code', artikel);
                    $("#form-input-data").attr("action", "/news/update/" + id)
                } catch (e) {
                    console.log(e.response?.data?.message || "Server error");
                }
            }
            const url = $(this).data("url");
            reQuesset(url);
        })

        $(".views").click(function() {
            const reQuesset = async (url) => {
                try {
                    const response = await axios.get(url);
                    const {
                        id,
                        judul,
                        artikel,
                    } = response?.data?.data ?? {};
                    $("#titles").html(judul);
                    $("#articles").html(artikel);
                } catch (e) {
                    console.log(e.response?.data?.message || "Server error");
                }
            }
            const url = $(this).data("url");
            reQuesset(url);
        });
    </script>
@endsection
