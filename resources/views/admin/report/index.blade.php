<!DOCTYPE html>
<html>
<head><title>KSPM SV IPB</title></head>
<body>
    <h2>Upload Laporan Riset / Weekly Outlook</h2>
    
    @if($errors->any()) <div style="color:red;">Format harus PDF dan maksimal 10MB</div> @endif
    @if(session('success')) <div style="color:green;">{{ session('success') }}</div> @endif

    <form action="{{ route('admin.report.store') }}" method="POST" enctype="multipart/form-data" style="margin: 20px 0; border: 1px solid #ccc; padding: 15px;">
        @csrf
        <h3>Upload Laporan Baru</h3>
        <div><label>Judul Laporan:</label><br><input type="text" name="title" required></div><br>
        <div><label>File PDF:</label><br><input type="file" name="pdf_file" accept="application/pdf" required></div><br>
        <button type="submit">Upload Laporan</button>
    </form>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr><th>Tgl Upload</th><th>Judul Laporan</th><th>File</th><th>Aksi</th></tr>
        @foreach($reports as $r)
        <tr>
            <td>{{ $r->created_at->format('d M Y') }}</td>
            <td>{{ $r->title }}</td>
            <td><a href="{{ asset('storage/' . $r->pdf_file) }}" target="_blank">Lihat PDF</a></td>
            <td>
                <form action="{{ route('admin.report.destroy', $r->id) }}" method="POST">
                    @csrf @method('DELETE') <button type="submit" style="color:red;">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>