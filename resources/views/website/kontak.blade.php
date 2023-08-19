@extends('website.layouts')

@section('content')
 <!-- Contact Start -->
 <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
  <div class="container py-5">
      <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
          <h5 class="fw-bold text-primary text-uppercase">Kontak kami</h5>
          <h1 class="mb-0">Jika Anda Memiliki Pertanyaan, Jangan Ragu Untuk Menghubungi Kami</h1>
      </div>
      <div class="row g-5 mb-5">
          <div class="col-lg-4">
              <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.1s">
                  <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                      <i class="fa fa-phone-alt text-white"></i>
                  </div>
                  <div class="ps-4">
                      <h5 class="mb-2">Telepon</h5>
                      <h4 class="text-primary mb-0">-</h4>
                  </div>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.4s">
                  <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                      <i class="fa fa-envelope-open text-white"></i>
                  </div>
                  <div class="ps-4">
                      <h5 class="mb-2">Email</h5>
                      <h4 class="text-primary mb-0">-</h4>
                  </div>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="d-flex align-items-center wow fadeIn" data-wow-delay="0.8s">
                  <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                      <i class="fa fa-map-marker-alt text-white"></i>
                  </div>
                  <div class="ps-4">
                      <h5 class="mb-2">Alamat</h5>
                      <h4 class="text-primary mb-0">-</h4>
                  </div>
              </div>
          </div>
      </div>
      <div class="row g-5">
          <div class="col-lg-6 wow slideInUp" data-wow-delay="0.3s">
              <form>
                  <div class="row g-3">
                      <div class="col-md-6">
                          <input type="text" class="form-control border-0 bg-light px-4" placeholder="Your Name" style="height: 55px;">
                      </div>
                      <div class="col-md-6">
                          <input type="email" class="form-control border-0 bg-light px-4" placeholder="Your Email" style="height: 55px;">
                      </div>
                      <div class="col-12">
                          <input type="text" class="form-control border-0 bg-light px-4" placeholder="Subject" style="height: 55px;">
                      </div>
                      <div class="col-12">
                          <textarea class="form-control border-0 bg-light px-4 py-3" rows="4" placeholder="Message"></textarea>
                      </div>
                      <div class="col-12">
                          <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                      </div>
                  </div>
              </form>
          </div>
          <div class="col-lg-6 wow slideInUp" data-wow-delay="0.6s">
              <iframe class="position-relative rounded w-100 h-100"
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.645930818627!2d101.56871587481125!3d-0.5326207352664674!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2a4c3546d97e11%3A0xe0fad5fde624a92b!2sTaman%20Jalur!5e0!3m2!1sid!2sid!4v1691678540592!5m2!1sid!2sid"
                  frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                  tabindex="0"></iframe>
          </div>
      </div>
  </div>
</div>
<!-- Contact End -->

@endsection
