                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Calon Siswa Baru</h1>
                    </div>

                    <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa</h6>
</div>

                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Nama Orang Tua / Wali</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
        <th>No</th>
            <th>Nama Siswa</th>
            <th>Nama Orang Tua / Wali</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
    <tbody>
    <?php
    $no = 1;
    foreach ($data_siswa as $siswa) {
        // Mengambil data nama orang tua dari tbl_pendaftar
        $namaPendaftar = $this->Siswa_model->getNamaPendaftarById($siswa['idpendaftar']);
    ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $siswa['nama_lengkap'] ?></td>
            <td><?= $namaPendaftar ?></td>
            <td>
                <button type="button" class="btn btn-info btn-sm" onclick="detailSiswa(<?= $siswa['idsiswa'] ?>)">
                    <i class="fas fa-info"></i> Detail
                </button>

                <?php if ($siswa['status'] > 1): ?>
                    <button type="button" class="btn btn-warning btn-sm" onclick="detailDokumenSiswa(<?= $siswa['idsiswa'] ?>)">
                    <i class="fas fa-info"></i> Lihat Dokumen
                </button>
                <?php endif; ?>
   

            </td>
        </tr>
    <?php
    }
    ?>
    </tbody>

</table>

                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail Dokumen Siswa -->
<div class="modal fade" id="detailDokumenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Dokumen Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6>Foto Anak</h6>
                        <img id="fotoAnak" src="" alt="Foto Anak" width="100" height="100">
                    </div>
                    <div class="col-md-4">
                        <h6>Kartu Keluarga</h6>
                        <a id="kkLink" href="" target="_blank">Lihat Kartu Keluarga</a>
                    </div>
                    <div class="col-md-4">
                        <h6>Akte Kelahiran</h6>
                        <a id="akteLink" href="" target="_blank">Lihat Akte Kelahiran</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>



            
                    <div class="modal fade" id="modalDetailSiswa" tabindex="-1" role="dialog" aria-labelledby="modalDetailSiswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailSiswaLabel">Detail Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
    <!-- Tempat untuk menampilkan data siswa -->
    <div id="detailSiswaContent">
    <p><strong>Nama Lengkap:</strong> <span id="detailNamaLengkap"></span></p>
    <p><strong>Nama Panggilan:</strong> <span id="detailNamaPanggilan"></span></p>
    <p><strong>Jenis Kelamin:</strong> <span id="detailJenisKelamin"></span></p>
    <p><strong>Tempat Lahir:</strong> <span id="detailTempatLahir"></span></p>
    <p><strong>Tanggal Lahir:</strong> <span id="detailTanggalLahir"></span></p>
    <p><strong>Asal Sekolah:</strong> <span id="detailAsalSekolah"></span></p>
    <p><strong>Agama:</strong> <span id="detailAgama"></span></p>
    <p><strong>Alamat:</strong> <span id="detailAlamat"></span></p>
    <p><strong>Nomor Telepon:</strong> <span id="detailNoTelepon"></span></p>
    <p><strong>Jarak Rumah ke Sekolah:</strong> <span id="detailJarakRumah"></span> KM</p>
    <p><strong>Tinggal Bersama:</strong> <span id="detailTinggalBersama"></span></p>
    <p><strong>Transportasi ke Sekolah:</strong> <span id="detailTransportasi"></span></p>
    <p><strong>Jumlah Saudara:</strong> <span id="detailJumlahSaudara"></span></p>
    <h4>Data Kesehatan</h4>
    <p><strong>Berat Badan:</strong> <span id="detailBeratBadan"></span> kg</p>
    <p><strong>Tinggi Badan:</strong> <span id="detailTinggiBadan"></span> cm</p>
    <p><strong>Sakit Ringan yang Sering Diderita:</strong> <span id="detailSakitRingan"></span></p>
    <p><strong>Sakit Berat yang Pernah Diderita:</strong> <span id="detailSakitBerat"></span></p>
    <p><strong>Alergi yang Diderita:</strong> <span id="detailAlergi"></span></p>
    <p><strong>Kelainan Sejak Lahir:</strong> <span id="detailKelainanLahir"></span></p>
    <p><strong>Operasi yang Pernah Dialami:</strong> <span id="detailOperasi"></span></p>
    <p><strong>Kecelakaan yang Pernah Dialami:</strong> <span id="detailKecelakaan"></span></p>
</div>

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
    function detailSiswa(idsiswa) {
        $.ajax({
            type: "GET",
            url: "<?= base_url('siswa/getDetailSiswa/') ?>" + idsiswa,
            success: function(response) {
                var data = JSON.parse(response);
                // Mengisi konten modal dengan data siswa
                var detailSiswaContent = `
    <p><strong>Nama Lengkap:</strong> ${data.nama_lengkap}</p>
    <p><strong>Nama Panggilan:</strong> ${data.nama_panggilan}</p>
    <p><strong>Jenis Kelamin:</strong> ${data.jenis_kelamin}</p>
    <p><strong>Tempat Lahir:</strong> ${data.tempat_lahir}</p>
    <p><strong>Tanggal Lahir:</strong> ${data.tanggal_lahir}</p>
    <p><strong>Asal Sekolah:</strong> ${data.asal_sekolah || "-"}</p>
    <p><strong>Agama:</strong> ${data.agama}</p>
    <p><strong>Alamat:</strong> ${data.alamat}</p>
    <p><strong>Nomor Telepon:</strong> ${data.no_telepon}</p>
    <p><strong>Jarak Rumah ke Sekolah:</strong> ${data.jarak_rumah} KM</p>
    <p><strong>Tinggal Bersama:</strong> ${data.tinggal_bersama}</p>
    <p><strong>Transportasi ke Sekolah:</strong> ${data.transportasi}</p>
    <p><strong>Jumlah Saudara:</strong> ${data.jumlah_saudara || "-"}</p>
    <h4>Data Kesehatan</h4>
    <p><strong>Berat Badan:</strong> ${data.berat_badan} kg</p>
    <p><strong>Tinggi Badan:</strong> ${data.tinggi_badan} cm</p>
    <p><strong>Sakit Ringan yang Sering Diderita:</strong> ${data.sakit_ringan || "-"}</p>
    <p><strong>Sakit Berat yang Pernah Diderita:</strong> ${data.sakit_berat || "-"}</p>
    <p><strong>Alergi yang Diderita:</strong> ${data.alergi || "-"}</p>
    <p><strong>Kelainan Sejak Lahir:</strong> ${data.kelainan_sejak_lahir || "-"}</p>
    <p><strong>Operasi yang Pernah Dialami:</strong> ${data.operasi || "-"}</p>
    <p><strong>Kecelakaan yang Pernah Dialami:</strong> ${data.kecelakaan || "-"}</p>
`;

$("#detailSiswaContent").html(detailSiswaContent);

                $("#modalDetailSiswa").modal("show");
            },
            error: function() {
                alert("Terjadi kesalahan saat mengambil data.");
            }
        });
    }
</script>

<script>
    function openUploadModal(idsiswa) {
        $('#modalSiswaId').val(idsiswa);
        $('#uploadModal').modal('show');
    }
</script>

<script>
function detailDokumenSiswa(idsiswa) {
    $.ajax({
        url: "<?= base_url('siswa/getDokumenByIdsiswa/') ?>" + idsiswa, // Ganti URL sesuai dengan controller
        type: "GET",
        dataType: "json",
        success: function(response) {
            if (response.success) {
                var fotoAnak = response.data.foto_anak;
                var akteKelahiran = response.data.akte_kelahiran;
                var kk = response.data.kartu_keluarga;

                // Tampilkan data pada modal
                $('#fotoAnak').attr('src', '<?= base_url("dokumen/") ?>' + fotoAnak);
                $('#kkLink').attr('href', '<?= base_url("dokumen/") ?>' + kk);
                $('#akteLink').attr('href', '<?= base_url("dokumen/") ?>' + akteKelahiran);

                // Tampilkan modal
                $('#detailDokumenModal').modal('show');
            } else {
                alert('Gagal memuat data dokumen.');
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            alert('Error: ' + textStatus);
        }
    });
}
</script>
