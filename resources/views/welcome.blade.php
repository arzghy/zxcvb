<div class="hero-section">
    @if($header)
        <h1>{{ $header->welcome_banner }}</h1>
        <p>{{ $header->tagline }}</p>
        
        @if($header->main_image)
            <img src="{{ asset('storage/' . $header->main_image) }}" alt="Hero Image">
        @endif
    @else
        <h1>Selamat Datang di Website Kami</h1>
        <p>Ini adalah tagline default.</p>
    @endif
</div>