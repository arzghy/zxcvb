

<?php $__env->startSection('page-title', 'Info Lomba'); ?>
<?php $__env->startSection('page-breadcrumb', 'Kelola Lomba'); ?>

<?php $__env->startSection('content'); ?>
<div class="section-header flex items-center justify-between mb-5 mt-2 gap-3 flex-wrap">
    <div>
        <div class="section-title text-lg font-bold text-gray-900">Data Perlombaan</div>
        <div class="section-sub text-sm text-gray-500">Kelola informasi lomba untuk mahasiswa</div>
    </div>
    <div class="flex gap-2 flex-wrap">
        <div class="search-bar relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">🔍</span>
            <input type="text" id="search-input" class="inp inp-sm pl-9" placeholder="Cari lomba...">
        </div>
        <select id="filter-type" class="inp inp-sm" style="width:auto">
            <option value="">Semua Kategori</option>
            <option value="Analisis Saham">Analisis Saham</option>
            <option value="Business Plan">Business Plan</option>
            <option value="Essay">Essay</option>
            <option value="Karya Ilmiah">Karya Ilmiah</option>
            <option value="Debat">Debat</option>
            <option value="Trading Competition">Trading</option>
            <option value="Lainnya">Lainnya</option>
        </select>
        <button class="btn btn-primary btn-sm" onclick="openModal('modal-tambah-lomba')">+ Tambah Lomba</button>
    </div>
</div>


<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" id="lomba-grid">
    <?php $__empty_1 = true; $__currentLoopData = $lombas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $statusClass = match($lm->status) {
                'Buka' => 'bg-green-100 text-green-800',
                'Segera Tutup' => 'bg-yellow-100 text-yellow-800',
                'Tutup' => 'bg-red-100 text-red-800',
                default => 'bg-gray-100 text-gray-800',
            };
        ?>
        
        <div class="card bg-white p-5 rounded-2xl border border-gray-200 hover:border-blue-300 hover:shadow-md transition relative flex flex-col h-full lomba-card-item" data-category="<?php echo e(strtolower($lm->category)); ?>">
            
            <div class="absolute top-5 right-5">
                <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider <?php echo e($statusClass); ?>">
                    <?php echo e($lm->status); ?>

                </span>
            </div>

            
            <div class="flex items-center gap-2 mb-3">
                <span class="text-2xl">🏆</span>
                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                    <?php echo e($lm->category); ?>

                </span>
            </div>

            
            <div class="font-bold text-[1.05rem] text-gray-900 mb-1 pr-16 leading-tight">
                <?php echo e($lm->title); ?>

                <?php if(!$lm->is_published): ?>
                    <span class="text-[0.65rem] bg-gray-100 text-gray-500 px-1.5 py-0.5 rounded ml-1 font-normal align-middle">Draft</span>
                <?php endif; ?>
            </div>
            
            
            <div class="text-[0.8rem] text-gray-500 mb-4"><?php echo e($lm->organizer); ?></div>

            
            <div class="flex flex-col gap-1.5 mb-4 text-[0.8rem] text-gray-700">
                <div class="flex items-start gap-2">
                    <span>📅</span>
                    <span>Deadline: 
                        <strong class="<?php echo e(\Carbon\Carbon::parse($lm->registration_deadline)->isPast() ? 'text-red-500' : ''); ?>">
                            <?php echo e(\Carbon\Carbon::parse($lm->registration_deadline)->format('d M Y')); ?>

                        </strong>
                    </span>
                </div>
                <div class="flex items-start gap-2">
                    <span>🌍</span>
                    <span>Tingkat: <strong><?php echo e($lm->level ?? '-'); ?></strong></span>
                </div>
                <div class="flex items-start gap-2">
                    <span>💰</span>
                    <span>Hadiah: <strong class="text-green-600"><?php echo e($lm->prize ?? '-'); ?></strong></span>
                </div>
            </div>

            
            <div class="text-[0.8rem] text-gray-500 mb-5 line-clamp-2 flex-1 leading-relaxed">
                <?php echo e($lm->description ?: 'Tidak ada deskripsi.'); ?>

            </div>

            
            <div class="flex gap-2 flex-wrap mt-auto pt-4 border-t border-gray-100">
                <?php if($lm->registration_link): ?>
                    <a href="<?php echo e($lm->registration_link); ?>" target="_blank" class="btn btn-primary btn-sm flex-1 justify-center text-center">🔗 Daftar</a>
                <?php endif; ?>
                <button type="button" class="btn btn-ghost bg-gray-50 hover:bg-gray-100 border border-gray-200 btn-sm btn-edit flex-1 justify-center" data-lomba="<?php echo e(json_encode($lm)); ?>">✏️ Edit</button>
                <button type="button" class="btn btn-ghost bg-red-50 hover:bg-red-100 text-red-500 border border-red-100 btn-sm btn-delete-trigger px-3" data-url="<?php echo e(route('admin.lomba.destroy', $lm->id)); ?>" data-title="<?php echo e($lm->title); ?>">🗑️</button>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div id="empty-db" class="col-span-full bg-white p-16 rounded-2xl border border-gray-200 flex flex-col items-center justify-center text-center">
            <div class="text-4xl opacity-40 mb-3">🏆</div>
            <p class="text-sm font-semibold text-gray-500">Belum ada data lomba</p>
            <p class="text-xs text-gray-400 mt-1">Tambahkan lomba baru dengan tombol "+ Tambah Lomba"</p>
        </div>
    <?php endif; ?>

    
    <div id="empty-state" style="display: none;" class="col-span-full bg-white p-16 rounded-2xl border border-gray-200 flex flex-col items-center justify-center text-center">
        <div class="text-4xl opacity-40 mb-3">📭</div>
        <p class="text-sm font-semibold text-gray-500">Lomba tidak tersedia</p>
        <p class="text-xs text-gray-400 mt-1">Coba gunakan kata kunci pencarian atau kategori yang lain.</p>
    </div>
</div>


<div class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" id="modal-tambah-lomba">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-2xl max-h-[90vh] overflow-y-auto relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Tambah Info Lomba</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="closeModal('modal-tambah-lomba')">✕</button>
        </div>
        <form action="<?php echo e(route('admin.lomba.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Nama Lomba*</label>
                <input class="inp" name="title" required placeholder="Nama kompetisi / lomba">
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Kategori*</label>
                    <select class="inp" name="category" required>
                        <option value="Analisis Saham">Analisis Saham</option>
                        <option value="Business Plan">Business Plan</option>
                        <option value="Essay">Essay</option>
                        <option value="Karya Ilmiah">Karya Ilmiah</option>
                        <option value="Debat">Debat</option>
                        <option value="Trading Competition">Trading Competition</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Penyelenggara*</label>
                    <input class="inp" name="organizer" required placeholder="Nama institusi">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Deadline Pendaftaran*</label>
                    <input type="date" class="inp" name="registration_deadline" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal Pelaksanaan</label>
                    <input type="date" class="inp" name="event_date">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tingkat</label>
                    <select class="inp" name="level">
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                        <option value="Regional">Regional</option>
                        <option value="Kampus">Kampus</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Total Hadiah</label>
                    <input class="inp" name="prize" placeholder="Rp 10.000.000" oninput="formatHadiah(this)">
                </div>
            </div>

            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Deskripsi / Ketentuan</label>
                <textarea class="inp" name="description" rows="3" placeholder="Jelaskan persyaratan, ketentuan..."></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Link Pendaftaran</label>
                    <input class="inp" name="registration_link" placeholder="https://...">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Kontak Panitia</label>
                    <input class="inp" name="contact" placeholder="WA/email panitia">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Status</label>
                    <select class="inp" name="status">
                        <option value="Buka">Buka</option>
                        <option value="Segera Tutup">Segera Tutup</option>
                        <option value="Tutup">Tutup</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tampil di Homepage</label>
                    <select class="inp" name="is_published">
                        <option value="1">Ya, publikasikan</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
            </div>

            <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-tambah-lomba')">Batal</button>
                <button type="submit" class="btn btn-primary">🏆 Simpan Lomba</button>
            </div>
        </form>
    </div>
</div>


<div class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" id="modal-edit-lomba">
    <div class="modal bg-white rounded-2xl p-7 w-full max-w-2xl max-h-[90vh] overflow-y-auto relative">
        <div class="modal-header flex items-center justify-between mb-5 pb-3.5 border-b border-gray-200">
            <div class="modal-title text-base font-bold text-gray-900">Edit Info Lomba</div>
            <button class="w-8 h-8 rounded-lg bg-gray-100 text-gray-500 hover:bg-red-100 hover:text-red-500 transition flex items-center justify-center" onclick="closeModal('modal-edit-lomba')">✕</button>
        </div>
        <form id="form-edit-lomba" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Nama Lomba*</label>
                <input class="inp" name="title" id="edit-title" required placeholder="Nama kompetisi / lomba">
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Kategori*</label>
                    <select class="inp" name="category" id="edit-category" required>
                        <option value="Analisis Saham">Analisis Saham</option>
                        <option value="Business Plan">Business Plan</option>
                        <option value="Essay">Essay</option>
                        <option value="Karya Ilmiah">Karya Ilmiah</option>
                        <option value="Debat">Debat</option>
                        <option value="Trading Competition">Trading Competition</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Penyelenggara*</label>
                    <input class="inp" name="organizer" id="edit-organizer" required placeholder="Nama institusi">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Deadline Pendaftaran*</label>
                    <input type="date" class="inp" name="registration_deadline" id="edit-deadline" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tanggal Pelaksanaan</label>
                    <input type="date" class="inp" name="event_date" id="edit-date">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tingkat</label>
                    <select class="inp" name="level" id="edit-level">
                        <option value="Nasional">Nasional</option>
                        <option value="Internasional">Internasional</option>
                        <option value="Regional">Regional</option>
                        <option value="Kampus">Kampus</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Total Hadiah</label>
                    <input class="inp" name="prize" id="edit-prize" placeholder="Rp 10.000.000" oninput="formatHadiah(this)">
                </div>
            </div>

            <div class="mb-3.5">
                <label class="block text-xs font-semibold text-gray-500 mb-1">Deskripsi / Ketentuan</label>
                <textarea class="inp" name="description" id="edit-desc" rows="3" placeholder="Jelaskan persyaratan, ketentuan..."></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Link Pendaftaran</label>
                    <input class="inp" name="registration_link" id="edit-link" placeholder="https://...">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Kontak Panitia</label>
                    <input class="inp" name="contact" id="edit-contact" placeholder="WA/email panitia">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3.5">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Status</label>
                    <select class="inp" name="status" id="edit-status">
                        <option value="Buka">Buka</option>
                        <option value="Segera Tutup">Segera Tutup</option>
                        <option value="Tutup">Tutup</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 mb-1">Tampil di Homepage</label>
                    <select class="inp" name="is_published" id="edit-publish">
                        <option value="1">Ya, publikasikan</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
            </div>

            <div class="mt-5 pt-4 border-t border-gray-200 flex justify-end gap-2.5">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-edit-lomba')">Batal</button>
                <button type="submit" class="btn btn-primary">🏆 Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>


<div class="modal-overlay fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" id="modal-delete">
    <div class="modal bg-white rounded-2xl p-8 w-full max-w-[400px] text-center relative">
        <div class="text-5xl mb-4">🗑️</div>
        <div class="text-lg font-bold text-gray-900 mb-2">Hapus Data?</div>
        <div class="text-sm text-gray-500 mb-6" id="delete-msg">Data lomba ini akan dihapus permanen.</div>
        
        <form id="form-delete-lomba" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <div class="flex gap-2.5 justify-center">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-delete')">Batal</button>
                <button type="submit" class="btn bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl font-semibold transition">🗑️ Hapus</button>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .modal-overlay.open { display: flex !important; }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function openModal(id) { document.getElementById(id).classList.add('open'); }
    function closeModal(id) { document.getElementById(id).classList.remove('open'); }

    // Fungsi Format Rupiah Otomatis di Input Hadiah
    function formatHadiah(input) {
        let value = input.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        input.value = rupiah ? 'Rp ' + rupiah : '';
    }

    // Modal Edit Lomba
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const lm = JSON.parse(this.dataset.lomba);
            const form = document.getElementById('form-edit-lomba');
            
            form.action = `/admin/lomba/${lm.id}`;

            document.getElementById('edit-title').value = lm.title;
            document.getElementById('edit-category').value = lm.category || 'Lainnya';
            document.getElementById('edit-organizer').value = lm.organizer;
            document.getElementById('edit-deadline').value = lm.registration_deadline;
            document.getElementById('edit-date').value = lm.event_date || '';
            document.getElementById('edit-level').value = lm.level || 'Nasional';
            document.getElementById('edit-prize').value = lm.prize || '';
            document.getElementById('edit-desc').value = lm.description || '';
            document.getElementById('edit-link').value = lm.registration_link || '';
            document.getElementById('edit-contact').value = lm.contact || '';
            document.getElementById('edit-status').value = lm.status || 'Buka';
            document.getElementById('edit-publish').value = lm.is_published ? "1" : "0";

            openModal('modal-edit-lomba');
        });
    });

    // Modal Delete
    document.querySelectorAll('.btn-delete-trigger').forEach(btn => {
        btn.addEventListener('click', function() {
            const url = this.dataset.url;
            const title = this.dataset.title;
            
            document.getElementById('form-delete-lomba').action = url;
            document.getElementById('delete-msg').innerHTML = `Lomba <b>"${title}"</b> akan dihapus permanen.`;
            
            openModal('modal-delete');
        });
    });

    // Fitur Pencarian & Filter Kategori (Disesuaikan untuk grid card)
    const searchInput = document.getElementById('search-input');
    const filterType = document.getElementById('filter-type');
    const eventCards = document.querySelectorAll('.lomba-card-item');
    const emptyState = document.getElementById('empty-state');

    function filterLomba() {
        const query = searchInput.value.toLowerCase();
        const type = filterType.value.toLowerCase();
        let visibleCount = 0;

        eventCards.forEach(card => {
            const textContent = card.textContent.toLowerCase();
            const cardType = card.getAttribute('data-category');

            const matchesSearch = textContent.includes(query);
            const matchesType = (type === '' || cardType === type);

            if (matchesSearch && matchesType) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        if (eventCards.length > 0) {
            emptyState.style.display = visibleCount === 0 ? 'flex' : 'none';
        }
    }

    searchInput.addEventListener('input', filterLomba);
    filterType.addEventListener('change', filterLomba);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\kspm-sisfor\zxcvb\resources\views/admin/lomba.blade.php ENDPATH**/ ?>