<!DOCTYPE html>
<html>
<head><title>KSPM SV IPB</title></head>
<body>
    <h2>Manajemen Kamus Pasar Modal</h2>
    @if(session('success')) <div style="color:green; margin-bottom:15px;">{{ session('success') }}</div> @endif

    <form action="{{ route('admin.dictionary.store') }}" method="POST" style="margin-bottom: 30px; padding: 15px; border: 1px solid #ccc;">
        @csrf
        <h3>Tambah Istilah Baru</h3>
        <div>
            <label>Istilah (Contoh: Bearish):</label><br>
            <input type="text" name="term" required>
        </div><br>
        <div>
            <label>Pengertian:</label><br>
            <textarea name="definition" rows="3" cols="50" required></textarea>
        </div><br>
        <button type="submit">Tambah Istilah</button>
    </form>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Istilah</th>
                <th>Pengertian</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($terms as $t)
            <tr>
                <td><strong>{{ $t->term }}</strong></td>
                <td>{{ $t->definition }}</td>
                <td>
                    <form action="{{ route('admin.dictionary.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus istilah ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color:red;">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>