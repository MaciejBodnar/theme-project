{{--
  Template Name: Gallery
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <section class="bg-[#0b0b0b] text-white">
        <div class="container mx-auto px-4 md:px-8 py-16 md:py-20">
            <h1 class="heading-1 text-[#d1b07a]">
                {{ $gallery['settings']['title'] }}
            </h1>
            @if (!empty($gallery['settings']['description']))
                <p class="mt-4 text-white/80 text-lg max-w-3xl">
                    {{ $gallery['settings']['description'] }}
                </p>
            @endif
        </div>
    </section>


    <section class="bg-[#0b0b0b] min-h-fit md:min-h-screen text-white">
        <div class="hidden md:block">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-1">
                @foreach ($gallery['albums'] as $album)
                    <figure class="relative group overflow-hidden !m-0 bg-black ring-1 ring-white/10">
                        <img src="{{ $album['thumbnail'] }}" alt="{{ $album['title'] }}"
                            class="h-full min-h-[462px] w-full object-cover aspect-[4/3] grayscale group-hover:grayscale-0 transition duration-300" />
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

        <div class="md:hidden pb-16">
            <div class="relative overflow-hidden">
                <div id="gallery-carousel" class="flex transition-transform duration-300 ease-in-out">
                    @php
                        $albumChunks = array_chunk($gallery['albums'], 2);
                    @endphp
                    @foreach ($albumChunks as $chunk)
                        <div class="w-full flex-shrink-0 px-2">
                            <div class="grid grid-cols-2 gap-1">
                                @foreach ($chunk as $album)
                                    <figure class="relative group overflow-hidden !m-0 bg-black ring-1 ring-white/10">
                                        <img src="{{ $album['thumbnail'] }}" alt="{{ $album['title'] }}"
                                            class="h-full min-h-[300px] w-full object-cover aspect-[4/3] grayscale group-hover:grayscale-0 transition duration-300" />
                                        <figcaption class="pointer-events-none absolute inset-x-0 bottom-4">
                                            <span
                                                class="flex justify-center text-[10px] font-semibold uppercase tracking-wide">{{ $album['title'] }}</span>
                                        </figcaption>
                                        <a href="{{ $album['link'] }}" class="absolute inset-0"
                                            aria-label="View {{ $album['title'] }} album"></a>
                                    </figure>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Carousel Dots -->
            @if (count($gallery['albums']) > 2)
                <div class="flex justify-center mt-6 space-x-2">
                    @foreach ($albumChunks as $index => $chunk)
                        <button
                            class="gallery-carousel-dot w-8 h-0.5 rounded-full transition-colors {{ $index === 0 ? 'bg-[#d1b07a]' : 'bg-white/30' }} hover:bg-[#d1b07a]/70"
                            data-slide="{{ $index }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
