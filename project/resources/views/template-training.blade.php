{{--
  Template Name: Training
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <section class="bg-[#030200] min-h-screen text-white">
        <div class="container mx-auto px-4 md:px-8 py-16 md:py-24">
            <div class="w-full flex gap-10 lg:gap-16">
                <div class="flex flex-col justify-center">
                    <h1 class="heading-1 text-[#d1b07a]">{{ $training['hero']['title'] }}
                    </h1>

                    <div class="mt-8 space-y-6 font-light text-lg tracking-wider text-[#B3B3B3]">
                        <p class="max-w-prose">{!! $training['hero']['body'] !!}</p>
                    </div>

                    <div class="mt-10 flex flex-wrap gap-4 w-full">
                        @foreach ($training['buttons'] as $button)
                            <a href="{{ $button['url'] }}"
                                class="uppercase flex items-center justify-center border-2 px-20 py-6 text-sm font-semibold tracking-wide border-[#b9935a] text-[#b9935a] hover:bg-[#b9935a]/10 transition">
                                {{ $button['text'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="w-full flex-1">
                    <div class="max-w-[616px] max-h-[872px] overflow-hidden rounded-xl ring-1 ring-white/10 bg-black">
                        <img src="{{ $training['hero']['image'] }}" alt="" class="h-full w-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
