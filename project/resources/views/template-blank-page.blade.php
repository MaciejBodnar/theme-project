{{--
  Template Name: Blank Page
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    <section class="bg-[#030200] min-h-screen text-white">
        <div class="container mx-auto px-8 md:px-16 lg:px-38 py-24">
            {!! $blank['description'] !!}
        </div>
    </section>
    @include('sections.footer')
@endsection
