@extends('layout.template')
@section('title', $title)
@section('content')
    <div class="swiper swiper-banner">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="https://cdn.discordapp.com/attachments/329112994258747392/881524424329814066/1110x350.png" alt="banner" style="width: 100%">
            </div>
            <div class="swiper-slide">
                <img src="https://cdn.discordapp.com/attachments/329112994258747392/881524424329814066/1110x350.png" alt="banner" style="width: 100%">
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
        </script>
    @endpush
@endsection
