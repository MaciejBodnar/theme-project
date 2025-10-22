{{--
  Template Name: Single Album
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <section class="bg-black text-white min-h-screen py-20 px-4" style="--gold: #d1b07a;">
        <div class="max-w-screen-xl mx-auto relative">
            <div class="mb-12">
                <h1 class="text-[#d1b07a] heading-1">
                    {{ $album['info']['title'] }}
                </h1>
            </div>

            <div class="relative">
                <div id="top-fade"
                    class="pointer-events-none absolute top-0 left-0 right-0 h-16 bg-gradient-to-b from-black to-transparent z-10 transition-opacity duration-300 opacity-0">
                </div>

                <div id="bottom-fade"
                    class="pointer-events-none absolute bottom-0 left-0 right-0 h-40 bg-gradient-to-t from-black to-transparent z-10 transition-opacity duration-300">
                </div>

                <div id="album-scroll"
                    class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-{{ $album['settings']['columns'] }} max-h-[746px] gap-4 overflow-y-scroll pr-6 scrollbar scrollbar-thumb-yellow-500 scrollbar-track-transparent">

                    @foreach ($album['images'] as $image)
                        <div class="group relative min-h-[480px] rounded-lg bg-gray-900 cursor-pointer"
                            onclick="openLightbox('{{ $image['full_url'] }}', '{{ addslashes($image['alt']) }}', '{{ addslashes($image['caption']) }}')">

                            <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}"
                                class="w-full h-full object-cover group-hover:scale-101 transition-transform duration-300">

                            <div
                                class="absolute inset-0 bg-black/0 group-hover:bg-black/30 group-hover:scale-101 transition-colors duration-300 flex items-center justify-center">
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
                    class="absolute top-4 right-4 z-10 text-white hover:text-[#d1b07a] transition-colors duration-300">
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
@endsection
