<!DOCTYPE html>
<html>
<head><title>KSPM SV IPB</title></head>
<body>
    <h2>Pengaturan Parameter Simulasi Nabung Saham</h2>
    @if(session('success')) <div style="color:green; margin-bottom:15px;">{{ session('success') }}</div> @endif

    <form action="{{ route('admin.simulation.update') }}" method="POST">
        @csrf
        <div>
            <label>Bunga Bank per Tahun (%):</label><br>
            <input type="number" step="0.01" name="bank_interest" value="{{ old('bank_interest', $sim->bank_interest) }}" required>
        </div><br>
        
        <div>
            <label>Rata-rata Return Saham per Tahun (%):</label><br>
            <input type="number" step="0.01" name="stock_return" value="{{ old('stock_return', $sim->stock_return) }}" required>
        </div><br>

        <button type="submit">Simpan Parameter</button>
    </form>
</body>
</html>