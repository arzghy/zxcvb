

<?php $__env->startSection('page-title', 'Home Content Editor'); ?>
<?php $__env->startSection('page-breadcrumb', 'Kelola Konten Landing Page'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4 mt-2">
    <div>
        <h1 class="text-xl font-bold text-gray-900">Home Content Editor</h1>
        <p class="text-sm text-gray-500">Kelola konten hero section, ticker, dan statistik di landing page</p>
    </div>
    <button class="btn bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center gap-2 w-full sm:w-auto justify-center" onclick="saveHomeContent()">
        💾 Simpan Semua Perubahan
    </button>
</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
    
    <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-200 shadow-sm">
        <h2 class="font-bold text-lg text-gray-900 mb-5 flex items-center gap-2">🦸‍♂️ Hero Section</h2>
        
        <div class="mb-4">
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Eyebrow / Tagline Kecil</label>
            <input type="text" class="inp content-input w-full" name="hero_eyebrow" value="<?php echo e($contents['hero_eyebrow'] ?? ''); ?>" placeholder="The Biggest Capital Market Community...">
        </div>
        
        <div class="mb-4">
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Judul Utama (H1)</label>
            <input type="text" class="inp content-input w-full" name="hero_title" value="<?php echo e($contents['hero_title'] ?? ''); ?>" placeholder="Kelompok Studi Pasar Modal SV IPB">
        </div>
        
        <div class="mb-4">
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Deskripsi Hero</label>
            <textarea class="inp content-input w-full min-h-[100px]" name="hero_desc" placeholder="Explore in-depth market analysis..."><?php echo e($contents['hero_desc'] ?? ''); ?></textarea>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Tombol Utama (CTA 1)</label>
                <input type="text" class="inp content-input w-full" name="hero_cta1" value="<?php echo e($contents['hero_cta1'] ?? ''); ?>" placeholder="Events →">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Tombol Sekunder (CTA 2)</label>
                <input type="text" class="inp content-input w-full" name="hero_cta2" value="<?php echo e($contents['hero_cta2'] ?? ''); ?>" placeholder="Research →">
            </div>
        </div>
    </div>

    
    <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-200 shadow-sm">
        <h2 class="font-bold text-lg text-gray-900 mb-5 flex items-center gap-2">📊 Statistik Hero</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Stat 1 — Angka</label>
                <input type="text" class="inp content-input w-full" name="stat1_angka" value="<?php echo e($contents['stat1_angka'] ?? ''); ?>" placeholder="500+">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Stat 1 — Label</label>
                <input type="text" class="inp content-input w-full" name="stat1_label" value="<?php echo e($contents['stat1_label'] ?? ''); ?>" placeholder="Anggota & Alumni">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Stat 2 — Angka</label>
                <input type="text" class="inp content-input w-full" name="stat2_angka" value="<?php echo e($contents['stat2_angka'] ?? ''); ?>" placeholder="6">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Stat 2 — Label</label>
                <input type="text" class="inp content-input w-full" name="stat2_label" value="<?php echo e($contents['stat2_label'] ?? ''); ?>" placeholder="Divisi Aktif">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Stat 3 — Angka</label>
                <input type="text" class="inp content-input w-full" name="stat3_angka" value="<?php echo e($contents['stat3_angka'] ?? ''); ?>" placeholder="48+">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Stat 3 — Label</label>
                <input type="text" class="inp content-input w-full" name="stat3_label" value="<?php echo e($contents['stat3_label'] ?? ''); ?>" placeholder="Laporan Riset">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Stat 4 — Angka</label>
                <input type="text" class="inp content-input w-full" name="stat4_angka" value="<?php echo e($contents['stat4_angka'] ?? ''); ?>" placeholder="2019">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1.5">Stat 4 — Label</label>
                <input type="text" class="inp content-input w-full" name="stat4_label" value="<?php echo e($contents['stat4_label'] ?? ''); ?>" placeholder="Berdiri">
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-100 p-3 rounded-xl flex gap-2 items-start text-sm text-blue-700">
            <span class="shrink-0">💡</span>
            <p>Perubahan akan tampil di landing page saat pengunjung me-refresh halaman.</p>
        </div>
    </div>
</div>


<div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-200 shadow-sm mb-6">
    <div class="flex flex-col sm:flex-row sm:justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="font-bold text-lg text-gray-900 flex items-center gap-2">📈 Ticker Live Market</h2>
            <p class="text-sm text-gray-500">Saham yang tampil di header ticker bar</p>
        </div>
        <button class="btn bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-xl text-sm font-semibold transition w-full sm:w-auto" onclick="openTickerModal()">
            + Tambah Saham
        </button>
    </div>

    
    <div class="flex flex-col gap-3">
        <?php $__empty_1 = true; $__currentLoopData = $tickers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="border border-gray-200 rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-blue-300 hover:shadow-sm transition-all">
                
                
                <div class="flex items-center gap-4 w-full sm:w-auto">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center font-bold text-lg shrink-0 border border-blue-100">
                        <?php echo e(substr($tk->kode, 0, 1)); ?>

                    </div>
                    <div class="flex-1">
                        <div class="font-bold text-blue-800 text-base mb-0.5"><?php echo e($tk->kode); ?></div>
                        <div class="text-sm text-gray-600 font-medium">Rp <?php echo e(number_format($tk->harga, 0, ',', '.')); ?></div>
                    </div>
                </div>

                
                <div class="flex flex-col sm:items-end w-full sm:w-auto gap-1">
                    <div class="text-sm font-bold <?php echo e($tk->tren == 'up' ? 'text-green-500' : 'text-red-500'); ?>">
                        <?php echo e($tk->tren == 'up' ? '+' : '-'); ?><?php echo e($tk->change); ?> (<?php echo e($tk->tren == 'up' ? '+' : '-'); ?><?php echo e($tk->pct); ?>%)
                    </div>
                    <div class="flex items-center gap-2 mt-1">
                        <?php if($tk->tren == 'up'): ?>
                            <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-[0.65rem] font-bold uppercase tracking-wide">▲ Naik</span>
                        <?php else: ?>
                            <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded text-[0.65rem] font-bold uppercase tracking-wide">▼ Turun</span>
                        <?php endif; ?>
                        <span class="border border-gray-200 text-gray-600 px-2 py-0.5 rounded text-[0.65rem] font-bold uppercase tracking-wide"><?php echo e($tk->status); ?></span>
                    </div>
                </div>

                
                <div class="flex items-center gap-2 pt-3 border-t border-gray-100 sm:border-t-0 sm:pt-0 w-full sm:w-auto justify-end">
                    <button class="btn btn-ghost bg-gray-50 hover:bg-orange-50 text-orange-500 border border-gray-200 btn-sm px-3" onclick="editTicker(<?php echo e($tk); ?>)">✏️ Edit</button>
                    <form action="<?php echo e(route('admin.ticker.destroy', $tk->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Hapus saham ini?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-ghost bg-gray-50 hover:bg-red-50 text-red-500 border border-gray-200 btn-sm px-3">🗑️ Hapus</button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-10 bg-gray-50 rounded-xl border border-gray-200 border-dashed">
                <p class="text-gray-500 text-sm">Belum ada data saham yang ditambahkan.</p>
            </div>
        <?php endif; ?>
    </div>
</div>


<div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-200 shadow-sm mb-6">
    <h2 class="font-bold text-lg text-gray-900 mb-5 flex items-center gap-2">🔗 Social Media & Kontak</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">📷 Instagram URL</label>
            <input type="text" class="inp content-input w-full" name="soc_ig" value="<?php echo e($contents['soc_ig'] ?? ''); ?>" placeholder="https://instagram.com/kspmsvipb">
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">💼 LinkedIn URL</label>
            <input type="text" class="inp content-input w-full" name="soc_li" value="<?php echo e($contents['soc_li'] ?? ''); ?>" placeholder="https://linkedin.com/company/kspmsvipb">
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">▶️ YouTube URL</label>
            <input type="text" class="inp content-input w-full" name="soc_yt" value="<?php echo e($contents['soc_yt'] ?? ''); ?>" placeholder="https://youtube.com/@kspmsvipb">
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">🎵 TikTok URL</label>
            <input type="text" class="inp content-input w-full" name="soc_tk" value="<?php echo e($contents['soc_tk'] ?? ''); ?>" placeholder="https://tiktok.com/@kspmsvipb">
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">📧 Email Kontak</label>
            <input type="email" class="inp content-input w-full" name="soc_email" value="<?php echo e($contents['soc_email'] ?? ''); ?>" placeholder="info@kspmsvipb.ac.id">
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">📱 WhatsApp/HP</label>
            <input type="text" class="inp content-input w-full" name="soc_wa" value="<?php echo e($contents['soc_wa'] ?? ''); ?>" placeholder="081234567890">
        </div>
    </div>
</div>


<div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-200 shadow-sm mb-10">
    <h2 class="font-bold text-lg text-gray-900 mb-5 flex items-center gap-2">🔍 SEO & Meta</h2>
    <div class="mb-4">
        <label class="block text-xs font-semibold text-gray-500 mb-1.5">Judul Halaman (Title Tag)</label>
        <input type="text" class="inp content-input w-full" name="seo_title" value="<?php echo e($contents['seo_title'] ?? ''); ?>" placeholder="KSPM SV IPB — Kelompok Studi Pasar Modal">
    </div>
    <div>
        <label class="block text-xs font-semibold text-gray-500 mb-1.5">Deskripsi Meta</label>
        <textarea class="inp content-input w-full min-h-[80px]" name="seo_desc" placeholder="Kelompok Studi Pasar Modal..."><?php echo e($contents['seo_desc'] ?? ''); ?></textarea>
    </div>
</div>


<div class="modal-overlay fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4 overflow-y-auto" id="modal-ticker">
    <div class="modal bg-white rounded-2xl p-6 sm:p-7 w-full max-w-sm relative shadow-xl my-auto">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900" id="modal-ticker-title">Tambah Saham Ticker</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center shrink-0" onclick="closeTickerModal()">✕</button>
        </div>
        
        <input type="hidden" id="tk-id">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Kode Saham*</label>
                <input id="tk-kode" class="inp uppercase w-full" placeholder="BBCA">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Harga Saat Ini (Rp)</label>
                <input type="number" id="tk-harga" class="inp w-full" placeholder="9350">
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Perubahan (Rp)</label>
                <input type="number" id="tk-change" class="inp w-full" placeholder="125" step="0.01">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Perubahan (%)</label>
                <input type="number" id="tk-pct" class="inp w-full" placeholder="1.36" step="0.01">
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Tren</label>
                <select id="tk-tren" class="inp w-full">
                    <option value="up">▲ Naik</option>
                    <option value="down">▼ Turun</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 mb-1">Status</label>
                <select id="tk-status" class="inp w-full">
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                </select>
            </div>
        </div>
        <div class="pt-4 border-t border-gray-200 flex flex-col sm:flex-row justify-end gap-2.5">
            <button class="btn btn-ghost px-4 py-2 rounded-xl text-sm font-medium w-full sm:w-auto" onclick="closeTickerModal()">Batal</button>
            <button class="btn bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-xl font-semibold text-sm transition w-full sm:w-auto" onclick="saveTicker()">💾 Simpan</button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function showNotif(msg, type='success') {
        alert(msg);
    }

    // --- SIMPAN SEMUA KONTEN TEKS ---
    function saveHomeContent() {
        const inputs = document.querySelectorAll('.content-input');
        const data = {};
        
        inputs.forEach(el => {
            data[el.name] = el.value;
        });

        fetch("<?php echo e(route('admin.home_content.save')); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                showNotif('Seluruh konten homepage berhasil disimpan!');
            }
        }).catch(err => showNotif('Gagal menyimpan konten. Periksa koneksi Anda.', 'error'));
    }

    // --- MODAL TICKER LOGIC ---
    const modalTicker = document.getElementById('modal-ticker');

    function openTickerModal() {
        document.getElementById('modal-ticker-title').innerText = "Tambah Saham Ticker";
        document.getElementById('tk-id').value = '';
        document.getElementById('tk-kode').value = '';
        document.getElementById('tk-harga').value = '';
        document.getElementById('tk-change').value = '';
        document.getElementById('tk-pct').value = '';
        modalTicker.classList.remove('hidden');
        modalTicker.classList.add('flex');
    }

    function editTicker(data) {
        document.getElementById('modal-ticker-title').innerText = "Edit Saham Ticker";
        document.getElementById('tk-id').value = data.id;
        document.getElementById('tk-kode').value = data.kode;
        document.getElementById('tk-harga').value = data.harga;
        document.getElementById('tk-change').value = data.change;
        document.getElementById('tk-pct').value = data.pct;
        document.getElementById('tk-tren').value = data.tren;
        document.getElementById('tk-status').value = data.status;
        modalTicker.classList.remove('hidden');
        modalTicker.classList.add('flex');
    }

    function closeTickerModal() {
        modalTicker.classList.add('hidden');
        modalTicker.classList.remove('flex');
    }

    function saveTicker() {
        const id = document.getElementById('tk-id').value;
        const kode = document.getElementById('tk-kode').value.trim().toUpperCase();
        
        if (!kode) { showNotif('Kode saham wajib diisi!', 'error'); return; }

        const data = {
            id: id,
            kode: kode,
            harga: document.getElementById('tk-harga').value || 0,
            change: document.getElementById('tk-change').value || 0,
            pct: document.getElementById('tk-pct').value || 0,
            tren: document.getElementById('tk-tren').value,
            status: document.getElementById('tk-status').value,
        };

        fetch("<?php echo e(route('admin.ticker.save')); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
            },
            body: JSON.stringify(data)
        })
        .then(res => res.json())
        .then(response => {
            if(response.success) {
                showNotif(id ? 'Data ticker diperbarui!' : 'Saham ditambahkan ke ticker!');
                closeTickerModal();
                location.reload();
            }
        }).catch(err => showNotif('Gagal menyimpan saham', 'error'));
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\kspm-sisfor\zxcvb\resources\views/admin/home_content.blade.php ENDPATH**/ ?>