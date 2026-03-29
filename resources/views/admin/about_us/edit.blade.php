<!DOCTYPE html>
<html>
<head>
    <title>Edit Tentang Kami</title>
</head>
<body>
    <h2>Pengaturan Halaman Tentang Kami (KSPM)</h2>

    @if(session('success'))
        <div style="color: green; font-weight: bold; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.about_us.update') }}" method="POST">
        @csrf
        
        <div>
            <label>Sejarah KSPM:</label><br>
            <textarea name="history" rows="6" cols="50" required>{{ old('history', $aboutUs->history) }}</textarea>
        </div>
        <br>

        <div>
            <label>Visi:</label><br>
            <textarea name="vision" rows="4" cols="50" required>{{ old('vision', $aboutUs->vision) }}</textarea>
        </div>
        <br>

        <div>
            <label>Misi:</label><br>
            <textarea name="mission" rows="4" cols="50" required>{{ old('mission', $aboutUs->mission) }}</textarea>
            <small><br>*Gunakan enter (baris baru) untuk memisahkan setiap poin misi.</small>
        </div>
        <br>

        <button type="submit" style="padding: 10px 20px; cursor: pointer;">Simpan Perubahan</button>
    </form>
</body>
</html>