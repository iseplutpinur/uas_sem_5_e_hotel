@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="swiper swiper-banner">
        <div class="swiper-wrapper">
            @if ($banners)
                @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <img src="{{ asset('images/banners-photo/' . $banner->photo) }}" alt="banner" style="width: 100%">
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="container my-3">
        <h2>e-hotel</h2>
        <p>e-hotel, salah satu hotel terbaik di Kota Batam yang dekat dengan pusat kota dan tempat berbelanja. Didukung dengan tempat spa lengkap, kolam renang, serta kamar super nyaman akan membuat liburan Anda semakin menyenangkan.</p>

        <h4 class="text-center mt-5">Room</h4>
        <div class="row">
            @foreach ($room_categories as $room_category)
                <div class="col-md-4">
                    <a href="{{ route('detail', ['room_category' => $room_category->name]) }}" class="text-decoration-none">
                        <div class="card">
                            @if ($room_category->cover)
                                <img src="{{ asset('images/room_categories-photo/' . $room_category->cover) }}" class="card-img-top p-2 border-bottom" width="100%" height="220px">
                            @else
                                <img src="{{ asset('images/default.png') }}" class="card-img-top p-2 border-bottom" width="100%" height="220px">
                            @endif
                            <div class="card-img-overlay p-1">
                                <span class="badge rounded-pill bg-danger">Promo</span>
                            </div>
                            <div class="card-body">
                                <div class="text-end">
                                    <i class="fas fa-star" style="color: #ffc800;"></i>
                                    <span class="text-muted">{{ round($room_category->rating->avg('star'), 1) }}</span>
                                </div>
                                <p class="mb-0 text-dark small">*start from</p>
                                <h5 class="mb-0">Rp. {{ number_format($room_category->price) }} /Night</h5>
                                <p class="m-0 text-muted">{{ $room_category->name }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <h4 class="text-center mt-5 mb-3">Our Facility</h4>
        <div class="d-none d-md-block d-lg-block d-xl-block">
            <div class="swiper swiper-facility">
                <div class="swiper-wrapper">
                    @foreach ($facilities as $facility)
                        <div class="swiper-slide">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-2">
                                            <i class="{{ $facility->icon }} fa-2x"></i>
                                        </div>
                                        <div class="col-10">
                                            <h5>{{ $facility->name }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="d-md-none d-lg-none d-xl-none">
            <div class="swiper swiper-facility">
                <div class="swiper-wrapper">
                    @foreach ($facilities as $facility)
                        <div class="swiper-slide">
                            <div class="card shadow">
                                <div class="card-body">
                                    <i class="{{ $facility->icon }} fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            var swiper = new Swiper('.swiper-banner', {
                slidesPerView: 1.1,
                spaceBetween: 10,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                }
            });

            var swiper = new Swiper(".swiper-facility", {
                slidesPerView: 3,
                spaceBetween: 30,
                freeMode: true,
                autoplay: {
                    delay: 2000,
                    disableOnInteraction: false,
                }
            });
        </script>
    @endpush
@endsection
