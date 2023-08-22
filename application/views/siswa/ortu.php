<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Management Orang Tua</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Orang Tua</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pendaftar</th>
            <th>Nomor Telepon Pendaftar</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
            <th>Nama Wali</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>No</th>
            <th>Nama Pendaftar</th>
            <th>Nomor Telepon Pendaftar</th>
            <th>Nama Ayah</th>
            <th>Nama Ibu</th>
            <th>Nama Wali</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        $no = 1; // Inisialisasi nomor urut
        foreach ($pendaftar_data as $pendaftar) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $pendaftar['nama_pendaftar'] ?></td>
                <td><?= $pendaftar['nomor_telepon'] ?></td>
                <td><?= $pendaftar['nama_ayah'] ?></td>
                <td><?= $pendaftar['nama_ibu'] ?></td>
                <td><?= $pendaftar['nama_wali'] ?></td>
                <td>
                <button class="btn btn-info btn-sm" onclick="detailOrtu(<?= $pendaftar['idpendaftar']; ?>)">
    <i class="fas fa-info"></i> Detail Info
</button>
<a href="<?= base_url('pendaftar/index'); ?>" class="btn btn-danger btn-sm">
    <i class="fas fa-trash"></i> Hapus
</a>



                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Informasi Orang Tua</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>            </div>
            <div class="modal-body">
                <table class="table">
                <tbody>
    <tr>
        <th colspan="2"><h4>Bagian Data Ayah</h4></th>
    </tr>
    <tr>
        <td>Nama Ayah</td>
        <td id="detailNamaAyah"></td>
    </tr>
    <tr>
        <td>NIK Ayah</td>
        <td id="detailNikAyah"></td>
    </tr>
    <tr>
        <td>Tempat Lahir Ayah</td>
        <td id="detailTempatLahirAyah"></td>
    </tr>
    <tr>
        <td>Tanggal Lahir Ayah</td>
        <td id="detailTanggalLahirAyah"></td>
    </tr>
    <tr>
        <td>Pendidikan Terakhir Ayah</td>
        <td id="detailPendidikanAyah"></td>
    </tr>
    <tr>
        <td>Alamat Lengkap Ayah</td>
        <td id="detailAlamatAyah"></td>
    </tr>
    <tr>
        <td>Nomor Telepon Ayah</td>
        <td id="detailTeleponAyah"></td>
    </tr>
    <tr>
        <td>Agama Ayah</td>
        <td id="detailAgamaAyah"></td>
    </tr>
    <tr>
        <td>Pekerjaan Ayah</td>
        <td id="detailPekerjaanAyah"></td>
    </tr>
    <tr>
        <td>Alamat Kantor Ayah</td>
        <td id="detailAlamatKantorAyah"></td>
    </tr>
    <tr>
        <td>Gaji Ayah</td>
        <td id="detailGajiAyah"></td>
    </tr>
    <tr>
        <th colspan="2"><h4>Bagian Data Ibu</h4></th>
    </tr>
    <tr>
        <td>Nama Ibu</td>
        <td id="detailNamaIbu"></td>
    </tr>
    <tr>
        <td>NIK Ibu</td>
        <td id="detailNikIbu"></td>
    </tr>
    <tr>
        <td>Tempat Lahir Ibu</td>
        <td id="detailTempatLahirIbu"></td>
    </tr>
    <tr>
        <td>Tanggal Lahir Ibu</td>
        <td id="detailTanggalLahirIbu"></td>
    </tr>
    <tr>
        <td>Pendidikan Terakhir Ibu</td>
        <td id="detailPendidikanIbu"></td>
    </tr>
    <tr>
        <td>Alamat Lengkap Ibu</td>
        <td id="detailAlamatIbu"></td>
    </tr>
    <tr>
        <td>Nomor Telepon Ibu</td>
        <td id="detailTeleponIbu"></td>
    </tr>
    <tr>
        <td>Agama Ibu</td>
        <td id="detailAgamaIbu"></td>
    </tr>
    <tr>
        <td>Pekerjaan Ibu</td>
        <td id="detailPekerjaanIbu"></td>
    </tr>
    <tr>
        <td>Alamat Kantor Ibu</td>
        <td id="detailAlamatKantorIbu"></td>
    </tr>
    <tr>
        <td>Gaji Ibu</td>
        <td id="detailGajiIbu"></td>
    </tr>
    <tr>
        <th colspan="2"><h4>Bagian Data Wali</h4></th>
    </tr>
    <tr>
        <td>Nama Wali</td>
        <td id="detailNamaWali"></td>
    </tr>
    <tr>
        <td>NIK Wali</td>
        <td id="detailNikWali"></td>
    </tr>
    <tr>
        <td>Tempat Lahir Wali</td>
        <td id="detailTempatLahirWali"></td>
    </tr>
    <tr>
        <td>Tanggal Lahir Wali</td>
        <td id="detailTanggalLahirWali"></td>
    </tr>
    <tr>
        <td>Pendidikan Terakhir Wali</td>
        <td id="detailPendidikanWali"></td>
    </tr>
    <tr>
        <td>Alamat Lengkap Wali</td>
        <td id="detailAlamatWali"></td>
    </tr>
    <tr>
        <td>Nomor Telepon Wali</td>
        <td id="detailTeleponWali"></td>
    </tr>
    <tr>
        <td>Agama Wali</td>
        <td id="detailAgamaWali"></td>
    </tr>
    <tr>
        <td>Pekerjaan Wali</td>
        <td id="detailPekerjaanWali"></td>
    </tr>
    <tr>
        <td>Alamat Kantor Wali</td>
        <td id="detailAlamatKantorWali"></td>
    </tr>
    <tr>
        <td>Gaji Wali</td>
        <td id="detailGajiWali"></td>
    </tr>
</tbody>

                </table>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
    function detailOrtu(idpendaftar) {
        $.ajax({
            type: "GET",
            url: "<?= base_url('siswa/getDetailPendaftar/'); ?>" + idpendaftar,
            success: function(response) {
                var data = JSON.parse(response);
                // Bagian Data Ayah
                $("#detailNamaAyah").text(data.nama_ayah);
                $("#detailNikAyah").text(data.nik_ayah);
                $("#detailTempatLahirAyah").text(data.tempat_lahir_ayah);
                $("#detailTanggalLahirAyah").text(data.tanggal_lahir_ayah);
                $("#detailPendidikanAyah").text(data.pendidikan_ayah);
                $("#detailAlamatAyah").text(data.alamat_ayah);
                $("#detailTeleponAyah").text(data.telepon_ayah);
                $("#detailAgamaAyah").text(data.agama_ayah);
                $("#detailPekerjaanAyah").text(data.pekerjaan_ayah);
                $("#detailAlamatKantorAyah").text(data.alamat_kantor_ayah);
                $("#detailGajiAyah").text(data.gaji_ayah);
                // Bagian Data Ibu
                $("#detailNamaIbu").text(data.nama_ibu);
                $("#detailNikIbu").text(data.nik_ibu);
                $("#detailTempatLahirIbu").text(data.tempat_lahir_ibu);
                $("#detailTanggalLahirIbu").text(data.tanggal_lahir_ibu);
                $("#detailPendidikanIbu").text(data.pendidikan_ibu);
                $("#detailAlamatIbu").text(data.alamat_ibu);
                $("#detailTeleponIbu").text(data.telepon_ibu);
                $("#detailAgamaIbu").text(data.agama_ibu);
                $("#detailPekerjaanIbu").text(data.pekerjaan_ibu);
                $("#detailAlamatKantorIbu").text(data.alamat_kantor_ibu);
                $("#detailGajiIbu").text(data.gaji_ibu);
                // Bagian Data Wali
                $("#detailNamaWali").text(data.nama_wali);
                $("#detailNikWali").text(data.nik_wali);
                $("#detailTempatLahirWali").text(data.tempat_lahir_wali);
                $("#detailTanggalLahirWali").text(data.tanggal_lahir_wali);
                $("#detailPendidikanWali").text(data.pendidikan_wali);
                $("#detailAlamatWali").text(data.alamat_wali);
                $("#detailTeleponWali").text(data.telepon_wali);
                $("#detailAgamaWali").text(data.agama_wali);
                $("#detailPekerjaanWali").text(data.pekerjaan_wali);
                $("#detailAlamatKantorWali").text(data.alamat_kantor_wali);
                $("#detailGajiWali").text(data.gaji_wali);
                $("#detailModal").modal("show");
            },
            error: function() {
                alert("Terjadi kesalahan saat mengambil data.");
            }
        });
    }
</script>



