{{--
  Template Name: Contact
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
                    {!! do_shortcode('[contact-form-7 id="5ec7409" title="Lead"]') !!}

                </div>
            </div>
        </div>
    </section>
@endsection
