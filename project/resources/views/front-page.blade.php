@extends('layouts.app')

@section('content')
    <section class="relative min-h-screen flex items-center justify-center bg-[#0b0b0b] text-white pb-20"
        style="background-image: url('{{ get_theme_file_uri('resources/images/pattern.png') }}'); background-size: 60px; background-repeat: repeat;">


        <div class="text-center px-6">
            <img src="{{ get_theme_file_uri('resources/images/logo-large.svg') }}" alt="Sweet Beauty"
                class="mx-auto mb-6 max-w-[220px] md:max-w-[300px]">

            <h1 class="text-[26px] md:text-[32px] tracking-widest text-[#d1b07a] font-medium uppercase">Sweet Beauty</h1>
            <p class="mt-2 text-sm md:text-base text-[#d1b07a] uppercase tracking-wide">Beauty Salon & Training Centre</p>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            @include('sections.header')
        </div>
    </section>
    <section class="bg-[#0b0b0b] text-white relative overflow-hidden" style="--gold: {{ $main['settings']['gold_color'] }};">
        <div class="container mx-auto px-4 md:px-8 min-h-screen flex items-center">
            <div class="grid md:grid-cols-2 gap-10 lg:gap-16 items-center">
                <div>
                    <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-[var(--gold)]">
                        {{ $main['hero']['title'] }}</h1>

                    <div class="mt-6 space-y-5 leading-relaxed text-white/80">
                        <p>{{ $main['hero']['description_1'] }}</p>
                        <p>{{ $main['hero']['description_2'] }}</p>
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
                </div>

                <div class="relative">
                    <img src="{{ $main['hero']['hero_image'] }}" alt=""
                        class="w-full h-auto object-contain md:max-h-[70vh]">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#0b0b0b] text-white">
        <div class="container min-h-screen mx-auto px-4 md:px-8 pb-16 md:pb-20">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">
                @foreach ($main['tiles'] as $tile)
                    <figure class="relative group overflow-hidden rounded-md bg-black ring-1 ring-white/10">
                        <img src="{{ $tile['src'] }}" alt="{{ $tile['label'] }}"
                            class="h-full w-full object-cover aspect-[4/3] grayscale group-hover:grayscale-0 transition duration-300" />
                        <figcaption class="pointer-events-none absolute inset-x-0 bottom-0">
                            <div class="bg-black/50 group-hover:bg-black/60 transition px-3 md:px-4 py-2">
                                <span
                                    class="block text-[11px] md:text-xs font-semibold uppercase tracking-wide">{{ $tile['label'] }}</span>
                            </div>
                        </figcaption>
                        <a href="{{ $tile['src'] }}" class="absolute inset-0" aria-label="{{ $tile['label'] }}"></a>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>
    <section class="bg-[#0b0b0b] text-white min-h-[85vh] py-16" style="--gold: #d1b07a;">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid md:grid-cols-2 gap-10 items-start">
                <div>
                    <h2 class="text-4xl md:text-6xl font-bold tracking-tight text-[var(--gold)] mb-8">
                        {{ $main['testimonials']['title'] }}</h2>

                    <div class="space-y-6 text-sm text-white/80 leading-relaxed">
                        @foreach ($main['testimonials']['testimonials'] as $testimonial)
                            <div>
                                <p>{{ $testimonial['text'] }}</p>
                                <div class="mt-2 text-xs uppercase tracking-wide text-white/50 font-semibold">
                                    {{ $testimonial['name'] }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-10 flex gap-4">
                        <a href="{{ $main['cta_section']['view_more_url'] }}"
                            class="inline-flex items-center justify-center rounded-sm border border-[var(--gold)] px-6 py-2 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                            {{ $main['cta_section']['view_more_text'] }}
                        </a>
                        <a href="{{ $main['cta_section']['book_now_url'] }}"
                            class="inline-flex items-center justify-center rounded-sm border border-[var(--gold)] px-6 py-2 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                            {{ $main['cta_section']['book_now_text'] }}
                        </a>
                    </div>
                </div>

                <div class="aspect-[3/4] overflow-hidden rounded-md ring-1 ring-white/10 bg-black max-w-md ml-auto">
                    <img src="{{ get_theme_file_uri('resources/images/front/testimonial-photo.jpg') }}" alt="Weronika"
                        class="h-full w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#0b0b0b] text-white py-20" style="--gold: #d1b07a;">
        <div class="container mx-auto px-4 md:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center mb-16">
                <div class="border border-white/20 p-6 rounded">
                    <div class="text-3xl font-bold text-white">{{ $main['statistics']['clients']['number'] }}</div>
                    <div class="text-xs text-white/60 mt-2 uppercase tracking-wide">
                        {{ $main['statistics']['clients']['label'] }}</div>
                </div>
                <div class="border border-white/20 p-6 rounded">
                    <div class="text-3xl font-bold text-white">{{ $main['statistics']['treatments']['number'] }}</div>
                    <div class="text-xs text-white/60 mt-2 uppercase tracking-wide">
                        {{ $main['statistics']['treatments']['label'] }}</div>
                </div>
                <div class="border border-white/20 p-6 rounded">
                    <div class="text-3xl font-bold text-white">{{ $main['statistics']['experience']['number'] }}</div>
                    <div class="text-xs text-white/60 mt-2 uppercase tracking-wide">
                        {{ $main['statistics']['experience']['label'] }}</div>
                </div>
                <div class="border border-white/20 p-6 rounded">
                    <div class="text-3xl font-bold text-white">{{ $main['statistics']['products']['number'] }}</div>
                    <div class="text-xs text-white/60 mt-2 uppercase tracking-wide">
                        {{ $main['statistics']['products']['label'] }}</div>
                </div>
            </div>

            <div class="max-w-4xl mx-auto text-sm text-white/80 leading-relaxed">
                <h3 class="text-2xl font-semibold text-[var(--gold)] mb-6">{{ $main['policy']['title'] }}</h3>

                @foreach ($main['policy']['paragraphs'] as $paragraph)
                    @if (!empty($paragraph))
                        <p class="mb-4">{{ $paragraph }}</p>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <section class="relative min-h-screen flex items-center justify-center bg-[#0b0b0b] text-white pb-20"
        style="background-image: url('{{ get_theme_file_uri('resources/images/pattern.png') }}'); background-size: 60px; background-repeat: repeat; --gold: #d1b07a;">


        <div class="text-center px-6">
            <img src="{{ get_theme_file_uri('resources/images/logo-large.svg') }}" alt="Sweet Beauty"
                class="mx-auto mb-6 max-w-[220px] md:max-w-[300px]">
            <h1 class="text-[26px] md:text-[32px] tracking-widest text-[#d1b07a] font-medium uppercase">
                {{ $main['cta_section']['title'] }}
            </h1>
            <div class="mt-10 flex gap-4">
                <a href="{{ $main['cta_section']['view_more_url'] }}"
                    class="inline-flex items-center justify-center rounded-sm border border-[var(--gold)] px-6 py-2 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                    {{ $main['cta_section']['view_more_text'] }}
                </a>
                <a href="{{ $main['cta_section']['book_now_url'] }}"
                    class="inline-flex items-center justify-center rounded-sm border border-[var(--gold)] px-6 py-2 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                    {{ $main['cta_section']['book_now_text'] }}
                </a>
            </div>
        </div>
    </section>
@endsection
