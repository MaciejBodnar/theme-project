{{--
  Template Name: About
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <section class="bg-[#0b0b0b] text-white relative overflow-hidden" style="--gold: #d1b07a;">
        <div class="container mx-auto px-8 md:px-16 lg:px-50 min-h-screen flex items-center">
            <div class="grid md:grid-cols-2 gap-10 lg:gap-16 items-center">
                <div>
                    <h1 class="text-4xl md:text-8xl tracking-tight text-[var(--gold)]">
                        {{ $about['hero']['title'] }}</h1>

                    <div class="mt-6 space-y-5 leading-relaxed text-white/80">
                        <p>{!! $about['hero']['description'] !!}</p>
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
                        class="w-full h-auto object-contain md:max-h-screen">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#0b0b0b] text-white relative" style="--gold: #d1b07a;">
        <div
            class="relative flex flex-col gap-20 justify-center container mx-auto px-8 md:px-16 lg:px-50 min-h-fit md:min-h-screen py-16">
            <h2 class="text-4xl md:text-6xl tracking-tight text-[var(--gold)]">{{ $about['team']['title'] }}</h2>

            <div class="h-full flex flex-col md:flex-row justify-center gap-8">
                <div class="md:hidden">
                    <div class="relative overflow-hidden">
                        <div id="team-carousel" class="flex transition-transform duration-300 ease-in-out">
                            @foreach ($about['team']['members'] as $member)
                                <div class="w-full flex-shrink-0 px-4">
                                    <article class="max-w-sm mx-auto">
                                        <div class="aspect-[4/3] overflow-hidden rounded-md ring-1 ring-white/10 bg-black">
                                            <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}"
                                                class="h-full w-full object-cover">
                                        </div>
                                        <h3 class="mt-5 text-2xl font-semibold text-[var(--gold)]">{{ $member['name'] }}
                                        </h3>
                                        <p class="mt-2 text-white/70 text-sm leading-relaxed">{{ $member['bio'] }}</p>
                                    </article>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex justify-center mt-6 space-x-2">
                            @foreach ($about['team']['members'] as $index => $member)
                                <button
                                    class="team-carousel-dot w-4 h-0.5 rounded-full transition-colors {{ $index === 0 ? 'bg-[#d1b07a]' : 'bg-white/30' }} hover:bg-[#d1b07a]/70"
                                    data-slide="{{ $index }}"></button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="hidden md:flex md:flex-row justify-center gap-8">
                    @foreach ($about['team']['members'] as $member)
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
        </div>
    </section>
    <section class="bg-[#0b0b0b] text-white" style="--gold: #d1b07a;">
        <div class="container mx-auto px-8 md:px-16 lg:px-50 min-h-fit md:min-h-screen py-16 flex flex-col">
            <h2 class="text-center text-4xl md:text-8xl tracking-tight text-[var(--gold)]">
                {{ $about['certificates']['title'] }}</h2>

            <div class="mt-12 flex-1 flex items-center justify-center">
                <div class="hidden md:flex items-center justify-center gap-6">
                    @foreach ($about['certificates']['images'] as $index => $cert_url)
                        @if ($index === 1)
                            <div class="md:h-[694px] md:max-w-[540px] overflow-hidden">
                                <img src="{{ $cert_url }}" alt="Certificate" class="h-full w-full object-cover">
                            </div>
                        @else
                            <div class="md:h-[420px] md:max-w-[256px] overflow-hidden self-center">
                                <img src="{{ $cert_url }}" alt="Certificate" class="h-full w-full object-cover">
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="md:hidden">
                    <div class="relative overflow-hidden">
                        <div id="certificates-carousel" class="flex transition-transform duration-300 ease-in-out">
                            @foreach ($about['certificates']['images'] as $index => $cert_url)
                                <div class="w-full flex-shrink-0 px-4">
                                    <div class="h-[420px] max-w-[256px] mx-auto overflow-hidden">
                                        <img src="{{ $cert_url }}" alt="Certificate"
                                            class="h-full w-full object-cover">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex justify-center mt-4 space-x-2">
                            @foreach ($about['certificates']['images'] as $index => $cert_url)
                                <button
                                    class="certificates-carousel-dot w-4 h-0.5 rounded-full transition-colors {{ $index === 0 ? 'bg-[#d1b07a]' : 'bg-white/30' }} hover:bg-[#d1b07a]/70"
                                    data-slide="{{ $index }}"></button>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-[#0b0b0b] text-white" style="--gold: #d1b07a;">
        <div class="container mx-auto px-8 md:px-16 lg:px-50 min-h-screen flex justify-center flex-col py-16">
            <h2 class="text-4xl md:text-6xl tracking-tight text-[var(--gold)]">{{ $about['testimonials']['title'] }}</h2>

            <div class="mt-10 grid md:grid-rows-2 md:grid-cols-3 gap-8 text-white/80">
                @if (count($about['testimonials']['items']) >= 2)
                    <div class="space-y-8 md:row-span-2">
                        <div class="row-span-1">
                            <p class="leading-relaxed">{{ $about['testimonials']['items'][0]['text'] }}</p>
                            <div class="uppercase tracking-wide text-xs text-white/60">
                                {{ $about['testimonials']['items'][0]['name'] }}
                            </div>
                        </div>
                        @if (count($about['testimonials']['items']) >= 2)
                            <div class="row-span-1">
                                <p class="leading-relaxed">{{ $about['testimonials']['items'][1]['text'] }}</p>
                                <div class="uppercase tracking-wide text-xs text-white/60">
                                    {{ $about['testimonials']['items'][1]['name'] }}</div>
                            </div>
                        @endif
                    </div>
                    @if (count($about['testimonials']['items']) >= 3)
                        <div class="md:col-span-2 md:row-span-2">
                            <p class="leading-relaxed">{{ $about['testimonials']['items'][2]['text'] }}</p>
                            <div class="mt-2 uppercase tracking-wide text-xs text-white/60">
                                {{ $about['testimonials']['items'][2]['name'] }}</div>
                        </div>
                    @endif
                @else
                    @foreach ($about['testimonials']['items'] as $testimonial)
                        <div>
                            <p class="leading-relaxed">{{ $testimonial['text'] }}</p>
                            <div class="mt-2 uppercase tracking-wide text-xs text-white/60">{{ $testimonial['name'] }}
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="mt-10 flex flex-col md:flex-row gap-8 h-fit">
                    @foreach ($about['buttons'] as $button)
                        <a href="{{ $button['url'] }}"
                            class="inline-flex items-center justify-center rounded-sm border border-[#d1b07a] px-18 py-6 text-nowrap text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                            {{ $button['text'] }}
                        </a>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
@endsection
