{{--
  Template Name: Rent Space
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <section class="bg-black text-white py-20 px-4">
        <div class="max-w-screen-xl mx-auto">

            <h1 class="text-[#d1b07a] heading-1 mb-16 text-center md:text-left">
                {{ $rent['content']['title'] }}
            </h1>

            <div class="grid md:grid-cols-3 gap-12">

                <div class="space-y-8 text-white/80 leading-relaxed">
                    <div>
                        <h2 class="uppercase text-white font-bold mb-2">
                            {{ $rent['content']['subtitle'] }}</h2>
                        <p>{!! $rent['content']['description'] !!}</p>
                    </div>
                </div>
                <div class="md:col-span-2">
                    <form class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label for="first_name"
                                class="block text-[#B3B3B3] mb-2">{{ $rent['form']['labels']['name_label'] }}</label>
                            <input type="text" name="first_name"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4 placeholder-white/40"
                                placeholder="{{ $rent['form']['placeholders']['name_placeholder'] }}">
                        </div>
                        <div>
                            <label for="last_name"
                                class="block text-[#B3B3B3] mb-2">{{ $rent['form']['labels']['surname_label'] }}</label>
                            <input type="text" name="last_name"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4 placeholder-white/40"
                                placeholder="{{ $rent['form']['placeholders']['surname_placeholder'] }}">
                        </div>

                        <div>
                            <label for="email"
                                class="block text-[#B3B3B3] mb-2">{{ $rent['form']['labels']['email_label'] }}</label>
                            <input type="email" name="email"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4"
                                placeholder="{{ $rent['form']['placeholders']['email_placeholder'] }}">
                        </div>
                        <div>
                            <label for="phone"
                                class="block text-[#B3B3B3] mb-2">{{ $rent['form']['labels']['contact_label'] }}</label>
                            <input type="tel" name="phone"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4"
                                placeholder="{{ $rent['form']['placeholders']['contact_placeholder'] }}">
                        </div>
                        <div class="relative">
                            <label for="preferred_date"
                                class="block text-[#B3B3B3] mb-2">{{ $rent['form']['labels']['date_label'] }}</label>
                            <div class="relative">
                                <input type="text" id="preferred_date_display" readonly
                                    class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4 text-white cursor-pointer"
                                    placeholder="{{ $rent['form']['placeholders']['date_placeholder'] }}">
                                <input type="date" name="preferred_date" id="preferred_date_hidden" class="hidden">
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                            <div id="calendar_popup"
                                class="absolute top-full left-0 mt-2 bg-black border border-[#d1b07a] rounded-lg p-4 hidden z-50 w-80">
                                <div class="flex items-center justify-between mb-4">
                                    <button type="button" id="prev_month" class="text-white hover:text-[#d1b07a] p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7"></path>
                                        </svg>
                                    </button>
                                    <h3 id="current_month" class="text-white font-semibold"></h3>
                                    <button type="button" id="next_month" class="text-white hover:text-[#d1b07a] p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="grid grid-cols-7 gap-1 mb-2">
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Sun</div>
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Mon</div>
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Tue</div>
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Wed</div>
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Thu</div>
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Fri</div>
                                    <div class="text-[#B3B3B3] text-xs text-center py-2">Sat</div>
                                </div>
                                <div id="calendar_days" class="grid grid-cols-7 gap-1"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <label for="preferred_time"
                                class="block text-[#B3B3B3] mb-2">{{ $rent['form']['labels']['time_label'] }}</label>
                            <div class="relative">
                                <input type="text" id="preferred_time_display" readonly
                                    class="w-full bg-transparent border border-white/30 focus:outline-none focus:border-[#d1b07a] px-3 py-4 text-white cursor-pointer"
                                    placeholder="{{ $rent['form']['placeholders']['time_placeholder'] }}">
                                <input type="time" name="preferred_time" id="preferred_time_hidden" class="hidden">
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div id="time_popup"
                                class="absolute top-full left-0 mt-2 bg-black border border-[#d1b07a] rounded-lg p-4 hidden z-50 w-64">
                                <div class="flex items-center justify-center space-x-4">
                                    <div class="text-center">
                                        <label class="block text-[#B3B3B3] text-xs mb-2">Hour</label>
                                        <div class="flex flex-col">
                                            <button type="button" id="hour_up"
                                                class="text-white hover:text-[#d1b07a] p-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 15l7-7 7 7"></path>
                                                </svg>
                                            </button>
                                            <input type="number" id="hour_input" min="1" max="12"
                                                value="12"
                                                class="w-12 bg-transparent border border-white/30 text-center text-white py-2 focus:outline-none focus:border-[#d1b07a]">
                                            <button type="button" id="hour_down"
                                                class="text-white hover:text-[#d1b07a] p-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-white text-xl">:</div>
                                    <div class="text-center">
                                        <label class="block text-[#B3B3B3] text-xs mb-2">Minute</label>
                                        <div class="flex flex-col">
                                            <button type="button" id="minute_up"
                                                class="text-white hover:text-[#d1b07a] p-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 15l7-7 7 7"></path>
                                                </svg>
                                            </button>
                                            <input type="number" id="minute_input" min="0" max="59"
                                                value="00"
                                                class="w-12 bg-transparent border border-white/30 text-center text-white py-2 focus:outline-none focus:border-[#d1b07a]">
                                            <button type="button" id="minute_down"
                                                class="text-white hover:text-[#d1b07a] p-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <label class="block text-[#B3B3B3] text-xs mb-2">Period</label>
                                        <div class="flex flex-col space-y-1">
                                            <button type="button" id="am_btn"
                                                class="px-3 py-1 border border-white/30 text-white hover:border-[#d1b07a] hover:text-[#d1b07a] rounded text-sm">AM</button>
                                            <button type="button" id="pm_btn"
                                                class="px-3 py-1 border border-white/30 text-white hover:border-[#d1b07a] hover:text-[#d1b07a] rounded text-sm">PM</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <button type="button" id="time_confirm"
                                        class="px-4 py-2 bg-[#d1b07a] text-black rounded hover:bg-[#d1b07a]/80 text-sm">
                                        Set Time
                                    </button>
                                </div>
                            </div>
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
                                {!! $rent['form']['terms']['checkbox_text'] !!}
                            </label>
                        </div>
                        <div class="md:col-span-2 flex items-start gap-3 text-white/70">
                            <div class="relative flex-shrink-0 mt-[2px]">
                                <input id="disclaimer" type="checkbox" class="sr-only">
                                <label for="disclaimer" class="cursor-pointer">
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
                            <label for="disclaimer" class="text-[#B3B3B3] cursor-pointer">
                                {!! $rent['form']['terms']['disclaimer_text'] !!}
                            </label>
                        </div>

                        <div class="md:col-span-2 flex justify-center md:justify-start">
                            <button type="submit"
                                class="inline-flex items-center justify-center border border-[#d1b07a] px-30 py-5 text-sm hover:bg-white/5 transition">
                                {{ $rent['form']['submit_button_text'] }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
