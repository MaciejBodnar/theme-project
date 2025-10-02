<footer class="text-white" style="--gold: {{ $footer['settings']['gold_color'] }};">
    <section class="bg-[#030200] text-white">
        <div class="container mx-auto px-4 md:px-8 py-14 md:py-20">
            <h2 class="text-center text-3xl md:text-4xl font-semibold">{{ $footer['instagram']['title'] }}</h2>

            <div class="mt-10 grid grid-cols-2 md:grid-cols-4 gap-5 md:gap-6">
                @foreach ($footer['instagram']['images'] as $src)
                    <a href="{{ $footer['social']['instagram_url'] }}" class="block group">
                        <div class="aspect-square overflow-hidden rounded-lg bg-black ring-1 ring-white/10">
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
            <div class="flex items-center justify-center gap-16 text-2xl">
                <a href="{{ $footer['social']['facebook_url'] }}" aria-label="Facebook"
                    class="hover:text-[var(--gold)] transition">
                    <span class="material-icons">facebook</span>
                </a>
                <a href="{{ $footer['social']['instagram_url'] }}" aria-label="Instagram"
                    class="hover:text-[var(--gold)] transition">
                    <span class="material-icons">photo_camera</span>
                </a>
                <a href="{{ $footer['social']['tiktok_url'] }}" aria-label="TikTok"
                    class="hover:text-[var(--gold)] transition">
                    <span class="material-icons">music_note</span>
                </a>
            </div>
        </div>
    </section>

    <section class="bg-[#0b0b0b]">
        <div class="container mx-auto px-4 py-12 grid md:grid-cols-3 gap-10 text-sm">
            <div>
                <h3 class="text-xs tracking-wider font-semibold uppercase text-white/90">WE’Re open!</h3>
                <p class="mt-3 text-white/70">
                    Monday – Saturday 10:00 – 21:00<br>
                    Sunday 10:00 – 18:00
                </p>
            </div>

            <div>
                <h3 class="text-xs tracking-wider font-semibold uppercase text-white/90">
                    {{ $footer['contact']['address']['title'] }}</h3>
                <p class="mt-3 text-white/70">
                    {!! $footer['contact']['address']['details'] !!}
                </p>
            </div>

            <div>
                <h3 class="text-xs tracking-wider font-semibold uppercase text-white/90">
                    {{ $footer['contact']['contact_info']['title'] }}</h3>
                <p class="mt-3 text-white/70">
                    <a class="hover:text-white"
                        href="mailto:{{ $footer['contact']['contact_info']['email'] }}">{{ $footer['contact']['contact_info']['email'] }}</a><br>
                    <a class="hover:text-white"
                        href="tel:{{ $footer['contact']['contact_info']['phone'] }}">{{ $footer['contact']['contact_info']['phone_display'] }}</a>
                </p>
            </div>
        </div>
        <div class="container mx-auto px-4 pb-10 text-center text-[12px] text-white/60 space-y-3">
            <a class="hover:text-white" href="{{ $footer['settings']['privacy_policy_url'] }}">Privacy Policy</a>
            <div>©{{ date('Y') }} {!! $footer['settings']['copyright_text'] !!}
            </div>
        </div>
    </section>
</footer>
