{{--
  Template Name: Rent Space
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <section class="bg-black text-white pt-24 pb-16 px-4">
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
                    @if (function_exists('pll_current_language'))
                        @if (pll_current_language() === 'pl')
                            {!! do_shortcode('[contact-form-7 id="e60a46b" title="Rent - Polish"]') !!}
                        @else
                            {!! do_shortcode('[contact-form-7 id="9caf4fa" title="Rent"]') !!}
                        @endif
                    @else
                        {!! do_shortcode('[contact-form-7 id="9caf4fa" title="Rent"]') !!}
                    @endif
                </div>
            </div>
        </div>
    </section>
    @include('sections.footer')
@endsection
