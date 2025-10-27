{{--
  Template Name: Front Page
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <div class="snap-y snap-mandatory overflow-y-scroll h-screen">
        <section
            class="snap-always snap-center relative min-h-screen flex items-center justify-center bg-[#0b0b0b] text-white pb-20"
            style="background-image: url('{{ $main['hero']['hero_background'] }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="absolute bottom-0 left-0 right-0 hidden lg:block">
                @include('sections.header')
            </div>
        </section>
        <section class="snap-always snap-center bg-[#0F0F0F] text-white relative overflow-hidden"
            style="--gold: {{ $main['settings']['gold_color'] }};">
            <div class="container mx-auto px-4 md:px-8 min-h-screen flex items-center" data-animate="fadeIn">
                <div class="grid md:grid-cols-2 gap-10 lg:gap-16 items-center">
                    <div data-animate="slideInLeft" data-delay="200">
                        <h1 class="heading-1 text-[var(--gold)] pt-10">
                            {{ $main['hero']['title'] }}</h1>

                        <div class="space-y-5 font-light text-lg tracking-wider text-[#B3B3B3]">
                            <p>{!! $main['hero']['description'] !!}</p>
                        </div>
                        <div class="flex flex-col md:flex-row mt-10 gap-6 md:gap-20">
                            <h2 class="heading-2 text-nowrap text-[var(--gold)]">
                                {{ $main['hero']['salon_title'] }}</h2>
                            <div>
                                <div class="font-light text-lg tracking-wider text-[#B3B3B3]">
                                    {{ $main['hero']['salon_description'] }}
                                </div>
                                <div class="mt-6 flex items-start gap-3 text-white/70 text-lg font-semibold">
                                    <svg class="w-5 h-full pt-1 shrink-0 text-[#d1b07a]" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor">
                                        <circle cx="12" cy="12" r="9" stroke-width="1.5" />
                                        <path d="M12 7v5l3 2" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                    {!! $main['hero']['opening_hours'] !!}
                                </div>
                            </div>
                        </div>

                        <a href="{{ $main['hero']['hero_button_url'] }}"
                            class="uppercase mt-10 w-full inline-flex items-center justify-center border-2 border-[var(--gold)] px-6 py-6 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                            {{ $main['hero']['hero_button_text'] }}
                        </a>
                    </div>

                    <div class="relative" data-animate="slideInRight" data-delay="400">
                        <img src="{{ $main['hero']['hero_image'] }}" alt=""
                            class="w-full h-auto object-contain md:max-h-screen">
                    </div>
                </div>
            </div>
        </section>

        <section
            class="snap-always snap-center bg-black min-h-fit md:min-h-screen content-center text-white flex items-center">
            <div class="mb-10" data-animate="slideUp">
                <div class="md:hidden">
                    <div class="relative overflow-hidden">
                        <div id="tiles-carousel" class="flex transition-transform duration-300 ease-in-out">
                            @foreach ($main['tiles'] as $index => $tile)
                                <div class="w-full flex-shrink-0 px-2">
                                    <figure class="relative group overflow-hidden !m-0 bg-black ring-1 ring-white/10 mx-2">
                                        <img src="{{ $tile['src'] }}" alt="{{ $tile['label'] }}"
                                            class="h-full min-h-[462px] w-full object-cover aspect-[4/3] grayscale group-hover:grayscale-0 transition duration-300" />
                                        <figcaption class="pointer-events-none absolute inset-x-0 bottom-6">
                                            <span
                                                class="flex justify-center text-xs font-semibold uppercase tracking-wide">{{ $tile['label'] }}</span>
                                        </figcaption>
                                        <a href="{{ $tile['href'] }}" class="absolute inset-0"
                                            aria-label="{{ $tile['label'] }}"></a>
                                    </figure>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-center mt-4 space-x-2">
                        @foreach ($main['tiles'] as $index => $tile)
                            <button
                                class="tiles-carousel-dot w-4 h-0.5 rounded-full transition-colors {{ $index === 0 ? 'bg-[#d1b07a]' : 'bg-white/30' }} hover:bg-[#d1b07a]/70"
                                data-slide="{{ $index }}"></button>
                        @endforeach
                    </div>
                </div>
                <div class="hidden md:grid grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-0.5" data-stagger="150">
                    @foreach ($main['tiles'] as $tile)
                        <figure class="relative group overflow-hidden !m-0 bg-black ring-1 ring-white/10"
                            data-animate="scaleIn">
                            <img src="{{ $tile['src'] }}" alt="{{ $tile['label'] }}"
                                class="h-full min-h-[400px] w-full object-cover aspect-[4/3] grayscale group-hover:grayscale-0 transition duration-300" />
                            <figcaption class="pointer-events-none absolute inset-x-0 bottom-10">
                                <span
                                    class="flex justify-center text-[11px] md:text-xs font-semibold uppercase tracking-wide">{{ $tile['label'] }}</span>
                            </figcaption>
                            <a href="{{ $tile['href'] }}" class="absolute inset-0" aria-label="{{ $tile['label'] }}"></a>
                        </figure>
                    @endforeach
                </div>

                <div class="container mx-auto px-4 md:px-8" data-animate="fadeIn" data-delay="800">
                    <a href="{{ $main['gallery']['button_url'] }}"
                        class="mt-6 w-full uppercase inline-flex items-center justify-center border-2 border-[#d1b07a] px-6 py-6 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                        {{ $main['gallery']['button_text'] }}
                    </a>
                </div>
            </div>
        </section>
        <section
            class="snap-always snap-center bg-[#0F0F0F] content-center text-white flex justify-center min-h-screen py-16"
            style="--gold: #d1b07a;">
            <div class="container mx-auto px-4 md:px-8" data-animate="fadeIn">
                <div class="grid md:grid-cols-2 gap-10 items-center h-full">
                    <div data-animate="slideInLeft" data-delay="200">
                        <h2 class="heading-1 text-[var(--gold)] mb-8">
                            {{ $main['testimonials']['title'] }}</h2>
                        <div class="hidden md:block space-y-6 md:space-y-10 text-white/50">
                            @foreach ($main['testimonials']['testimonials'] as $testimonial)
                                <div>
                                    <p class="text-lg text-[#B3B3B3]">{{ $testimonial['text'] }}</p>
                                    <div class="mt-3 uppercase tracking-wide text-white font-semibold">
                                        {{ $testimonial['name'] }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="md:hidden">
                            <div id="testimonials-carousel" class="relative overflow-hidden">
                                <div class="flex transition-transform duration-300 ease-in-out">
                                    @foreach ($main['testimonials']['testimonials'] as $testimonial)
                                        <div class="w-full flex-shrink-0 space-y-6 text-sm text-white/50 leading-relaxed">
                                            <div>
                                                <p>{{ $testimonial['text'] }}</p>
                                                <div
                                                    class="mt-2 text-xs uppercase tracking-wide text-white/80 font-semibold">
                                                    {{ $testimonial['name'] }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex justify-center mt-4 space-x-2">
                                @foreach ($main['testimonials']['testimonials'] as $index => $testimonial)
                                    <button
                                        class="testimonials-carousel-dot w-full h-0.5 rounded-full transition-colors {{ $index === 0 ? 'bg-[#d1b07a]' : 'bg-white/30' }} hover:bg-[#d1b07a]/70"
                                        data-slide="{{ $index }}"></button>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-6 md:mt-20 flex gap-4">
                            <a href="{{ $main['testimonials']['cta_view_more_url'] }}"
                                class="w-full uppercase inline-flex items-center justify-center border-2 border-[var(--gold)] px-6 py-6 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                                @if (!empty($main['testimonials']['cta_view_more_icon']))
                                    <i class="{{ $main['testimonials']['cta_view_more_icon'] }} mr-2"></i>
                                @endif
                                {{ $main['testimonials']['cta_view_more'] }}
                            </a>
                            <a href="{{ $main['testimonials']['cta_book_now_url'] }}"
                                class="w-full uppercase inline-flex items-center justify-center border-2 border-[var(--gold)] px-6 py-6 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                                {{ $main['testimonials']['cta_book_now'] }}
                            </a>
                        </div>
                    </div>

                    <div class="aspect-[3/4] overflow-hidden ml-auto" data-animate="slideInLeft" data-delay="400">
                        <img src="{{ $main['testimonials']['image'] }}" alt="Testimonials Image">
                    </div>
                </div>
            </div>
        </section>

        <section class="snap-always snap-center bg-black flex justify-center content-center min-h-screen text-white py-20"
            style="--gold: #d1b07a;">
            <div class="h-full container mx-auto px-4 md:px-8" data-animate="slideUp">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center mb-16" data-stagger="200">
                    <div class="border border-white/20 p-6 rounded" data-animate="scaleIn">
                        <div class="body-text text-white">{{ $main['statistics']['clients']['number'] }}</div>
                        <div class="text-xs text-white mt-2 uppercase tracking-wide">
                            {{ $main['statistics']['clients']['label'] }}</div>
                    </div>
                    <div class="border border-white/20 p-6 rounded" data-animate="scaleIn">
                        <div class="body-text text-white">{{ $main['statistics']['treatments']['number'] }}</div>
                        <div class="text-xs text-white mt-2 uppercase tracking-wide">
                            {{ $main['statistics']['treatments']['label'] }}</div>
                    </div>
                    <div class="border border-white/20 p-6 rounded" data-animate="scaleIn">
                        <div class="body-text text-white">{{ $main['statistics']['experience']['number'] }}</div>
                        <div class="text-xs text-white mt-2 uppercase tracking-wide">
                            {{ $main['statistics']['experience']['label'] }}</div>
                    </div>
                    <div class="border border-white/20 p-6 rounded" data-animate="scaleIn">
                        <div class="body-text text-white">{{ $main['statistics']['products']['number'] }}</div>
                        <div class="text-xs text-white mt-2 uppercase tracking-wide">
                            {{ $main['statistics']['products']['label'] }}</div>
                    </div>
                </div>

                <div class="max-w-4xl mx-auto text-sm text-white/80 leading-relaxed md:flex gap-18" data-animate="fadeIn"
                    data-delay="800">
                    <h3 class="heading-2 text-nowrap text-[var(--gold)]">{{ $main['policy']['title'] }}
                    </h3>

                    <div class="space-y-6 font-light tracking-wider text-[#B3B3B3]">
                        @php
                            $paragraphs = preg_split('/<br><br>/', $main['policy']['paragraph']);
                        @endphp

                        @foreach ($paragraphs as $paragraph)
                            @if (!empty(trim($paragraph)))
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 shrink-0 text-[#d1b07a] mt-0.5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p>{{ strip_tags($paragraph) }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <section
            class="snap-always snap-center relative min-h-screen flex items-center justify-center bg-[#0b0b0b] text-white"
            style="background-image: url('{{ $main['cta_section']['background'] }}'); background-size: cover; background-position: center; background-repeat: no-repeat; --gold: #d1b07a;"
            data-animate="scaleIn">

            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center px-6" data-animate="fadeIn" data-delay="300">
                    <h1 class="heading-1 text-[#d1b07a] mb-10">
                        {{ $main['cta_section']['title'] }}
                    </h1>
                    <div class="flex flex-col md:flex-row justify-center gap-4" data-animate="slideUp" data-delay="600">
                        <a href="{{ $main['cta_section']['view_more_url'] }}"
                            class="uppercase inline-flex items-center justify-center border-2 border-[var(--gold)] px-20 py-6 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                            {{ $main['cta_section']['view_more_text'] }}
                        </a>
                        <a href="{{ $main['cta_section']['book_now_url'] }}"
                            class="uppercase inline-flex items-center justify-center border-2 border-[var(--gold)] px-20 py-6 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                            {{ $main['cta_section']['book_now_text'] }}
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <footer class="text-white snap-always snap-end" style="--gold: #d1b07a;">
            <section class="bg-[#0F0F0F] text-white">
                <div class="container mx-auto px-4 md:px-8 py-14 md:py-20">
                    <h2 class="text-center heading-2">{{ $main['instagram']['title'] }}</h2>

                    <!-- Mobile Carousel -->
                    <div class="md:hidden mt-10">
                        <div class="relative overflow-hidden">
                            <div id="instagram-carousel" class="flex transition-transform duration-300 ease-in-out">
                                @foreach ($main['instagram']['images'] as $index => $src)
                                    <div class="w-full flex-shrink-0 px-4">
                                        <a href="{{ $main['social']['instagram_url'] }}" class="block group">
                                            <div class="overflow-hidden bg-black ring-1 ring-white/10">
                                                <img src="{{ $src }}" alt="Instagram post {{ $index + 1 }}"
                                                    class="h-full w-full object-cover aspect-square group-hover:scale-[1.02] transition">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex justify-center mt-6 space-x-2">
                            @foreach ($main['instagram']['images'] as $index => $src)
                                <button
                                    class="instagram-carousel-dot w-full h-0.5 rounded-full transition-colors {{ $index === 0 ? 'bg-[#d1b07a]' : 'bg-white/30' }} hover:bg-[#d1b07a]/70"
                                    data-slide="{{ $index }}"></button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Desktop Grid -->
                    <div class="hidden md:grid mt-10 grid-cols-4 gap-5 md:gap-6">
                        @foreach ($main['instagram']['images'] as $src)
                            <a href="{{ $main['social']['instagram_url'] }}" class="block group">
                                <div class="overflow-hidden bg-black ring-1 ring-white/10">
                                    <img src="{{ $src }}" alt=""
                                        class="h-full w-full object-cover group-hover:scale-[1.02] transition">
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
            <section class="bg-black border-t border-white/10">
                <div class="container mx-auto px-4 py-6">
                    <div class="flex items-center justify-center gap-8 md:gap-20 lg:gap-40">
                        <a href="{{ $main['social']['facebook_url'] }}" aria-label="Facebook"
                            class="hover:text-[var(--gold)] transition p-2">
                            <svg class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M240 363.3L240 576L356 576L356 363.3L442.5 363.3L460.5 265.5L356 265.5L356 230.9C356 179.2 376.3 159.4 428.7 159.4C445 159.4 458.1 159.8 465.7 160.6L465.7 71.9C451.4 68 416.4 64 396.2 64C289.3 64 240 114.5 240 223.4L240 265.5L174 265.5L174 363.3L240 363.3z" />
                            </svg>
                        </a>
                        <a href="{{ $main['social']['instagram_url'] }}" aria-label="Instagram"
                            class="hover:text-[var(--gold)] transition p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12"
                                fill="currentColor"
                                viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M320.3 205C256.8 204.8 205.2 256.2 205 319.7C204.8 383.2 256.2 434.8 319.7 435C383.2 435.2 434.8 383.8 435 320.3C435.2 256.8 383.8 205.2 320.3 205zM319.7 245.4C360.9 245.2 394.4 278.5 394.6 319.7C394.8 360.9 361.5 394.4 320.3 394.6C279.1 394.8 245.6 361.5 245.4 320.3C245.2 279.1 278.5 245.6 319.7 245.4zM413.1 200.3C413.1 185.5 425.1 173.5 439.9 173.5C454.7 173.5 466.7 185.5 466.7 200.3C466.7 215.1 454.7 227.1 439.9 227.1C425.1 227.1 413.1 215.1 413.1 200.3zM542.8 227.5C541.1 191.6 532.9 159.8 506.6 133.6C480.4 107.4 448.6 99.2 412.7 97.4C375.7 95.3 264.8 95.3 227.8 97.4C192 99.1 160.2 107.3 133.9 133.5C107.6 159.7 99.5 191.5 97.7 227.4C95.6 264.4 95.6 375.3 97.7 412.3C99.4 448.2 107.6 480 133.9 506.2C160.2 532.4 191.9 540.6 227.8 542.4C264.8 544.5 375.7 544.5 412.7 542.4C448.6 540.7 480.4 532.5 506.6 506.2C532.8 480 541 448.2 542.8 412.3C544.9 375.3 544.9 264.5 542.8 227.5zM495 452C487.2 471.6 472.1 486.7 452.4 494.6C422.9 506.3 352.9 503.6 320.3 503.6C287.7 503.6 217.6 506.2 188.2 494.6C168.6 486.8 153.5 471.7 145.6 452C133.9 422.5 136.6 352.5 136.6 319.9C136.6 287.3 134 217.2 145.6 187.8C153.4 168.2 168.5 153.1 188.2 145.2C217.7 133.5 287.7 136.2 320.3 136.2C352.9 136.2 423 133.6 452.4 145.2C472 153 487.1 168.1 495 187.8C506.7 217.3 504 287.3 504 319.9C504 352.5 506.7 422.6 495 452z" />
                            </svg>
                        </a>
                        <a href="{{ $main['social']['tiktok_url'] }}" aria-label="TikTok"
                            class="hover:text-[var(--gold)] transition p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12"
                                fill="currentColor"
                                viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                <path
                                    d="M544.5 273.9C500.5 274 457.5 260.3 421.7 234.7L421.7 413.4C421.7 446.5 411.6 478.8 392.7 506C373.8 533.2 347.1 554 316.1 565.6C285.1 577.2 251.3 579.1 219.2 570.9C187.1 562.7 158.3 545 136.5 520.1C114.7 495.2 101.2 464.1 97.5 431.2C93.8 398.3 100.4 365.1 116.1 336C131.8 306.9 156.1 283.3 185.7 268.3C215.3 253.3 248.6 247.8 281.4 252.3L281.4 342.2C266.4 337.5 250.3 337.6 235.4 342.6C220.5 347.6 207.5 357.2 198.4 369.9C189.3 382.6 184.4 398 184.5 413.8C184.6 429.6 189.7 444.8 199 457.5C208.3 470.2 221.4 479.6 236.4 484.4C251.4 489.2 267.5 489.2 282.4 484.3C297.3 479.4 310.4 469.9 319.6 457.2C328.8 444.5 333.8 429.1 333.8 413.4L333.8 64L421.8 64C421.7 71.4 422.4 78.9 423.7 86.2C426.8 102.5 433.1 118.1 442.4 131.9C451.7 145.7 463.7 157.5 477.6 166.5C497.5 179.6 520.8 186.6 544.6 186.6L544.6 274z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
            <section class="bg-[#0b0b0b]">
                <div class="container mx-auto px-4 py-8 md:py-12 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-10 text-sm">
                    <div class="text-center md:text-left">
                        <h3 class="text-xs tracking-wider font-semibold uppercase text-white/90">
                            {{ $main['contact']['hours']['title'] }}</h3>
                        <p class="mt-3 text-white/70 leading-relaxed">
                            {!! $main['contact']['hours']['schedule'] !!}
                        </p>
                    </div>

                    <div class="text-center md:text-left">
                        <h3 class="text-xs tracking-wider font-semibold uppercase text-white/90">
                            {{ $main['contact']['address']['title'] }}</h3>
                        <p class="mt-3 text-white/70 leading-relaxed">
                            {!! $main['contact']['address']['details'] !!}
                        </p>
                    </div>

                    <div class="text-center md:text-left">
                        <h3 class="text-xs tracking-wider font-semibold uppercase text-white/90">
                            {{ $main['contact']['contact_info']['title'] }}</h3>
                        <p class="mt-3 text-white/70 leading-relaxed">
                            <a class="hover:text-white transition-colors block mb-1"
                                href="mailto:{{ $main['contact']['contact_info']['email'] }}">{{ $main['contact']['contact_info']['email'] }}</a>
                            <a class="hover:text-white transition-colors block"
                                href="tel:{{ $main['contact']['contact_info']['phone'] }}">{{ $main['contact']['contact_info']['phone_display'] }}</a>
                        </p>
                    </div>
                </div>
                <div
                    class="container mx-auto px-4 pb-6 md:pb-10 text-center text-[11px] md:text-[12px] text-white/60 space-y-2 md:space-y-3">
                    <a class="hover:text-white transition-colors"
                        href="{{ $main['settings']['privacy_policy_url'] }}">{{ $main['settings']['privacy_policy_text'] }}</a>
                    <div>©{{ date('Y') }} {!! $main['settings']['copyright_text'] !!}
                    </div>
                </div>
            </section>
        </footer>

    </div>
@endsection
