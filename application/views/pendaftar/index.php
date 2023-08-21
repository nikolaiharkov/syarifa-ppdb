<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Management Pendaftar</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pendaftar</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pendaftar</th>
                        <th>Nomor Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Pendaftar</th>
                        <th>Nomor Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
    <?php
    $no = 1; // Inisialisasi nomor urut
    foreach ($pendaftar_data as $pendaftar) : ?>
        <tr>
            <td><?= $no++; ?></td> <!-- Menambahkan nomor urut dan kemudian menaikkannya -->
            <td><?= $pendaftar['nama_pendaftar']; ?></td>
            <td><?= $pendaftar['nomor_telepon']; ?></td>
            <td>
            <button class="btn btn-warning btn-sm" onclick="editPendaftar(<?= $pendaftar['idpendaftar']; ?>, '<?= $pendaftar['nama_pendaftar']; ?>', '<?= $pendaftar['nomor_telepon']; ?>')">
    <i class="fas fa-edit"></i> Edit <!-- Icon Font Awesome untuk edit -->
</button>

<button class="btn btn-danger btn-sm" onclick="hapusPendaftar(<?= $pendaftar['idpendaftar']; ?>, '<?= $pendaftar['nama_pendaftar']; ?>')">
    <i class="fas fa-trash-alt"></i> Hapus
</button>


            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Pendaftar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pendaftar/editPendaftar'); ?>" method="post">
                    <input type="hidden" id="edIdpendaftar" name="idpendaftar">
                    <div class="form-group">
                        <label for="editNama">Nama Pendaftar</label>
                        <input type="text" class="form-control" id="editNama" name="nama_pendaftar" required>
                    </div>
                    <div class="form-group">
                        <label for="editNomorTelepon">Nomor Telepon</label>
                        <input type="text" class="form-control" id="editNomorTelepon" name="nomor_telepon" required>
                    </div>
                    <!-- Tambahkan input lain sesuai kebutuhan -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
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
    function editPendaftar(idpendaftar, nama_pendaftar, nomor_telepon) {
        // Mengisi form dengan data awal
        $('#editModal #edIdpendaftar').val(idpendaftar);
        $('#editModal #editNama').val(nama_pendaftar);
        $('#editModal #editNomorTelepon').val(nomor_telepon);

        // Membuka modal
        $('#editModal').modal('show');
    }
</script>

<script>
    function hapusPendaftar(idpendaftar, nama) {
        var confirmation = confirm("Apakah Anda yakin ingin menghapus pendaftar \"" + nama + "\" ?");
        if (confirmation) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('pendaftar/hapusPendaftar'); ?>",
                data: { idpendaftar: idpendaftar },
                success: function(response) {
                    if (response === "sukses") {
                        alert("Pendaftar \"" + nama + "\" berhasil dihapus.");
                        // Tambahkan tindakan yang ingin Anda lakukan setelah penghapusan sukses,
                        // seperti memperbarui tampilan tabel atau pesan sukses.
                        location.reload(); // Merefresh halaman
                    } else {
                        alert("Gagal menghapus pendaftar \"" + nama + "\".");
                        // Tambahkan tindakan yang ingin Anda lakukan jika terjadi kesalahan.
                    }
                },
                error: function() {
                    alert("Terjadi kesalahan dalam penghapusan pendaftar.");
                    // Tambahkan tindakan yang ingin Anda lakukan jika terjadi kesalahan.
                }
            });
        }
    }
</script>


