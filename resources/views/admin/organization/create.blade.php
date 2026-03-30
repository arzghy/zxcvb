<!DOCTYPE html>
<html>
<head>
    <title>KSPM SV IPB</title>
</head>
<body>
    <h2>Tambah Data Pengurus</h2>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.organization.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Nama Lengkap:</label><br>
            <input type="text" name="name" required>
        </div><br>

        <div>
            <label>Jabatan (cth: Ketua Umum):</label><br>
            <input type="text" name="position" required>
        </div><br>

        <div>
            <label>Periode Jabatan (cth: 2024-2025):</label><br>
            <input type="text" name="period" required>
        </div><br>

        <div>
            <label>Foto Profil:</label><br>
            <input type="file" name="photo" accept="image/*" required>
        </div><br>

        <button type="submit">Simpan Data</button>
        <a href="{{ route('admin.organization.index') }}">Batal</a>
    </form>
</body>
</html>