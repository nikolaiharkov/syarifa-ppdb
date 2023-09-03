                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Informasi Pembayaran</h1>
                    </div>

                    <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Pembayaran Siswa</h6>

</div>

                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Status Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Status Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
    <tbody>
    <?php
    $no = 1;
    foreach ($data_siswa as $siswa) {
        if ($siswa['status'] > 1) {
    ?>
    <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $siswa['nama_lengkap']; ?></td>
        <td>
        <?php if ($siswa['status'] == 2): ?>
    <span class="badge badge-primary">Menunggu Pembayaran Formulir</span>
<?php elseif ($siswa['status'] == 3): ?>
    <span class="badge badge-success">Pembayaran Formulir Berhasil, Menunggu Pembayaran Biaya Masuk</span>
<?php elseif ($siswa['status'] == 4): ?>
    <span class="badge badge-danger">Formulir Ditolak</span>
<?php elseif ($siswa['status'] == 5): ?>
    <span class="badge badge-danger">Ada Kesalahan Pembayaran Biaya Masuk, Harap Hubungi Admin</span>
<?php elseif ($siswa['status'] == 6): ?>
    <span class="badge badge-success">Pembayaran Biaya Masuk Berhasil</span>
<?php elseif ($siswa['status'] == 7): ?>
    <span class="badge badge-warning">Menunggu Validasi Pembayaran Formulir</span>
<?php elseif ($siswa['status'] == 8): ?>
    <span class="badge badge-warning">Menunggu Validasi Pembayaran Biaya Masuk</span>
<?php endif; ?>

        </td>
        <td>
        <?php if ($siswa['status'] == 2): ?>
        <button type="button" class="btn btn-warning btn-sm" onclick="showPembayaranModal(<?php echo $siswa['idsiswa']; ?>)">
    <i class="fas fa-money-bill"></i> Pembayaran Formulir
</button>
<?php elseif ($siswa['status'] == 3): ?>
    <button type="button" class="btn btn-success btn-sm" onclick="showPembayaranBMS(<?php echo $siswa['idsiswa']; ?>)">
    <i class="fas fa-money-bill"></i> Pembayaran Biaya Masuk
</button>

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

                    <div class="modal fade" id="pembayaranModal" tabindex="-1" role="dialog" aria-labelledby="pembayaranModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pembayaranModalLabel">Pembayaran Formulir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Keterangan: Biaya formulir sebesar <strong>Rp. 250.000</strong></p>
                <form id="uploadForm" action="<?php echo site_url('pembayaran/uploadBuktiBayarFormulir'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="idsiswa" name="idsiswa" value="">
                    <div class="form-group">
    <label for="kategori_bms">Pilih Kategori</label>
    <select class="form-control" id="kategori_bms" name="kategori_bms">
        <?php foreach ($kategori_bms as $kategori): ?>
            <option value="<?= $kategori['idbms'] ?>"><?= $kategori['nama_bms'] ?></option>
        <?php endforeach; ?>
    </select>
</div>

                    <div class="form-group">
                        <label for="buktiPembayaran">Upload Bukti Pembayaran</label>
                        <input type="file" class="form-control" id="buktiPembayaran" name="buktiPembayaran" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="pembayaranBMSModal" tabindex="-1" role="dialog" aria-labelledby="pembayaranBMSModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pembayaranBMSModalLabel">Pembayaran Biaya Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Konten modal -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <!-- Tombol submit form akan ditambahkan di sini -->
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
    function showPembayaranModal(idsiswa) {
        var modal = $('#pembayaranModal');
        modal.find('#idsiswa').val(idsiswa);
        modal.modal('show');
    }
</script>

<script>
function formatRupiah(angka) {
    var reverse = angka.toString().split('').reverse().join('');
    var ribuan = reverse.match(/\d{1,3}/g);
    var formatted = ribuan.join('.').split('').reverse().join('');
    return 'Rp ' + formatted;
}

function showPembayaranBMS(idsiswa) {
    // Tampilkan modal pembayaranBMSModal
    $('#pembayaranBMSModal').modal('show');

    // Lakukan permintaan AJAX untuk mengambil data dari tbl_kategori_bms
    $.ajax({
        url: '<?= base_url('pembayaran/getDataPembayaranBMS/') ?>' + idsiswa, // Ganti URL sesuai dengan controller Anda
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Isi modal dengan data yang diambil
            var modalContent = `
                <p>Kelas yang dipilih: ${data.nama_bms}</p>
                <p>Detail Biaya: ${data.detail_bms}</p>
                <p>Total Biaya: ${formatRupiah(data.total_bms)}</p>
                <p>Biaya yang harus dibayarkan: ${formatRupiah(data.biaya_harus_dibayarkan)}</p>
                <form id="uploadForm" action="<?php echo site_url('pembayaran/uploadBuktiBayarBMS'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="idsiswa" name="idsiswa" value="${idsiswa}">
                    <div class="form-group">
                        <label for="buktiPembayaran">Upload Bukti Transfer</label>
                        <input type="file" class="form-control-file" id="buktiPembayaran" name="buktiPembayaran" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            `;

            // Isi konten modal dengan data yang diambil
            $('.modal-body').html(modalContent);
        },
        error: function () {
            alert('Gagal mengambil data biaya masuk.');
        }
    });
}


</script>



