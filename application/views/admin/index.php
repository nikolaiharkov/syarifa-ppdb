                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Management Admin</h1>
                    </div>

                    <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Admin</h6>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahAdmin">
        Tambah Admin
    </button>
</div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>No Telepon</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
    <?php
    $no = 1; // Inisialisasi nomor urut
    foreach ($admins as $admin) : ?>
        <tr>
            <td><?= $no++; ?></td> <!-- Menambahkan nomor urut dan kemudian menaikkannya -->
            <td><?= $admin->username; ?></td>
            <td><?= $admin->nama; ?></td>
            <td><?= $admin->email; ?></td>
            <td><?= $admin->notelepon; ?></td>
            <td>
            <button class="btn btn-warning btn-sm" onclick="editAdmin(<?= $admin->idadmin; ?>, '<?= $admin->username; ?>', '<?= $admin->nama; ?>', '<?= $admin->email; ?>', '<?= $admin->notelepon; ?>')">
    <i class="fas fa-edit"></i> Edit <!-- Icon Font Awesome untuk edit -->
</button>

<button class="btn btn-info btn-sm" onclick="ubahPassword(<?= $admin->idadmin; ?>)">
    <i class="fas fa-key"></i> Ubah Password <!-- Icon Font Awesome untuk ubah password -->
</button>

            <button class="btn btn-danger btn-sm" onclick="hapusAdmin(<?= $admin->idadmin; ?>, '<?= $admin->nama; ?>')">
    <i class="fas fa-trash-alt">Hapus</i> <!-- Icon Font Awesome untuk delete -->
</button>
</td>
        </tr>
    <?php endforeach; ?>
</tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalTambahAdmin" tabindex="-1" role="dialog" aria-labelledby="modalTambahAdminLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahAdminLabel">Tambah Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/tambahadmin'); ?>" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">No Telepon</label>
                        <input type="tel" class="form-control" id="no_telepon" name="no_telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="ulangi_password">Ulangi Password</label>
                        <input type="password" class="form-control" id="ulangi_password" name="ulangi_password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="<?= base_url('admin/editAdmin'); ?>" method="post">
                    <input type="hidden" id="edIdadmin" name="idadmin">
                    <div class="form-group">
                        <label for="editUsername">Username</label>
                        <input type="text" class="form-control" id="editUsername" name="editUsername" required>
                    </div>
                    <div class="form-group">
                        <label for="editNama">Nama</label>
                        <input type="text" class="form-control" id="editNama" name="editNama" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="editEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="editNotelepon">No Telepon</label>
                        <input type="tel" class="form-control" id="editNotelepon" name="editNotelepon" required>
                    </div>
                    <!-- Tambahkan input lain sesuai kebutuhan Anda -->
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ubahPasswordModal" tabindex="-1" role="dialog" aria-labelledby="ubahPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahPasswordModalLabel">Ubah Password Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ubahPasswordForm" action="<?= base_url('admin/editPassword'); ?>" method="post">
                    <input type="hidden" id="idadmin2" name="idadmin2">
                    <div class="form-group">
                        <label for="newPassword">Password Baru</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Ulangi Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
    function hapusAdmin(idadmin, nama) {
        var confirmation = confirm("Apakah Anda yakin ingin menghapus admin \"" + nama + "\" ?");
        if (confirmation) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/hapusadmin'); ?>",
                data: { idadmin: idadmin },
                success: function(response) {
                    if (response === "sukses") {
                        alert("Admin \"" + nama + "\" berhasil dihapus.");
                        // Tambahkan tindakan yang ingin Anda lakukan setelah penghapusan sukses,
                        // seperti memperbarui tampilan tabel atau pesan sukses.
                        location.reload(); // Merefresh halaman
                    } else {
                        alert("Gagal menghapus admin \"" + nama + "\".");
                        // Tambahkan tindakan yang ingin Anda lakukan jika terjadi kesalahan.
                    }
                },
                error: function() {
                    alert("Terjadi kesalahan dalam penghapusan admin.");
                    // Tambahkan tindakan yang ingin Anda lakukan jika terjadi kesalahan.
                }
            });
        }
    }
</script>

<script>
    function editAdmin(idadmin, username, nama, email, notelepon) {
        // Mengisi form dengan data awal
        $('#editModal #edIdadmin').val(idadmin);
        $('#editModal #editUsername').val(username);
        $('#editModal #editNama').val(nama);
        $('#editModal #editEmail').val(email);
        $('#editModal #editNotelepon').val(notelepon);

        // Membuka modal
        $('#editModal').modal('show');
    }
</script>

<script>
    function ubahPassword(idadmin) {
        $('#idadmin2').val(idadmin);
        $('#ubahPasswordModal').modal('show');
    }
</script>


