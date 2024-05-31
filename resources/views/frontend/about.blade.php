@extends('frontend.main_master')
@section('main')
<div class="inner-banner inner-bg1">
    <div class="container">
      <div class="inner-title">
        <ul>
          <li>
            <a href="{{ url('/') }}">Home</a>
          </li>
          <li>
            <i class="bx bx-chevron-right"></i>
          </li>
          <li>About Us</li>
        </ul>
        <h3>About Us</h3>
      </div>
    </div>
  </div>
<!-- Banner Area End -->
<div class="about-area pt-100 pb-70">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-6">
          <div class="about-img">
            <img src="{{ asset('frontend/assets/img/about/about-img3.jpg') }}" alt="Images">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-content">
            <div class="section-title">
              <h2>Sekilas Tentang Hotel Ranaka Ruteng</h2>
              <p>Hotel Ranaka Ruteng merupakan Hotel bintang 1 yang berlokasi di Jln. Yos Sudarso No. 2, Kel. Mbaumuku, Kec. Langke Rembong, Ruteng, Manggarai, Nusa Tenggara Timur, Indonesia.</p>
              <p>Lokasi hotel sangat strategis karena hanya berjarak 1,92 km dengan Bandar Udara Frans Sales Lega (RUTENG). Hotel Ranaka merupakan hotel rekomendasi untuk para</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection