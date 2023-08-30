                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Management Kategori Biaya</h1>
                    </div>

                    <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori Biaya</h6>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahAdmin">
    Tambah Kategori Biaya
</button>
</div>

                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Keterangan</th>
            <th>Total Biaya</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>No</th>
            <th>Nama Kategori</th>
            <th>Keterangan</th>
            <th>Total Biaya</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        $no = 1;
        foreach ($data_kategori as $kategori) {
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $kategori['nama_bms'] ?></td>
                <td><?= $kategori['detail_bms'] ?></td>
                <td>Rp. <?= number_format($kategori['total_bms'], 0, ',', '.') ?></td>
                <td>
    <button type="button" class="btn btn-primary btn-sm" onclick="editKategori(<?= $kategori['idbms'] ?>)">Edit</button>
    <button type="button" class="btn btn-danger btn-sm" onclick="konfirmasiHapusKategori(<?= $kategori['idbms'] ?>)">Hapus</button>
</td>


            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
</table>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalTambahAdmin" tabindex="-1" role="dialog" aria-labelledby="modalTambahAdminLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahAdminLabel">Tambah Kategori Biaya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url('pembayaran/TambahKategori'); ?>" method="post">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="total_biaya">Total Biaya</label>
                        <input type="number" class="form-control" id="total_biaya" name="total_biaya" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditAdmin" tabindex="-1" role="dialog" aria-labelledby="modalEditAdminLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahAdminLabel">Tambah Kategori Biaya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url('pembayaran/EditKategori'); ?>" method="post">
                    <input type="hidden" id="idbms" name="idbms" value="">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="total_biaya">Total Biaya</label>
                        <input type="number" class="form-control" id="total_biaya" name="total_biaya" step="0.01" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
function editKategori(id) {
    // Menggunakan AJAX untuk mengambil data kategori
    $.ajax({
        url: '<?= site_url('pembayaran/getKategoriById/') ?>' + id,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Mengisi form dengan data yang diambil dari server
            $('#modalEditAdmin #idbms').val(data.idbms);
            $('#modalEditAdmin #nama_kategori').val(data.nama_bms);
            $('#modalEditAdmin #keterangan').val(data.detail_bms);
            $('#modalEditAdmin #total_biaya').val(data.total_bms);
            // Menampilkan modal
            $('#modalEditAdmin').modal('show');
        }
    });
}

function konfirmasiHapusKategori(id) {
    if (confirm("Apakah Anda yakin ingin menghapus kategori ini?")) {
        window.location.href = '<?= site_url('pembayaran/hapusKategori/') ?>' + id;
    }
}
</script>


<script>
document.getElementById('keterangan').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        let textarea = e.target;
        let start = textarea.selectionStart;
        let end = textarea.selectionEnd;
        let value = textarea.value;
        let newValue = value.substring(0, start) + '<br>' + value.substring(end);
        textarea.value = newValue;
        textarea.setSelectionRange(start + 4, start + 4); // Set caret position after <br>
    }
});
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