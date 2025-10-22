{{--
  Template Name: About
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <section class="bg-[#0F0F0F] text-white relative overflow-hidden" style="--gold: #d1b07a;">
        <div class="container mx-auto px-8 md:px-16 lg:px-38 min-h-screen flex items-center">
            <div class="grid md:grid-cols-2 gap-10 lg:gap-16 items-center">
                <div>
                    <h1 class="heading-1 text-[var(--gold)]">
                        {{ $about['hero']['title'] }}</h1>

                    <div class="mt-8 space-y-5 leading-relaxed text-white/80">
                        <p>{!! $about['hero']['description'] !!}</p>
                    </div>

                    <div class="flex mt-10 gap-20">
                        <h2 class="heading-2 text-nowrap text-[var(--gold)]">
                            {{ $about['hero']['salon_title'] }}</h2>
                        <div>
                            <div class="text-[#B3B3B3] leading-relaxed">
                                {{ $about['hero']['salon_description'] }}
                            </div>
                            <div class="mt-6 flex items-start gap-3 text-white/70">
                                <svg class="w-5 h-5 shrink-0 text-[#d1b07a]" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor">
                                    <circle cx="12" cy="12" r="9" stroke-width="1.5" />
                                    <path d="M12 7v5l3 2" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                                <div class="">
                                    {!! $about['hero']['opening_hours'] !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="relative" data-animate="slideInRight" data-delay="400">
                    <img src="{{ $about['hero']['hero_image'] }}" alt=""
                        class="w-full h-auto object-contain md:max-h-screen">
                </div>
            </div>
        </div>
    </section>

    <section class="bg-[#0b0b0b] text-white relative"
        style="background-image: url('{{ $about['team']['background_image'] }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div
            class="relative flex flex-col gap-20 justify-center container mx-auto px-8 md:px-16 lg:px-50 min-h-fit md:min-h-screen py-16">
            <h2 class="heading-1 text-[#d1b07a]">{{ $about['team']['title'] }}</h2>

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
                                        <h3 class="mt-5 heading-2 text-[#d1b07a]">{{ $member['name'] }}
                                        </h3>
                                        <p class="mt-2 text-white/70 text-sm leading-relaxed">{{ $member['bio'] }}</p>
                                    </article>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex justify-center mt-6 space-x-2">
                            @foreach ($about['team']['members'] as $index => $member)
                                <button
                                    class="team-carousel-dot w-full h-0.5 rounded-full transition-colors {{ $index === 0 ? 'bg-[#d1b07a]' : 'bg-white/30' }} hover:bg-[#d1b07a]/70"
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
                            <h3 class="mt-5 heading-2 text-[#d1b07a]">{{ $member['name'] }}</h3>
                            <p class="mt-2 text-white/70 text-sm leading-relaxed">{{ $member['bio'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="bg-[#0F0F0F] text-white" style="--gold: #d1b07a;">
        <div class="container mx-auto px-8 md:px-16 lg:px-50 min-h-fit md:min-h-screen py-16 flex flex-col">
            <h2 class="text-center heading-1 text-[var(--gold)]">
                {{ $about['certificates']['title'] }}</h2>

            <div class="mt-12 flex-1 flex items-center justify-center">
                <div id="certificates-desktop" class="hidden md:flex flex-col items-center relative">
                    <!-- Row (JS shows only 3: left small, center big, right small) -->
                    <div class="flex items-center justify-center gap-6 h-[694px]"> <!-- ← lock height -->
                        @foreach ($about['certificates']['images'] as $cert_url)
                            <div class="cert-item overflow-hidden transition-all duration-300 ease-in-out">
                                <img src="{{ $cert_url }}" alt="Certificate" class="h-full w-full object-cover">
                            </div>
                        @endforeach
                    </div>

                    <!-- Arrows UNDER the images, on the sides -->
                    <div class="mt-4 w-full flex justify-between items-center px-3 relative">
                        <button id="certificates-prev" class="p-2 rounded-full hover:bg-white/5 focus:outline-none"
                            aria-label="Previous">
                            <svg class="w-6 h-6 text-[var(--gold)]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        {{-- <!-- ✅ index display in the middle -->
                        <div id="certificates-index"
                            class="absolute left-1/2 -translate-x-1/2 text-[var(--gold)] font-light tracking-widest">
                            1 / {{ count($about['certificates']['images']) }}
                        </div> --}}

                        <button id="certificates-next" class="p-2 rounded-full hover:bg-white/5 focus:outline-none"
                            aria-label="Next">
                            <svg class="w-6 h-6 text-[var(--gold)]" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>

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
                                    class="certificates-carousel-dot w-full h-0.5 rounded-full transition-colors {{ $index === 0 ? 'bg-[#d1b07a]' : 'bg-white/30' }} hover:bg-[#d1b07a]/70"
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
            <h2 class="heading-1 text-[var(--gold)]">{{ $about['testimonials']['title'] }}</h2>

            <div class="grid md:grid-rows-2 md:grid-cols-3 gap-8 text-white/80">
                @if (count($about['testimonials']['items']) >= 2)
                    <div class="space-y-8 md:row-span-2">
                        <div class="row-span-1">
                            <p class="leading-relaxed">{{ $about['testimonials']['items'][0]['text'] }}</p>
                            <div class="uppercase tracking-wide text-white font-semibold mt-2">
                                {{ $about['testimonials']['items'][0]['name'] }}
                            </div>
                        </div>
                        @if (count($about['testimonials']['items']) >= 2)
                            <div class="row-span-1">
                                <p class="leading-relaxed">{{ $about['testimonials']['items'][1]['text'] }}</p>
                                <div class="uppercase tracking-wide text-white font-semibold mt-2">
                                    {{ $about['testimonials']['items'][1]['name'] }}</div>
                            </div>
                        @endif
                    </div>
                    @if (count($about['testimonials']['items']) >= 3)
                        <div class="md:col-span-2 md:row-span-2">
                            <p class="leading-relaxed">{{ $about['testimonials']['items'][2]['text'] }}</p>
                            <div class="mt-2 uppercase tracking-wide text-white font-semibold">
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
                            class="inline-flex uppercase items-center justify-center border-2 border-[#d1b07a] px-18 py-6 text-nowrap text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                            @if (!empty($button['icon']))
                                <i class="{{ $button['icon'] }} mr-2"></i>
                            @endif
                            {{ $button['text'] }}
                        </a>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
@endsection
