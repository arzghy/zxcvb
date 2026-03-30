<!DOCTYPE html>
<html>
<head>
    <title>KSPM SV IPB</title>
</head>
<body>
    <h2>Pengaturan Profil Organisasi (Ketua & Pengurus)</h2>

    @if(session('success'))
        <div style="color: green; margin-bottom:10px;">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.organization.create') }}" style="display:inline-block; margin-bottom: 20px; padding:8px; background:blue; color:white; text-decoration:none;">+ Tambah Pengurus Baru</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Periode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td><img src="{{ asset('storage/' . $member->photo) }}" width="80" alt="Foto"></td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->position }}</td>
                <td>{{ $member->period }}</td>
                <td>
                    <form action="{{ route('admin.organization.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:red; color:white;">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>