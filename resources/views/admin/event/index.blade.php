<!DOCTYPE html>
<html>
<head><title>KSPM SV IPB</title></head>
<body>
    <h2>Kalender Event KSPM</h2>
    @if(session('success')) <div style="color:green;">{{ session('success') }}</div> @endif

    <form action="{{ route('admin.event.store') }}" method="POST" style="margin: 20px 0; border: 1px solid #ccc; padding: 15px;">
        @csrf
        <h3>Tambah Event Baru</h3>
        <div><label>Judul Acara:</label><br><input type="text" name="title" required></div><br>
        <div><label>Tanggal:</label><br><input type="date" name="event_date" required></div><br>
        <div><label>Lokasi (Ruang / Link Zoom):</label><br><input type="text" name="location" required></div><br>
        <div><label>Deskripsi Singkat:</label><br><textarea name="description" rows="3" required></textarea></div><br>
        <button type="submit">Tambah Event</button>
    </form>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr><th>Tanggal</th><th>Acara</th><th>Lokasi</th><th>Aksi</th></tr>
        @foreach($events as $e)
        <tr>
            <td>{{ \Carbon\Carbon::parse($e->event_date)->format('d M Y') }}</td>
            <td><strong>{{ $e->title }}</strong><br><small>{{ $e->description }}</small></td>
            <td>{{ $e->location }}</td>
            <td>
                <form action="{{ route('admin.event.destroy', $e->id) }}" method="POST">
                    @csrf @method('DELETE') <button type="submit" style="color:red;">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>