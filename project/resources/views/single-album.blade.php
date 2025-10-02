{{--
  Single Album Template
--}}

@extends('layouts.app')

@section('content')
    <section class="bg-black text-white min-h-screen py-20 px-4" style="--gold: {{ $album['settings']['gold_color'] }};">
        <div class="max-w-screen-xl mx-auto relative">

            <div class="mb-8">
                <a href="{{ home_url('/gallery') }}"
                    class="inline-flex items-center text-white/70 hover:text-[var(--gold)] transition-colors duration-300">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Gallery
                </a>
            </div>

            <div class="mb-12">
                <h1 class="text-[var(--gold)] text-4xl md:text-5xl font-bold mb-4">
                    {{ $album['info']['title'] }}
                </h1>

                @if (!empty($album['info']['description']))
                    <div class="text-white/80 text-lg max-w-3xl">
                        {!! wpautop($album['info']['description']) !!}
                    </div>
                @endif

                @if (!empty($album['info']['excerpt']))
                    <p class="text-white/60 text-sm mt-2">
                        {{ $album['info']['excerpt'] }}
                    </p>
                @endif
            </div>

            <div class="relative">
                <div id="top-fade"
                    class="pointer-events-none absolute top-0 left-0 right-0 h-16 bg-gradient-to-b from-black to-transparent z-10 transition-opacity duration-300 opacity-0">
                </div>

                <div id="bottom-fade"
                    class="pointer-events-none absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-black to-transparent z-10 transition-opacity duration-300">
                </div>

                <div id="album-scroll"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ $album['settings']['columns'] }} max-h-[700px] gap-4 overflow-y-scroll pr-6 scrollbar scrollbar-thumb-yellow-500 scrollbar-track-transparent">

                    @foreach ($album['images'] as $image)
                        <div class="group relative overflow-hidden rounded-lg bg-gray-900 aspect-[4/3] cursor-pointer"
                            onclick="openLightbox('{{ $image['full_url'] }}', '{{ addslashes($image['alt']) }}', '{{ addslashes($image['caption']) }}')">

                            <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">

                            <div
                                class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300 flex items-center justify-center">
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>

                            @if (!empty($image['caption']))
                                <div
                                    class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                                    <p class="text-white text-sm">{{ $image['caption'] }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-8 text-center">
                <p class="text-white/60 text-sm">
                    {{ count($album['images']) }} {{ count($album['images']) === 1 ? 'image' : 'images' }} in this album
                </p>
            </div>
        </div>

        <div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4">
            <div class="relative max-w-screen-lg w-full">
                <button onclick="closeLightbox()"
                    class="absolute top-4 right-4 z-10 text-white hover:text-[var(--gold)] transition-colors duration-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>

                <img id="lightbox-image" src="" alt="" class="w-full h-auto max-h-[80vh] object-contain">

                <div id="lightbox-caption" class="mt-4 text-center text-white"></div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollContainer = document.getElementById('album-scroll');
            const topFade = document.getElementById('top-fade');
            const bottomFade = document.getElementById('bottom-fade');

            function handleScroll() {
                const scrollTop = scrollContainer.scrollTop;
                const scrollHeight = scrollContainer.scrollHeight;
                const clientHeight = scrollContainer.clientHeight;
                topFade.style.opacity = scrollTop > 10 ? '1' : '0';
                const isAtBottom = scrollTop + clientHeight >= scrollHeight - 10;
                bottomFade.style.opacity = isAtBottom ? '0' : '1';
            }

            scrollContainer.addEventListener('scroll', handleScroll);
            handleScroll();
        });

        function openLightbox(imageSrc, imageAlt, imageCaption) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxCaption = document.getElementById('lightbox-caption');

            lightboxImage.src = imageSrc;
            lightboxImage.alt = imageAlt;
            lightboxCaption.textContent = imageCaption || '';

            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });
    </script>
@endsection
