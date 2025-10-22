<footer class="text-white" style="--gold: #d1b07a;">
    <section class="bg-[#0F0F0F] text-white">
        <div class="container mx-auto px-4 md:px-8 py-14 md:py-20">
            <h2 class="text-center heading-2">{{ $footer['instagram']['title'] }}</h2>

            <!-- Mobile Carousel -->
            <div class="md:hidden mt-10">
                <div class="relative overflow-hidden">
                    <div id="instagram-carousel" class="flex transition-transform duration-300 ease-in-out">
                        @foreach ($footer['instagram']['images'] as $index => $src)
                            <div class="w-full flex-shrink-0 px-4">
                                <a href="{{ $footer['social']['instagram_url'] }}" class="block group">
                                    <div class="overflow-hidden bg-black ring-1 ring-white/10">
                                        <img src="{{ $src }}" alt="Instagram post {{ $index + 1 }}"
                                            class="h-full w-full object-cover aspect-square group-hover:scale-[1.02] transition">
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-center mt-6 space-x-2">
                    @foreach ($footer['instagram']['images'] as $index => $src)
                        <button
                            class="instagram-carousel-dot w-full h-0.5 rounded-full transition-colors {{ $index === 0 ? 'bg-[#d1b07a]' : 'bg-white/30' }} hover:bg-[#d1b07a]/70"
                            data-slide="{{ $index }}"></button>
                    @endforeach
                </div>
            </div>

            <!-- Desktop Grid -->
            <div class="hidden md:grid mt-10 grid-cols-4 gap-5 md:gap-6">
                @foreach ($footer['instagram']['images'] as $src)
                    <a href="{{ $footer['social']['instagram_url'] }}" class="block group">
                        <div class="overflow-hidden bg-black ring-1 ring-white/10">
                            <img src="{{ $src }}" alt=""
                                class="h-full w-full object-cover group-hover:scale-[1.02] transition">
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <section class="bg-black border-t border-white/10">
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-center gap-8 md:gap-20 lg:gap-40">
                <a href="{{ $footer['social']['facebook_url'] }}" aria-label="Facebook"
                    class="hover:text-[var(--gold)] transition p-2">
                    <svg class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 0 1 1.141.195v3.325a8.623 8.623 0 0 0-.653-.036 26.805 26.805 0 0 0-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 0 0-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 3.667h-3.533v7.98H9.101z" />
                    </svg>
                </a>
                <a href="{{ $footer['social']['instagram_url'] }}" aria-label="Instagram"
                    class="hover:text-[var(--gold)] transition p-2">
                    <svg class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                    </svg>
                </a>
                <a href="{{ $footer['social']['tiktok_url'] }}" aria-label="TikTok"
                    class="hover:text-[var(--gold)] transition p-2">
                    <svg class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
    <section class="bg-[#0b0b0b]">
        <div class="container mx-auto px-4 py-8 md:py-12 grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-10 text-sm">
            <div class="text-center md:text-left">
                <h3 class="text-xs tracking-wider font-semibold uppercase text-white/90">
                    {{ $footer['contact']['hours']['title'] }}</h3>
                <p class="mt-3 text-white/70 leading-relaxed">
                    {!! $footer['contact']['hours']['schedule'] !!}
                </p>
            </div>

            <div class="text-center md:text-left">
                <h3 class="text-xs tracking-wider font-semibold uppercase text-white/90">
                    {{ $footer['contact']['address']['title'] }}</h3>
                <p class="mt-3 text-white/70 leading-relaxed">
                    {!! $footer['contact']['address']['details'] !!}
                </p>
            </div>

            <div class="text-center md:text-left">
                <h3 class="text-xs tracking-wider font-semibold uppercase text-white/90">
                    {{ $footer['contact']['contact_info']['title'] }}</h3>
                <p class="mt-3 text-white/70 leading-relaxed">
                    <a class="hover:text-white transition-colors block mb-1"
                        href="mailto:{{ $footer['contact']['contact_info']['email'] }}">{{ $footer['contact']['contact_info']['email'] }}</a>
                    <a class="hover:text-white transition-colors block"
                        href="tel:{{ $footer['contact']['contact_info']['phone'] }}">{{ $footer['contact']['contact_info']['phone_display'] }}</a>
                </p>
            </div>
        </div>
        <div
            class="container mx-auto px-4 pb-6 md:pb-10 text-center text-[11px] md:text-[12px] text-white/60 space-y-2 md:space-y-3">
            <a class="hover:text-white transition-colors"
                href="{{ $footer['settings']['privacy_policy_url'] }}">{{ $footer['settings']['privacy_policy_text'] }}</a>
            <div>©{{ date('Y') }} {!! $footer['settings']['copyright_text'] !!}
            </div>
        </div>
    </section>
</footer>
