{{--
  Template Name: About
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <section class="bg-[#0b0b0b] text-white relative overflow-hidden" style="--gold: {{ $about['settings']['gold_color'] }};">
        <div class="container mx-auto px-4 md:px-8 min-h-[85vh] flex items-center">
            <div class="grid md:grid-cols-2 gap-10 lg:gap-16 items-center">
                <div>
                    <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-[var(--gold)]">
                        {{ $about['hero']['title'] }}</h1>

                    <div class="mt-6 space-y-5 leading-relaxed text-white/80">
                        <p>{{ $about['hero']['description_1'] }}</p>
                        <p>{{ $about['hero']['description_2'] }}</p>
                    </div>

                    <h2 class="mt-10 text-2xl md:text-3xl font-semibold text-[var(--gold)]">
                        {{ $about['hero']['salon_title'] }}</h2>
                    <div class="mt-4 text-white/80 leading-relaxed">
                        {{ $about['hero']['salon_description'] }}
                    </div>

                    <div class="mt-6 flex items-center gap-3 text-white/70 text-sm">
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="12" cy="12" r="9" stroke-width="1.5" />
                            <path d="M12 7v5l3 2" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <div>
                            {!! $about['hero']['opening_hours'] !!}
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <img src="{{ $about['hero']['hero_image'] }}" alt=""
                        class="w-full h-auto object-contain md:max-h-[70vh]">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#0b0b0b] text-white relative" style="--gold: {{ $about['settings']['gold_color'] }};">
        <div class="relative container mx-auto px-4 md:px-8 min-h-[85vh] py-16">
            <h2 class="text-4xl md:text-6xl font-bold tracking-tight text-[var(--gold)]">Our Team</h2>

            <div class="mt-10 grid md:grid-cols-3 gap-8">
                @foreach ($about['team'] as $member)
                    <article class="max-w-sm">
                        <div class="aspect-[4/3] overflow-hidden rounded-md ring-1 ring-white/10 bg-black">
                            <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}"
                                class="h-full w-full object-cover">
                        </div>
                        <h3 class="mt-5 text-2xl font-semibold text-[var(--gold)]">{{ $member['name'] }}</h3>
                        <p class="mt-2 text-white/70 text-sm leading-relaxed">{{ $member['bio'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    <section class="bg-[#0b0b0b] text-white" style="--gold: {{ $about['settings']['gold_color'] }};">
        <div class="container mx-auto px-4 md:px-8 min-h-[85vh] py-16 flex flex-col">
            <h2 class="text-center text-4xl md:text-6xl font-bold tracking-tight text-[var(--gold)]">Certificates</h2>

            <div class="mt-12 flex-1 flex items-center justify-center">
                <div class="grid grid-cols-3 gap-6 max-w-4xl">
                    @foreach ($about['certificates'] as $cert_url)
                        <div class="aspect-[3/4] md:aspect-[4/5] overflow-hidden bg-black ring-1 ring-white/10 rounded">
                            <img src="{{ $cert_url }}" alt="Certificate" class="h-full w-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="bg-[#0b0b0b] text-white" style="--gold: {{ $about['settings']['gold_color'] }};">
        <div class="container mx-auto px-4 md:px-8 min-h-[85vh] py-16">
            <h2 class="text-4xl md:text-6xl font-bold tracking-tight text-[var(--gold)]">Testimonials</h2>

            <div class="mt-10 grid md:grid-cols-3 gap-8 text-white/80">
                @if (count($about['testimonials']) >= 2)
                    <div class="space-y-8">
                        <p class="leading-relaxed">{{ $about['testimonials'][0]['text'] }}</p>
                        <div class="uppercase tracking-wide text-xs text-white/60">{{ $about['testimonials'][0]['name'] }}
                        </div>
                        @if (count($about['testimonials']) >= 2)
                            <p class="leading-relaxed">{{ $about['testimonials'][1]['text'] }}</p>
                            <div class="uppercase tracking-wide text-xs text-white/60">
                                {{ $about['testimonials'][1]['name'] }}</div>
                        @endif
                    </div>
                    @if (count($about['testimonials']) >= 3)
                        <div class="md:col-span-2">
                            <p class="leading-relaxed">{{ $about['testimonials'][2]['text'] }}</p>
                            <div class="mt-2 uppercase tracking-wide text-xs text-white/60">
                                {{ $about['testimonials'][2]['name'] }}</div>

                            <div class="mt-10 flex gap-4">
                                @foreach ($about['buttons'] as $button)
                                    <a href="{{ $button['url'] }}"
                                        class="inline-flex items-center justify-center rounded-sm border border-[{{ $about['settings']['gold_color'] }}] px-6 py-2 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                                        {{ $button['text'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    @foreach ($about['testimonials'] as $testimonial)
                        <div>
                            <p class="leading-relaxed">{{ $testimonial['text'] }}</p>
                            <div class="mt-2 uppercase tracking-wide text-xs text-white/60">{{ $testimonial['name'] }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection
