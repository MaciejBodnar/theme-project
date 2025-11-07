{{--
  Template Name: Front Page
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <div class="snap-y snap-none md:snap-mandatory overflow-y-scroll h-screen">
        <section
            class="snap-normal snap-align-none md:snap-always md:snap-center relative min-h-screen flex items-center justify-center bg-[#0b0b0b] text-white pb-20"
            style="background-image: url('{{ $main['hero']['hero_background'] }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="absolute bottom-0 left-0 right-0 hidden lg:block">
                @include('sections.header')
            </div>
        </section>
        <section
            class="snap-normal snap-align-none md:snap-always md:snap-center bg-[#0F0F0F] text-white relative overflow-hidden"
            style="--gold: #d1b07a;">
            <div class="container mx-auto px-8 md:px-16 lg:px-38 min-h-screen flex items-center" data-animate="fadeIn">
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
            class="snap-normal snap-align-none md:snap-always md:snap-center bg-black min-h-fit md:min-h-screen content-center text-white flex items-center">
            <div class="mb-10" data-animate="slideUp">
                <div class="hidden md:block">
                    <div class="hidden md:grid grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-0.5" data-stagger="150">
                        @foreach ($main['albums'] as $album)
                            <figure class="relative group overflow-hidden !m-0 bg-black ring-1 ring-white/10"
                                data-animate="scaleIn">
                                <img src="{{ $album['thumbnail'] }}" alt="{{ $album['title'] }}"
                                    class="h-full min-h-[400px] w-full object-cover aspect-[4/3] grayscale group-hover:grayscale-0 transition duration-300" />
                                <figcaption class="pointer-events-none absolute inset-x-0 bottom-10">
                                    <span
                                        class="flex justify-center text-[11px] md:text-xs font-semibold uppercase tracking-wide">{{ $album['title'] }}</span>
                                </figcaption>
                                <a href="{{ $album['link'] }}" class="absolute inset-0"
                                    aria-label="View {{ $album['title'] }} album"></a>
                            </figure>
                        @endforeach
                    </div>
                </div>

                <div class="md:hidden">
                    <div class="relative overflow-hidden">
                        <div id="gallery-carousel" class="flex transition-transform duration-300 ease-in-out">
                            @php
                                $albumChunks = array_chunk($main['albums'], 1);
                            @endphp
                            @foreach ($albumChunks as $chunk)
                                <div class="w-full flex-shrink-0 px-2">
                                    @foreach ($chunk as $album)
                                        <figure class="relative group overflow-hidden !m-0 bg-black ring-1 ring-white/10">
                                            <img src="{{ $album['thumbnail'] }}" alt="{{ $album['title'] }}"
                                                class="h-full min-h-[462px] w-full object-cover aspect-[4/3] grayscale group-hover:grayscale-0 transition duration-300" />
                                            <figcaption class="pointer-events-none absolute inset-x-0 bottom-4">
                                                <span
                                                    class="flex justify-center text-[10px] font-semibold uppercase tracking-wide">{{ $album['title'] }}</span>
                                            </figcaption>
                                            <a href="{{ $album['link'] }}" class="absolute inset-0"
                                                aria-label="View {{ $album['title'] }} album"></a>
                                        </figure>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Carousel Dots -->
                    @if (count($main['albums']) > 2)
                        <div class="flex justify-center mt-6 space-x-2">
                            @foreach ($albumChunks as $index => $chunk)
                                <button
                                    class="gallery-carousel-dot w-4 h-0.5 rounded-full transition-colors {{ $index === 0 ? 'bg-[#d1b07a]' : 'bg-white/30' }} hover:bg-[#d1b07a]/70"
                                    data-slide="{{ $index }}"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="container mx-auto px-4 md:px-8" data-animate="fadeIn" data-delay="800">
                    <a href="{{ $main['gallery']['button_url'] }}"
                        class="mt-6 w-full uppercase inline-flex items-center justify-center border-2 border-[#d1b07a] px-6 py-6 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                        {{ $main['gallery']['button_text'] }}
                    </a>
                </div>
            </div>
        </section>
        {{-- TESTIMONIALS --}}
        <section
            class="snap-normal snap-align-none md:snap-always md:snap-center bg-[#0F0F0F] content-center text-white flex justify-center min-h-screen py-16"
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
                                class="w-full inline-flex gap-2 items-center justify-center border-2 border-[var(--gold)] px-6 py-6 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                                @if (!empty($main['testimonials']['cta_view_more_icon']))
                                    {!! $main['testimonials']['cta_view_more_icon'] !!}
                                @endif
                                <span class="uppercase">
                                    {{ $main['testimonials']['cta_view_more'] }}
                                </span>
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

        <section
            class="snap-normal snap-align-none md:snap-always md:snap-center bg-black flex justify-center content-center min-h-screen text-white py-20"
            style="--gold: #d1b07a;">
            <div class="h-full container mx-auto px-8 md:px-16 lg:px-38" data-animate="slideUp">
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

                    <div class="space-y-6 pt-8 md:pt-0 font-light tracking-wider text-[#B3B3B3]">
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
            class="snap-normal snap-align-none md:snap-always md:snap-center relative min-h-screen flex items-center justify-center bg-[#0b0b0b] text-white"
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
        @include('sections.footer')

    </div>
@endsection
