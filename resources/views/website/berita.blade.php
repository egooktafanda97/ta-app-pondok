@extends('website.layouts')

@section('content')
    <!-- Blog Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Blog list Start -->
                <div class="col-lg-12">
                    <div class="row g-5">
                        @foreach ($result as $item)
                            <div class="col-md-6 wow slideInUp" data-wow-delay="0.1s">
                                <div class="blog-item bg-light rounded overflow-hidden">
                                    {{-- <div class="blog-img position-relative overflow-hidden">
                                        <img class="img-fluid" src="img/berita-1.jpg" alt="">
                                        <a class="position-absolute top-0 start-0 bg-primary text-white rounded-end mt-5 py-2 px-4"
                                            href="">Web Design</a>
                                    </div> --}}
                                    <div class="p-4">
                                        <div class="d-flex mb-3">
                                            <small><i
                                                    class="far fa-calendar-alt text-primary me-2"></i>{{ $item->created_at }}</small>
                                        </div>
                                        <h4 class="mb-3">{{$item->judul}}</h4>
                                        {{-- <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p> --}}
                                        <a class="text-uppercase" href="{{ url('berita/beritaview/' . $item->id) }}">Read More <i
                                                class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <!-- Blog list End -->

            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
