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

    <div class="container my-5">
        <h2>e-hotel</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit, ipsum. Ipsam, non expedita? Iure dolorem consequuntur blanditiis cupiditate dolore veniam deserunt nobis consequatur velit necessitatibus, ullam consectetur. Recusandae, eius consectetur.</p>

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
                                    <span class="text-muted">0.0</span>
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
        <a href="#" class="text-decoration-none text-center">
            <h5>Show more >></h5>
        </a>
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
        </script>
    @endpush
@endsection
