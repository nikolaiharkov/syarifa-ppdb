                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Calon Siswa Baru</h1>
                    </div>

                    <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa</h6>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalTambahSiswa">
    Tambah Siswa
</button>
</div>

                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
    <tbody>
    <?php
    $no = 1;
    foreach ($data_siswa as $siswa) {
    ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $siswa['nama_lengkap'] ?></td>
            <td>
            <button type="button" class="btn btn-info btn-sm" onclick="detailSiswa(<?= $siswa['idsiswa'] ?>)">
    <i class="fas fa-info"></i> Detail
</button>

<?php if ($siswa['status'] == 1): ?>
    <button type="button" class="btn btn-primary btn-sm" onclick="openUploadModal(<?= $siswa['idsiswa'] ?>)">
    <i class="fas fa-upload"></i> Upload Dokumen
</button>

<?php elseif ($siswa['status'] == 2): ?>
    <button type="button" class="btn btn-warning btn-sm" onclick="pembayaranFormulir(<?= $siswa['idsiswa'] ?>)">
        <i class="fas fa-money-bill"></i> Pembayaran Formulir
    </button>
<?php elseif ($siswa['status'] == 3): ?>
    <button type="button" class="btn btn-success btn-sm" onclick="pembayaranBiayaMasuk(<?= $siswa['idsiswa'] ?>)">
        <i class="fas fa-money-bill"></i> Pembayaran Biaya Masuk
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

                    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('siswa/uploadDokumen'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="modalSiswaId" name="siswaId">

                    <div class="form-group">
                        <label for="fotoAnak">Upload Foto Anak (PNG, JPG)</label>
                        <input type="file" class="form-control-file" id="fotoAnak" name="fotoAnak" accept=".png, .jpg, .jpeg" required>
                    </div>
                    <div class="form-group">
                        <label for="akteKelahiran">Upload Akte Kelahiran (PDF)</label>
                        <input type="file" class="form-control-file" id="akteKelahiran" name="akteKelahiran" accept=".pdf" required>
                    </div>
                    <div class="form-group">
                        <label for="kk">Upload Kartu Keluarga (PDF)</label>
                        <input type="file" class="form-control-file" id="kk" name="kk" accept=".pdf" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
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


                    <div class="modal fade" id="modalTambahSiswa" tabindex="-1" role="dialog" aria-labelledby="modalTambahSiswaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahSiswaLabel">Tambah Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="<?= base_url('siswa/tambahSiswa'); ?>" method="post">
    <!-- Isi formulir sesuai kebutuhan -->
    <input type="hidden" id="idPendaftar" name="idPendaftar" value="<?= $_SESSION['idpendaftar']; ?>" required>

    <div class="form-group">
        <label for="namaLengkap">Nama lengkap calon siswa</label>
        <input type="text" class="form-control" id="namaLengkap" name="namaLengkap" required>
    </div>
    <div class="form-group">
        <label for="namaPanggilan">Nama panggilan calon siswa</label>
        <input type="text" class="form-control" id="namaPanggilan" name="namaPanggilan" required>
    </div>
    <div class="form-group">
        <label for="jenisKelamin">Jenis Kelamin</label><br>
        <label class="radio-inline">
            <input type="radio" name="jenisKelamin" value="Laki-laki" required> Laki-laki
        </label>
        <label class="radio-inline">
            <input type="radio" name="jenisKelamin" value="Perempuan" required> Perempuan
        </label>
    </div>
    <div class="form-group">
        <label for="tempatLahir">Tempat Lahir</label>
        <input type="text" class="form-control" id="tempatLahir" name="tempatLahir" required>
    </div>
    <div class="form-group">
        <label for="tanggalLahir">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" required>
    </div>
    <div class="form-group">
        <label for="asalSekolah">Asal Sekolah</label>
        <input type="text" class="form-control" id="asalSekolah" name="asalSekolah" placeholder="Kosongkan bila tidak ada">
    </div>
    <div class="form-group">
        <label for="agama">Agama</label>
        <input type="text" class="form-control" id="agama" name="agama" required>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat Tempat Tinggal</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
    </div>
    <div class="form-group">
        <label for="noTelepon">Nomor Telepon</label>
        <input type="tel" class="form-control" id="noTelepon" name="noTelepon" required>
    </div>
    <div class="form-group">
        <label for="jarakRumah">Jarak Rumah ke Sekolah (KM)</label>
        <input type="number" class="form-control" id="jarakRumah" name="jarakRumah" required>
    </div>
    <div class="form-group">
        <label>Tinggal Bersama</label><br>
        <label class="radio-inline">
            <input type="radio" name="tinggalBersama" value="Orang Tua" required> Orang Tua
        </label>
        <label class="radio-inline">
            <input type="radio" name="tinggalBersama" value="Wali" required> Wali
        </label>
    </div>
    <div class="form-group">
        <label for="transportasi">Transportasi ke Sekolah</label>
        <input type="text" class="form-control" id="transportasi" name="transportasi" required>
    </div>
    <div class="form-group">
        <label for="jumlahSaudara">Jumlah Saudara</label>
        <input type="number" class="form-control" id="jumlahSaudara" name="jumlahSaudara" placeholder="Kosongkan bila tidak ada">
    </div>
<h4>Data Kesehatan</h4>
    <div class="form-group">
    <label for="beratBadan">Berat Badan (kg)</label>
    <input type="number" class="form-control" id="beratBadan" name="beratBadan" required>
</div>
<div class="form-group">
    <label for="tinggiBadan">Tinggi Badan (cm)</label>
    <input type="number" class="form-control" id="tinggiBadan" name="tinggiBadan" required>
</div>
<div class="form-group">
    <label for="sakitRingan">Sakit Ringan yang Sering Diderita</label>
    <textarea class="form-control" id="sakitRingan" name="sakitRingan" placeholder="kosongkan bila tidak ada" rows="3"></textarea>
</div>
<div class="form-group">
    <label for="sakitBerat">Sakit Berat yang Pernah Diderita</label>
    <textarea class="form-control" id="sakitBerat" name="sakitBerat" placeholder="kosongkan bila tidak ada" rows="3"></textarea>
</div>
<div class="form-group">
    <label for="alergi">Alergi yang Diderita</label>
    <textarea class="form-control" id="alergi" name="alergi" placeholder="kosongkan bila tidak ada" rows="3"></textarea>
</div>
<div class="form-group">
    <label for="kelainanLahir">Kelainan Sejak Lahir</label>
    <textarea class="form-control" id="kelainanLahir" name="kelainanLahir" placeholder="kosongkan bila tidak ada" rows="3"></textarea>
</div>
<div class="form-group">
    <label for="operasi">Operasi yang Pernah Dialami</label>
    <textarea class="form-control" id="operasi" name="operasi" placeholder="kosongkan bila tidak ada" rows="3"></textarea>
</div>
<div class="form-group">
    <label for="kecelakaan">Kecelakaan yang Pernah Dialami</label>
    <textarea class="form-control" id="kecelakaan" name="kecelakaan" placeholder="kosongkan bila tidak ada" rows="3"></textarea>
</div>
<!-- ... (formulir sebelumnya) -->
<button type="submit" class="btn btn-primary">Simpan</button>

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
