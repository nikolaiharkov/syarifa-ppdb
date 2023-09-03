                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Informasi Pembayaran Formulir</h1>
                    </div>

                    <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Pembayaran Formulir Siswa</h6>

</div>

                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Nama Orang Tua</th>
            <th>Tanggal Pembayaran</th>
            <th>Status Pembayaran</th>
            <th>Bukti Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Nama Orang Tua</th>
            <th>Tanggal Pembayaran</th>
            <th>Status Pembayaran</th>
            <th>Bukti Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
    <tbody>
    <?php
    $no = 1;
    foreach ($data_pembayaran as $pembayaran) {
        $status_pembayaran = $pembayaran['status'];
        
        if ($status_pembayaran == 7 || $status_pembayaran == 3 || $status_pembayaran >= 4) {
            $nama_lengkap = $pembayaran['nama_lengkap'];
            $nama_orang_tua = $pembayaran['nama_pendaftar'];
            $tanggal_pembayaran = $pembayaran['tgl_formulir'];
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $nama_lengkap ?></td>
                <td><?= $nama_orang_tua ?></td>
                <td><?= $tanggal_pembayaran ?></td>
                <td>
    <?php
    if ($status_pembayaran == 7) {
        echo 'Menunggu Validasi Admin';
    } elseif ($status_pembayaran == 4) {
        echo 'Formulir Ditolak';
    } else {
        echo 'Validasi Formulir diterima';
    }
    ?>
</td>
<td>
<?php if ($status_pembayaran > 3): ?>
    <a href="<?= base_url('buktipembayaran/') . $pembayaran['bukti_formulir'] ?>" target="_blank" class="btn btn-primary btn-sm">Lihat Bukti Pembayaran Formulir</a>
    <?php endif; ?>

</td>
<td>
<?php if ($status_pembayaran == 7): ?>
    <button type="button" class="btn btn-success btn-sm" onclick="konfirmasiTerima(<?= $pembayaran['idsiswa'] ?>)">Terima Formulir</button>
        <button type="button" class="btn btn-danger btn-sm" onclick="konfirmasiTolak(<?= $pembayaran['idsiswa'] ?>)">Tolak Formulir</button>
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

                    <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="konfirmasiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="konfirmasiModalLabel">Konfirmasi Terima Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menerima siswa ini?</p>
                <div id="totalBiaya"></div>
                <div class="form-group">
                    <label for="diskon">Diskon dalam bentuk (%)</label>
                    <input type="number" class="form-control" id="diskon" name="diskon">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" onclick="terimaSiswa()">Terima</button>
            </div>
        </div>
    </div>
</div>



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

<script>
function konfirmasiTerima(idsiswa) {
    // Tampilkan modal konfirmasi
    $('#konfirmasiModal').modal('show');

    // Lakukan permintaan AJAX untuk mendapatkan total biaya
    $.ajax({
        url: '<?= base_url('pembayaran/getTotalBiaya/') ?>' + idsiswa, // Ganti URL sesuai dengan controller Anda
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Fungsi untuk mengubah angka menjadi format rupiah
            function formatRupiah(angka) {
                var reverse = angka.toString().split('').reverse().join('');
                var ribuan = reverse.match(/\d{1,3}/g);
                var formatted = ribuan.join('.').split('').reverse().join('');
                return 'Rp ' + formatted;
            }

            // Mengubah nilai total_biaya ke format rupiah
            var totalBiayaRupiah = formatRupiah(data.total_biaya);

            // Tampilkan total biaya dalam modal dalam format rupiah
            $('#totalBiaya').html('<strong>Total Biaya:</strong> ' + totalBiayaRupiah);
        },
        error: function () {
            alert('Gagal mengambil total biaya.');
        }
    });
}


function terimaSiswa() {
    // Ambil nilai diskon dari input
    var diskon = $('#diskon').val();

    // Lakukan permintaan AJAX untuk mengupdate status dan diskon
    $.ajax({
        url: '<?= base_url('pembayaran/updateFormulir/') ?>' + <?= $pembayaran['idsiswa'] ?> + '/3/' + diskon,
        type: 'GET',
        success: function (response) {
            // Cek jika berhasil diupdate
            if (response == 'success') {
                // Jika sukses, tampilkan pesan dari flashdata
                alert('Siswa berhasil diterima.');
            }

            // Tutup modal konfirmasi
            $('#konfirmasiModal').modal('hide');
        },
        error: function () {
            alert('Gagal mengupdate status siswa.');
            $('#konfirmasiModal').modal('hide');
        }
    });
}



    function konfirmasiTolak(idsiswa) {
        if (confirm("Apakah Anda yakin ingin menolak formulir ini?")) {
            window.location.href = '<?= base_url('pembayaran/updateFormulir/') ?>' + idsiswa + '/4';
        }
    }
</script>

