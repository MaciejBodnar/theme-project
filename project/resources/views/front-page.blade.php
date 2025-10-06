{{--
  Template Name: Front Page
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <section class="relative min-h-screen flex items-center justify-center bg-[#0b0b0b] text-white pb-20"
        style="background-image: url('{{ $main['hero']['hero_background'] }}'); background-size: 800px; background-repeat: repeat;">

        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center px-6">
                <img src="{{ $main['hero']['hero_logo'] }}" alt="Sweet Beauty"
                    class="mx-auto mb-6 max-w-[220px] md:max-w-[884px] block">
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 hidden lg:block">
            @include('sections.header')
        </div>
    </section>
    <section class="bg-[#0b0b0b] text-white relative overflow-hidden" style="--gold: {{ $main['settings']['gold_color'] }};"
        data-animate="fadeIn">
        <div class="container mx-auto px-4 md:px-8 min-h-screen flex items-center">
            <div class="grid md:grid-cols-2 gap-10 lg:gap-16 items-center">
                <div data-animate="slideInLeft" data-delay="200">
                    <h1 class="text-4xl md:text-8xl tracking-tight text-[var(--gold)]">
                        {{ $main['hero']['title'] }}</h1>

                    <div class="mt-6 space-y-5 leading-relaxed text-white/80">
                        <p>{!! $main['hero']['description'] !!}</p>
                    </div>

                    <h2 class="mt-10 text-2xl md:text-3xl font-semibold text-[var(--gold)]">
                        {{ $main['hero']['salon_title'] }}</h2>
                    <div class="mt-4 text-white/80 leading-relaxed">
                        {{ $main['hero']['salon_description'] }}
                    </div>

                    <div class="mt-6 flex items-center gap-3 text-white/70 text-sm">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="12" cy="12" r="9" stroke-width="1.5" />
                            <path d="M12 7v5l3 2" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <div>
                            {!! $main['hero']['opening_hours'] !!}
                        </div>
                    </div>
                    <a href="{{ $main['hero']['hero_button_url'] }}"
                        class="mt-6 w-full inline-flex items-center justify-center rounded-sm border border-[var(--gold)] px-6 py-4 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
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

    <section class="bg-[#0b0b0b] min-h-fit md:min-h-screen text-white flex items-center" data-animate="slideUp">
        <div class="py-8 md:pb-20">
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
            <div class="hidden md:grid grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-1" data-stagger="150">
                @foreach ($main['tiles'] as $tile)
                    <figure class="relative group overflow-hidden !m-0 bg-black ring-1 ring-white/10"
                        data-animate="scaleIn">
                        <img src="{{ $tile['src'] }}" alt="{{ $tile['label'] }}"
                            class="h-full min-h-[462px] w-full object-cover aspect-[4/3] grayscale group-hover:grayscale-0 transition duration-300" />
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
                    class="mt-6 w-full inline-flex items-center justify-center rounded-sm border border-[#d1b07a] px-6 py-6 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                    {{ $main['gallery']['button_text'] }}
                </a>
            </div>
        </div>
    </section>
    <section class="bg-[#0b0b0b] text-white flex justify-center min-h-screen py-16" style="--gold: #d1b07a;"
        data-animate="fadeIn">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid md:grid-cols-2 gap-10 items-center h-full">
                <div data-animate="slideInLeft" data-delay="200">
                    <h2 class="text-4xl md:text-6xl tracking-tight text-[var(--gold)] mb-8">
                        {{ $main['testimonials']['title'] }}</h2>
                    <div class="hidden md:block space-y-6 text-sm text-white/50  leading-relaxed">
                        @foreach ($main['testimonials']['testimonials'] as $testimonial)
                            <div>
                                <p>{{ $testimonial['text'] }}</p>
                                <div class="mt-2 text-xs uppercase tracking-wide text-white/80 font-semibold">
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
                                            <div class="mt-2 text-xs uppercase tracking-wide text-white/80 font-semibold">
                                                {{ $testimonial['name'] }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="flex justify-center mt-4 space-x-2">
                            @foreach ($main['testimonials']['testimonials'] as $index => $testimonial)
                                <button
                                    class="testimonials-carousel-dot w-4 h-0.5 rounded-full transition-colors {{ $index === 0 ? 'bg-[#d1b07a]' : 'bg-white/30' }} hover:bg-[#d1b07a]/70"
                                    data-slide="{{ $index }}"></button>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-10 flex gap-4">
                        <a href="{{ $main['testimonials']['cta_view_more_url'] }}"
                            class="w-full inline-flex items-center justify-center rounded-sm border border-[var(--gold)] px-6 py-6 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                            {{ $main['testimonials']['cta_view_more'] }}
                        </a>
                        <a href="{{ $main['testimonials']['cta_book_now_url'] }}"
                            class="w-full inline-flex items-center justify-center rounded-sm border border-[var(--gold)] px-6 py-6 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                            {{ $main['testimonials']['cta_book_now'] }}
                        </a>
                    </div>
                </div>

                <div class="aspect-[3/4] overflow-hidden max-w-md ml-auto" data-animate="slideInRight" data-delay="400">
                    <img src="{{ $main['testimonials']['image'] }}" alt="Testimonials Image">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#0b0b0b] flex justify-center min-h-screen text-white py-20" style="--gold: #d1b07a;"
        data-animate="slideUp">
        <div class="container mx-auto px-4 md:px-8 flex justify-center flex-col">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center mb-16" data-stagger="200">
                <div class="border border-white/20 p-6 rounded" data-animate="scaleIn">
                    <div class="text-3xl font-bold text-white">{{ $main['statistics']['clients']['number'] }}</div>
                    <div class="text-xs text-white/60 mt-2 uppercase tracking-wide">
                        {{ $main['statistics']['clients']['label'] }}</div>
                </div>
                <div class="border border-white/20 p-6 rounded" data-animate="scaleIn">
                    <div class="text-3xl font-bold text-white">{{ $main['statistics']['treatments']['number'] }}</div>
                    <div class="text-xs text-white/60 mt-2 uppercase tracking-wide">
                        {{ $main['statistics']['treatments']['label'] }}</div>
                </div>
                <div class="border border-white/20 p-6 rounded" data-animate="scaleIn">
                    <div class="text-3xl font-bold text-white">{{ $main['statistics']['experience']['number'] }}</div>
                    <div class="text-xs text-white/60 mt-2 uppercase tracking-wide">
                        {{ $main['statistics']['experience']['label'] }}</div>
                </div>
                <div class="border border-white/20 p-6 rounded" data-animate="scaleIn">
                    <div class="text-3xl font-bold text-white">{{ $main['statistics']['products']['number'] }}</div>
                    <div class="text-xs text-white/60 mt-2 uppercase tracking-wide">
                        {{ $main['statistics']['products']['label'] }}</div>
                </div>
            </div>

            <div class="max-w-4xl mx-auto text-sm text-white/80 leading-relaxed md:flex gap-18" data-animate="fadeIn"
                data-delay="800">
                <h3 class="text-[54px] text-nowrap text-[var(--gold)]">{{ $main['policy']['title'] }}
                </h3>

                <p class="mb-4 text-[#B3B3B3]">{!! $main['policy']['paragraph'] !!}</p>
            </div>
        </div>
    </section>
    <section class="relative min-h-screen flex items-center justify-center bg-[#0b0b0b] text-white"
        style="background-image: url('{{ $main['hero']['hero_background'] }}'); background-size: 800px; background-repeat: repeat; --gold: #d1b07a;"
        data-animate="scaleIn">

        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center px-6" data-animate="fadeIn" data-delay="300">
                <h1 class="text-[26px] md:text-[94px] tracking-widest text-[#d1b07a] mb-10">
                    {{ $main['cta_section']['title'] }}
                </h1>
                <div class="flex flex-col md:flex-row justify-center gap-4" data-animate="slideUp" data-delay="600">
                    <a href="{{ $main['cta_section']['view_more_url'] }}"
                        class="inline-flex items-center justify-center rounded-sm border border-[var(--gold)] px-20 py-6 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                        {{ $main['cta_section']['view_more_text'] }}
                    </a>
                    <a href="{{ $main['cta_section']['book_now_url'] }}"
                        class="inline-flex items-center justify-center rounded-sm border border-[var(--gold)] px-20 py-6 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                        {{ $main['cta_section']['book_now_text'] }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
