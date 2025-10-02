@extends('layouts.app')

@section('content')
    <section class="bg-[#0b0b0b] text-white">
        <div class="container mx-auto px-4 md:px-8 pt-14 md:pt-16 pb-6">
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight text-[#d1b07a]">Contact</h1>
        </div>
    </section>

    <section class="bg-[#0b0b0b] text-white">
        <div class="container mx-auto px-4 md:px-8 pb-12">
            <div class="grid md:grid-cols-5 gap-10 lg:gap-16">

                <div class="md:col-span-2 space-y-8 text-sm">
                    <div>
                        <h3 class="text-xs tracking-wider font-semibold uppercase text-white/90">GET in touch!</h3>
                        <div class="mt-3 text-white/70 space-y-1">
                            <a class="hover:text-white block"
                                href="mailto:{{ $contact['company']['email'] }}">{{ $contact['company']['email'] }}</a>
                            <a class="hover:text-white block"
                                href="tel:+447943661484">{{ $contact['company']['phone'] }}</a>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xs tracking-wider font-semibold uppercase text-white/90">FIND us!</h3>
                        <div class="mt-3 text-white/70">
                            @foreach ($contact['company']['addr'] as $line)
                                <div>{{ $line }}</div>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xs tracking-wider font-semibold uppercase text-white/90">WE’Re open!</h3>
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
                        @php($gold = 'border-[#b9935a]')

                        <div>
                            <label class="block text-xs mb-2">Name</label>
                            <input type="text" name="first_name"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:{{ $gold }} focus:border-2 rounded-sm px-3 py-2 placeholder-white/40"
                                placeholder="">
                        </div>
                        <div>
                            <label class="block text-xs mb-2">Surname</label>
                            <input type="text" name="last_name"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:{{ $gold }} focus:border-2 rounded-sm px-3 py-2 placeholder-white/40"
                                placeholder="">
                        </div>

                        <div>
                            <label class="block text-xs mb-2">Email</label>
                            <input type="email" name="email"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:{{ $gold }} focus:border-2 rounded-sm px-3 py-2">
                        </div>
                        <div>
                            <label class="block text-xs mb-2">Contact Number</label>
                            <input type="tel" name="phone"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:{{ $gold }} focus:border-2 rounded-sm px-3 py-2">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs mb-2">Message</label>
                            <textarea name="message" rows="6"
                                class="w-full bg-transparent border border-white/30 focus:outline-none focus:{{ $gold }} focus:border-2 rounded-sm px-3 py-2"></textarea>
                        </div>

                        <div class="md:col-span-2 flex items-start gap-3 text-[12px] text-white/70">
                            <input id="consent" type="checkbox"
                                class="mt-[2px] h-4 w-4 border-white/40 bg-transparent rounded-sm focus:ring-0">
                            <label for="consent">
                                {{ $contact['form']['consent_text'] }}
                            </label>
                        </div>

                        <div class="md:col-span-2">
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-sm border {{ $gold }} px-8 py-2 text-sm font-semibold tracking-wide hover:bg-white/5 transition">
                                {{ $contact['form']['submit_text'] }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
