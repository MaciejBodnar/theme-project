@extends('layouts.app')

@section('content')
    <section class="bg-[#0b0b0b] text-white">
        <div class="container mx-auto px-4 md:px-8 py-16 md:py-20">
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-[{{ $gallery['settings']['gold_color'] }}]">
                {{ $gallery['settings']['title'] }}
            </h1>
            @if (!empty($gallery['settings']['description']))
                <p class="mt-4 text-white/80 text-lg max-w-3xl">
                    {{ $gallery['settings']['description'] }}
                </p>
            @endif
        </div>
    </section>

    <section class="bg-[#0b0b0b] text-white">
        <div class="container mx-auto px-4 md:px-8 pb-16 md:pb-20">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">
                @foreach ($gallery['albums'] as $album)
                    <figure class="relative group overflow-hidden rounded-md bg-black ring-1 ring-white/10">
                        <img src="{{ $album['thumbnail'] }}" alt="{{ $album['title'] }}"
                            class="h-full w-full object-cover aspect-[4/3] grayscale group-hover:grayscale-0 transition duration-300" />
                        <figcaption class="pointer-events-none absolute inset-x-0 bottom-0">
                            <div class="bg-black/50 group-hover:bg-black/60 transition px-3 md:px-4 py-2">
                                <span
                                    class="block text-[11px] md:text-xs font-semibold uppercase tracking-wide">{{ $album['title'] }}</span>
                                @if ($album['image_count'] > 0)
                                    <span class="block text-[10px] md:text-[11px] text-white/70">{{ $album['image_count'] }}
                                        {{ $album['image_count'] === 1 ? 'image' : 'images' }}</span>
                                @endif
                            </div>
                        </figcaption>
                        <a href="{{ $album['link'] }}" class="absolute inset-0"
                            aria-label="View {{ $album['title'] }} album"></a>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>
@endsection
