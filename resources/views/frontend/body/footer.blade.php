@php
    $setting = App\Models\SiteSetting::first();
@endphp

<footer class="footer-area footer-bg">
    <div class="container">
        <div class="footer-top pt-100 pb-70">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index.html">
                                <img src="{{ asset($setting?->imageUrl()) }}" width="92" alt="Images">
                            </a>
                        </div>
                        <ul class="footer-list-contact">
                            <li>
                                <i class='bx bx-home-alt'></i>
                                <a href="#">{{ $setting?->address }}</a>
                            </li>
                            <li>
                                <i class='bx bx-phone-call'></i>
                                <a href="tel:{{ $setting?->phone }}">{{ $setting?->phone }}</a>
                            </li>
                            <li>
                                <i class='bx bx-envelope'></i>
                                <a href="mailto:{{ $setting?->email }}">{{ $setting?->email }}</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget pl-5">
                        <h3>Links</h3>
                        <ul class="footer-list">
                            <li>
                                <a href="{{ url('/about') }}" target="_blank">
                                    <i class='bx bx-caret-right'></i>
                                    About Us
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h3>Useful Links</h3>
                        <ul class="footer-list">
                            <li>
                                <a href="{{ url('/') }}" target="_blank">
                                    <i class='bx bx-caret-right'></i>
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="gallery.html" target="_blank">
                                    <i class='bx bx-caret-right'></i>
                                    Gallery
                                </a>
                            </li>
                            <li>
                                <a href="contact.html" target="_blank">
                                    <i class='bx bx-caret-right'></i>
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <div class="copy-right-area">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="copy-right-text text-align1">
                        <p>
                            {{ $setting?->copyright }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4">
                    <div class="social-icon text-align2">
                        <ul class="social-link">
                            <li>
                                <a href="{{ $setting?->facebook }}" target="_blank"><i class='bx bxl-facebook'></i></a>
                            </li>
                            <li>
                                <a href="{{ $setting?->twitter }}" target="_blank"><i class='bx bxl-twitter'></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>