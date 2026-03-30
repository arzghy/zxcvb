<!DOCTYPE html>
<html>
<head>
    <title>KSPM SV IPB</title>
</head>
<body>
    <h2>Pengaturan Header / Hero Section</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.header.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div>
            <label>Banner Selamat Datang:</label><br>
            <input type="text" name="welcome_banner" value="{{ old('welcome_banner', $header->welcome_banner) }}" required>
        </div>
        <br>

        <div>
            <label>Tagline:</label><br>
            <textarea name="tagline" required>{{ old('tagline', $header->tagline) }}</textarea>
        </div>
        <br>

        <div>
            <label>Gambar Utama:</label><br>
            @if($header->main_image)
                <img src="{{ asset('storage/' . $header->main_image) }}" alt="Header Image" width="200"><br>
            @endif
            <input type="file" name="main_image" accept="image/*">
        </div>
        <br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>