@php
    $setting = App\Models\SiteSetting::first();
@endphp


<div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ $setting?->imageUrl() }}" width="120" class="logo-one" alt="Logo">
            <img src="{{ $setting?->imageUrl() }}" width="120" class="logo-two" alt="Logo">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light ">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ $setting?->imageUrl() }}" width="120" class="logo-one" alt="Logo">
                    <img src="{{ $setting?->imageUrl() }}" width="120" class="logo-two" alt="Logo">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link {{ (url()->current() === env('APP_URL')) ? 'active':'' }}">
                                Home
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/about') }}" class="nav-link {{ (Str::contains(url()->current(), 'about')) ? 'active':'' }}">
                                About
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/gallery') }}" class="nav-link">
                              Gallery
                            </a>

                        </li>
    @php
        $room = App\Models\Room::latest()->get();
    @endphp
                        <li class="nav-item">
                            <a href="{{ route('froom.all') }}" class="nav-link">
                                All Rooms
                                <i class='bx bx-chevron-down'></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($room  as $item)
                                <li class="nav-item">
                                    <a href="{{ url('room/details/'.$item->id) }}" class="nav-link">
                                        {{ $item['type']['name'] }}
                                    </a>
                                </li>
                                @endforeach

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>