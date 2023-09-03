                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Informasi Pembayaran Biaya Masuk Sekolah</h1>
                    </div>

                    <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Pembayaran Biaya Masuk Sekolah</h6>

</div>

                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Nama Orang Tua</th>
            <th>Status Pembayaran</th>
            <th>bukti Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Nama Orang Tua</th>
            <th>Status Pembayaran</th>
            <th>bukti Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
    <tbody>
    <?php
    $no = 1;
    foreach ($data_pembayaran as $pembayaran) {
        $status_pembayaran = $pembayaran['status'];
        
        if ($status_pembayaran == 3 || $status_pembayaran == 5 || $status_pembayaran == 6 || $status_pembayaran == 8) {
            $nama_lengkap = $pembayaran['nama_lengkap'];
            $nama_orang_tua = $pembayaran['nama_pendaftar'];
            $tanggal_pembayaran = $pembayaran['tgl_formulir'];
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $nama_lengkap ?></td>
                <td><?= $nama_orang_tua ?></td>
                <td>
    <?php
    if ($status_pembayaran == 3) {
        echo 'Menunggu Pembayaran Biaya Masuk';
    } elseif ($status_pembayaran == 5) {
        echo 'Ada Kesalahan Pembayaran Biaya Masuk';
    } elseif ($status_pembayaran == 6) {
        echo 'Pembayaran Biaya Masuk Berhasil';
    } else {
        echo 'Menunggu Validasi Pembayaran Biaya Masuk';
    }
    ?>
</td>
<td>
<?php if ($status_pembayaran == 8 || $status_pembayaran == 6 ): ?>
    <a href="<?= base_url('buktipembayaran/') . $pembayaran['bukti_bms'] ?>" target="_blank" class="btn btn-primary btn-sm">Lihat Bukti Pembayaran BMS</a>
    <?php endif; ?>

</td>
<td>
        <?php if ($status_pembayaran == 8): ?>
            <button type="button" class="btn btn-success btn-sm" onclick="konfirmasiTerimaBMS(<?= $pembayaran['idsiswa'] ?>)">Terima BMS</button>
        <button type="button" class="btn btn-danger btn-sm" onclick="konfirmasiTolakBMS(<?= $pembayaran['idsiswa'] ?>)">Tolak BMS</button>
    
        <?php endif; ?>

</td>


            </tr>
        <?php
            $no++;
        }
    }
    ?>
</tbody>

</table>

                            </div>
                        </div>
                    </div>

                    <script>
function konfirmasiTerimaBMS(idsiswa) {
    if (confirm("Apakah Anda yakin ingin menerima siswa ini?")) {
        // Jika user mengklik "OK" pada pesan konfirmasi, lakukan permintaan AJAX
        $.ajax({
            url: '<?= base_url('pembayaran/terimaSiswaBMS/') ?>' + idsiswa, // Ganti URL sesuai dengan controller Anda
            type: 'GET',
            success: function(response) {
                if (response === 'success') {
                    // Jika berhasil, tampilkan pesan sukses atau lakukan tindakan lain
                    alert('Siswa berhasil diterima.');
                    // Refresh halaman atau lakukan tindakan lain jika diperlukan
                    location.reload(); // Ini akan merefresh halaman
                } else {
                    // Jika terjadi kesalahan, tampilkan pesan kesalahan
                    alert('Gagal menerima siswa.');
                }
            },
            error: function() {
                // Jika terjadi kesalahan pada permintaan AJAX
                alert('Terjadi kesalahan saat menghubungi server.');
            }
        });
    } else {
        // Jika user mengklik "Batal" pada pesan konfirmasi, tidak ada tindakan yang diambil
        // Anda dapat menambahkan tindakan tambahan di sini jika diperlukan
    }
}
</script>

<script>
function konfirmasiTolakBMS(idsiswa) {
    if (confirm("Apakah Anda yakin ingin menolak pembayaran siswa ini?")) {
        // Jika user mengklik "OK" pada pesan konfirmasi, lakukan permintaan AJAX
        $.ajax({
            url: '<?= base_url('pembayaran/tolakSiswaBMS/') ?>' + idsiswa, // Ganti URL sesuai dengan controller Anda
            type: 'GET',
            success: function(response) {
                if (response === 'success') {
                    // Jika berhasil, tampilkan pesan sukses atau lakukan tindakan lain
                    alert('Siswa berhasil ditolak.');
                    // Refresh halaman atau lakukan tindakan lain jika diperlukan
                    location.reload(); // Ini akan merefresh halaman
                } else {
                    // Jika terjadi kesalahan, tampilkan pesan kesalahan
                    alert('Gagal menolak siswa.');
                }
            },
            error: function() {
                // Jika terjadi kesalahan pada permintaan AJAX
                alert('Terjadi kesalahan saat menghubungi server.');
            }
        });
    } else {
        // Jika user mengklik "Batal" pada pesan konfirmasi, tidak ada tindakan yang diambil
        // Anda dapat menambahkan tindakan tambahan di sini jika diperlukan
    }
}
</script>

<!-- Tambahkan di bagian yang sesuai -->
<?php if ($this->session->flashdata('success_message')) : ?>
    <script>
        alert("<?= $this->session->flashdata('success_message') ?>");
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error_message')) : ?>
    <script>
        alert("<?= $this->session->flashdata('error_message') ?>");
    </script>
<?php endif; ?>

