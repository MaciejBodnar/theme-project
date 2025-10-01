<header class="bg-[#0B0B0B] text-white">
    <div class="container mx-auto h-16 flex items-center justify-between px-4">
        <a href="{{ home_url('/') }}" class="flex items-center">
            <img src="{{ get_theme_file_uri('resources/images/logo.svg') }}" alt="Logo" class="h-7 w-auto">
        </a>

        <div class="flex-1 flex items-center justify-center gap-8">
            <div class="text-xs font-semibold px-3 py-1 border border-white/10 rounded">
                ENG
            </div>
            <div class="flex items-center gap-5 text-[18px]">
                <a href="#" aria-label="Facebook" class="hover:text-[#d1b07a]"><span
                        class="material-icons">facebook</span></a>
                <a href="#" aria-label="Instagram" class="hover:text-[#d1b07a]"><span
                        class="material-icons">photo_camera</span></a>
                <a href="#" aria-label="TikTok" class="hover:text-[#d1b07a]"><span
                        class="material-icons">music_note</span></a>
            </div>
            @include('partials.main-nav')
        </div>
        <a href="/book-now" class="px-4 py-2 text-white text-sm font-semibold rounded">
            BOOK now
        </a>
    </div>
</header>
