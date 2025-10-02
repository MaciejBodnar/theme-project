{{--
  Template Name: Rent Space
--}}

@extends('layouts.app')

@section('content')
    <section class="bg-black text-white py-20 px-4" style="--gold: {{ $rent['settings']['gold_color'] }};">
        <div class="max-w-screen-xl mx-auto">

            <h1 class="text-[var(--gold)] text-4xl md:text-6xl font-bold mb-16 text-center md:text-left">
                {{ $rent['content']['title'] }}
            </h1>

            <div class="grid md:grid-cols-2 gap-12">

                <div class="space-y-8 text-sm text-white/80 leading-relaxed">
                    <div>
                        <h2 class="uppercase text-white text-xs font-bold mb-2">
                            {{ $rent['content']['before_section']['title'] }}</h2>
                        <p>{{ $rent['content']['before_section']['paragraph_1'] }}</p>
                        <p>{{ $rent['content']['before_section']['paragraph_2'] }}</p>
                    </div>
                    <p>{{ $rent['content']['description_1'] }}</p>
                    <p>{{ $rent['content']['description_2'] }}</p>
                </div>

                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" placeholder="{{ $rent['form']['fields']['name_placeholder'] }}"
                            class="form-input bg-transparent border border-white/30 text-white px-4 py-2 w-full">
                        <input type="text" placeholder="{{ $rent['form']['fields']['surname_placeholder'] }}"
                            class="form-input bg-transparent border border-white/30 text-white px-4 py-2 w-full">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="email" placeholder="{{ $rent['form']['fields']['email_placeholder'] }}"
                            class="form-input bg-transparent border border-white/30 text-white px-4 py-2 w-full">
                        <input type="text" placeholder="{{ $rent['form']['fields']['contact_placeholder'] }}"
                            class="form-input bg-transparent border border-white/30 text-white px-4 py-2 w-full">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" placeholder="{{ $rent['form']['fields']['day_placeholder'] }}"
                            class="form-input bg-transparent border border-white/30 text-white px-4 py-2 w-full">
                        <input type="text" placeholder="{{ $rent['form']['fields']['time_placeholder'] }}"
                            class="form-input bg-transparent border border-white/30 text-white px-4 py-2 w-full">
                    </div>
                    <div class="space-y-3 text-xs text-white/60 leading-snug">
                        <label class="flex items-start gap-2">
                            <input type="checkbox" class="mt-1 text-[var(--gold)] accent-[var(--gold)]">
                            <span>{{ $rent['form']['terms']['checkbox_text'] }}</span>
                        </label>

                        <p>{!! $rent['form']['terms']['disclaimer_text'] !!}</p>
                    </div>

                    <button type="submit"
                        class="mt-6 border border-[var(--gold)] text-white px-6 py-2 text-sm tracking-widest hover:bg-white/10 transition">
                        {{ $rent['form']['submit_button_text'] }}
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
