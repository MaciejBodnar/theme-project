@extends('layouts.app')

@section('content')
    <section class="bg-[#030200] text-white">
        <div class="container mx-auto px-4 md:px-8 py-16 md:py-24">
            <div class="grid md:grid-cols-2 gap-10 lg:gap-16 items-start">
                <div>
                    <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-[#d1b07a]">{{ $training['hero']['title'] }}
                    </h1>

                    <div class="mt-8 space-y-6 text-gray-300 leading-relaxed">
                        <p class="max-w-prose">{{ $training['hero']['intro'] }}</p>
                        <p class="max-w-prose">{{ $training['hero']['body'] }}</p>
                    </div>

                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="/rent-space"
                            class="inline-flex items-center justify-center rounded-md border px-5 py-3 text-sm font-semibold tracking-wide border-[#b9935a] text-[#b9935a] hover:bg-[#b9935a]/10 transition">
                            RENT Space
                        </a>
                        <a href="/contact"
                            class="inline-flex items-center justify-center rounded-md border px-5 py-3 text-sm font-semibold tracking-wide border-[#b9935a] text-[#b9935a] hover:bg-[#b9935a]/10 transition">
                            CONTACT us
                        </a>
                    </div>
                </div>

                <div class="w-full">
                    <div class="w-[616px] h-[872px] overflow-hidden rounded-xl ring-1 ring-white/10 bg-black">
                        <img src="{{ $training['hero']['image'] }}" alt="" class="h-full w-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
