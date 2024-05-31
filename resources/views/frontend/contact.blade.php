@extends('frontend.main_master')
@section('main')
@php
    $setting = \App\Models\SiteSetting::first();
@endphp
<div class="inner-banner inner-bg2">
    <div class="container">
      <div class="inner-title">
        <ul>
          <li>
            <a href="index.html">Home</a>
          </li>
          <li>
            <i class="bx bx-chevron-right"></i>
          </li>
          <li>Contact</li>
        </ul>
        <h3>Contact</h3>
      </div>
    </div>
  </div>
  <div class="contact-area pt-100 pb-70">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-6">
          <div class="contact-content">
            <div class="section-title">
              <h2>Let's Start to Give Us a Message and Contact With Us</h2>
            </div>
            <div class="contact-img">
              <img src="{{ asset("frontend/assets/img/contact/contact-img1.jpg") }}" alt="Images">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="contact-another pb-70">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="contact-another-content">
            <div class="section-title">
              <h2>Contacts Info</h2>
              <p> We are one of the best agency and we can easily make a contract us anytime on the below details. </p>
            </div>
            <div class="contact-item">
              <ul>
                <li>
                  <i class="bx bx-home-alt"></i>
                  <div class="content">
                    <span>{{ $setting?->address }}</span>
                  </div>
                </li>
                <li>
                  <i class="bx bx-phone-call"></i>
                  <div class="content">
                    <span>
                      <a href="tel:{{ $setting?->phone }}">{{ $setting?->phone }}</a>
                    </span>
                  </div>
                </li>
                <li>
                  <i class="bx bx-envelope"></i>
                  <div class="content">
                    <span>
                      <a href="{{ $setting?->email }}">
                        <span class="__cf_email__" data-cfemail="1c75727a735c7d68737075327f7371">[email&#160;protected]</span>
                      </a>
                    </span>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="contact-another-img">
            <img src="{{ asset("frontend/assets/img/contact/contact-img2.jpg") }}" alt="Images">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="map-area">
    <div class="container-fluid m-0 p-0">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.8431306352195!2d120.46414627504937!3d-8.611055391434538!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2db374384574ce23%3A0x5bc2c428f142c8e3!2sRanaka%20Hotel%20RedPartner!5e0!3m2!1sen!2sid!4v1717159560117!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
@endsection