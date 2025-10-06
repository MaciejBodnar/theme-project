{{--
  Template Name: About
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <section class="bg-[#0b0b0b] text-white">
        <div class="container mx-auto px-4 md:px-8 xl:px-50 pt-14 md:p-16 pb-6">
            <h1 class="text-4xl md:text-8xl text-[#d1b07a]">{{ $contact['page']['title'] }}</h1>
        </div>
    </section>

    <section class="bg-[#0b0b0b] text-white">
        <div class="container mx-auto px-4 md:px-8 xl:px-50 pb-12">
            <div class="grid md:grid-cols-5 gap-10 lg:gap-16">

                <div class="md:col-span-2 space-y-8">
                    <div>
                        <h3 class="tracking-wider font-semibold uppercase text-white/90">
                            {{ $contact['sections']['contact_heading'] }}</h3>
                        <div class="mt-3 text-white/70 space-y-1">
                            <a class="hover:text-white block"
                                href="mailto:{{ $contact['company']['email'] }}">{{ $contact['company']['email'] }}</a>
                            <a class="hover:text-white block"
                                href="tel:+447943661484">{{ $contact['company']['phone'] }}</a>
                        </div>
                    </div>

                    <div>
                        <h3 class="tracking-wider font-semibold uppercase text-white/90">
                            {{ $contact['sections']['location_heading'] }}</h3>
                        <div class="mt-3 text-white/70">
                            @foreach ($contact['company']['addr'] as $line)
                                <div>{{ $line }}</div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="tracking-wider font-semibold uppercase text-white/90">
                            {{ $contact['sections']['hours_heading'] }}</h3>
                        <div class="mt-3 text-white/70 space-y-1">
                            @foreach ($contact['company']['hours'] as $line)
                                <div>{{ $line }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="md:col-span-3">
                    <form class="grid grid-cols-1 md:grid-cols-2 gap-5" method="{{ $contact['form']['method'] }}"
                        action="{{ $contact['form']['action'] }}" novalidate>

                        <div>
                            <label
                                class="block text-[#B3B3B3] mb-2">{{ $contact['form']['fields']['first_name_label'] }}</label>
                            <input type="text" name="first_name"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4 placeholder-white/40"
                                placeholder="">
                        </div>
                        <div>
                            <label
                                class="block text-[#B3B3B3] mb-2">{{ $contact['form']['fields']['last_name_label'] }}</label>
                            <input type="text" name="last_name"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4 placeholder-white/40"
                                placeholder="">
                        </div>

                        <div>
                            <label
                                class="block text-[#B3B3B3] mb-2">{{ $contact['form']['fields']['email_label'] }}</label>
                            <input type="email" name="email"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4">
                        </div>
                        <div>
                            <label
                                class="block text-[#B3B3B3] mb-2">{{ $contact['form']['fields']['phone_label'] }}</label>
                            <input type="tel" name="phone"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4">
                        </div>

                        <div class="md:col-span-2">
                            <label
                                class="block text-[#B3B3B3] mb-2">{{ $contact['form']['fields']['message_label'] }}</label>
                            <textarea name="message" rows="6"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-2"></textarea>
                        </div>
                        <div class="md:col-span-2 flex items-start gap-3 text-white/70">
                            <div class="relative flex-shrink-0 mt-[2px]">
                                <input id="consent" type="checkbox" class="sr-only">
                                <label for="consent" class="cursor-pointer">
                                    <div
                                        class="w-7 h-7 border border-white/40 bg-transparent rounded-sm flex items-center justify-center transition-all duration-200 hover:border-[#d1b07a] group">
                                        <svg class="w-4 h-4 text-[#d1b07a] opacity-0 transition-opacity duration-200 group-[.checked]:opacity-100"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </label>
                            </div>
                            <label for="consent" class="text-[#B3B3B3] cursor-pointer">
                                {!! $contact['form']['consent_text'] !!}
                            </label>
                        </div>

                        <div class="md:col-span-2 flex justify-center md:justify-start">
                            <button type="submit"
                                class="inline-flex items-center justify-center border border-[#d1b07a] px-30 py-5 text-sm hover:bg-white/5 transition">
                                {{ $contact['form']['submit_text'] }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
