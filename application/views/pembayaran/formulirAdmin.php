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
            <th>Aksi</th>
        </tr>
    </tfoot>
    <tbody>
    <?php
    $no = 1;
    foreach ($data_pembayaran as $pembayaran) {
        $status_pembayaran = $pembayaran['status'];
        
        if ($status_pembayaran == 7 || $status_pembayaran == 3 || $status_pembayaran == 4) {
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
        if (confirm("Apakah Anda yakin ingin menerima formulir ini?")) {
            window.location.href = '<?= base_url('pembayaran/updateFormulir/') ?>' + idsiswa + '/3';
        }
    }

    function konfirmasiTolak(idsiswa) {
        if (confirm("Apakah Anda yakin ingin menolak formulir ini?")) {
            window.location.href = '<?= base_url('pembayaran/updateFormulir/') ?>' + idsiswa + '/4';
        }
    }
</script>

