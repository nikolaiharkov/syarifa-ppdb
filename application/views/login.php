<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEg5pXNExbgMQHkxWct-RDbX3FplIdnZs7jt7VDGy8m8MVfgNbiSEQ1sf9RbD1mckYJiMPPEDx_OOnQe6qZTTF-sADZEFCnf6Ml57e9wQju99xux1_9tR7wtGDswN497qJoFVIsTXhhm5jD3VQmjak4TRxZSlS0Q6XhgPjlTOx-jnXT1rMNuJsfyTWo1El0/s16000/amelia-bg.png');"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login PPDB TK & KB AMELIA</h1>
                                    </div>
                                    <form class="user" action="<?php echo base_url('auth/loginUser'); ?>" method="post">
    <div class="form-group">
        <input type="tel" class="form-control form-control-user"
            id="inputPhoneNumber" name="inputPhoneNumber" aria-describedby="phoneHelp"
            placeholder="Masukkan Nomor Telepon...">
    </div>
    <button type="submit" class="btn btn-primary btn-user btn-block">
        Login Sebagai Pendaftar
    </button>
</form>
<hr>
<div class="user">
<button data-bs-toggle="modal" data-bs-target="#daftarModal" class="btn btn-google btn-user btn-block">
        Daftar Sebagai Calon Siswa
    </button>
    <button class="btn btn-facebook btn-user btn-block" data-toggle="modal" data-target="#loginModal">
    Login Petugas
</button>
</div>
                                    <hr>
<br>
<br>
<br>
<br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('auth/loginPetugas'); ?>" method="POST">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="daftarModal" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="daftarModalLabel">Daftar Sebagai Calon Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Isi form sesuai permintaan -->
                    <form class="user" action="<?php echo base_url('auth/daftarPendaftar'); ?>" method="post">
    <div class="mb-3">
        <label for="inputNomorTelepon" class="form-label">Nomor Telepon Pendaftar</label>
        <input type="tel" class="form-control" id="inputNomorTelepon" name="inputNomorTelepon" required>
    </div>

    <div class="mb-3">
        <label for="inputNamaPendaftar" class="form-label">Nama Pendaftar</label>
        <input type="text" class="form-control" id="inputNamaPendaftar" name="inputNamaPendaftar" required>
    </div>
    <input type="hidden" name="level" value="2">
<hr>
    <h4>Bagian Data Ayah</h4>
    <div class="mb-3">
        <label for="namaAyah" class="form-label">Nama Ayah</label>
        <input type="text" class="form-control" id="namaAyah" name="namaAyah" required>
    </div>
    <div class="mb-3">
        <label for="nikAyah" class="form-label">NIK Ayah</label>
        <input type="text" class="form-control" id="nikAyah" name="nikAyah" required>
    </div>
    <div class="mb-3">
        <label for="tempatLahirAyah" class="form-label">Tempat Lahir Ayah</label>
        <input type="text" class="form-control" id="tempatLahirAyah" name="tempatLahirAyah" required>
    </div>
    <div class="mb-3">
        <label for="tanggalLahirAyah" class="form-label">Tanggal Lahir Ayah</label>
        <input type="date" class="form-control" id="tanggalLahirAyah" name="tanggalLahirAyah" required>
    </div>
    <div class="mb-3">
        <label for="pendidikanAyah" class="form-label">Pendidikan Terakhir Ayah</label>
        <input type="text" class="form-control" id="pendidikanAyah" name="pendidikanAyah" required>
    </div>
    <div class="mb-3">
        <label for="alamatAyah" class="form-label">Alamat Lengkap Ayah</label>
        <textarea class="form-control" id="alamatAyah" name="alamatAyah" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="teleponAyah" class="form-label">Nomor Telepon Ayah</label>
        <input type="tel" class="form-control" id="teleponAyah" name="teleponAyah" required>
    </div>
    <div class="mb-3">
        <label for="agamaAyah" class="form-label">Agama Ayah</label>
        <input type="text" class="form-control" id="agamaAyah" name="agamaAyah" required>
    </div>
    <div class="mb-3">
        <label for="pekerjaanAyah" class="form-label">Pekerjaan Ayah</label>
        <input type="text" class="form-control" id="pekerjaanAyah" name="pekerjaanAyah" required>
    </div>
    <div class="mb-3">
        <label for="alamatKantorAyah" class="form-label">Alamat Kantor Ayah</label>
        <input type="text" class="form-control" id="alamatKantorAyah" name="alamatKantorAyah" required>
    </div>
    <div class="mb-3">
        <label for="gajiAyah" class="form-label">Gaji / Pendapatan Ayah</label>
        <input type="text" class="form-control" id="gajiAyah" name="gajiAyah" required>
    </div>
    <hr>
    <h4>Bagian Ibu</h4>
    <div class="mb-3">
        <label for="namaIbu" class="form-label">Nama Ibu</label>
        <input type="text" class="form-control" id="namaIbu" name="namaIbu" required>
    </div>
    <div class="mb-3">
        <label for="nikIbu" class="form-label">NIK Ibu</label>
        <input type="text" class="form-control" id="nikIbu" name="nikIbu" required>
    </div>
    <div class="mb-3">
        <label for="tempatLahirIbu" class="form-label">Tempat Lahir Ibu</label>
        <input type="text" class="form-control" id="tempatLahirIbu" name="tempatLahirIbu" required>
    </div>
    <div class="mb-3">
        <label for="tanggalLahirIbu" class="form-label">Tanggal Lahir Ibu</label>
        <input type="date" class="form-control" id="tanggalLahirIbu" name="tanggalLahirIbu" required>
    </div>
    <div class="mb-3">
        <label for="pendidikanIbu" class="form-label">Pendidikan Terakhir Ibu</label>
        <input type="text" class="form-control" id="pendidikanIbu" name="pendidikanIbu" required>
    </div>
    <div class="mb-3">
        <label for="alamatIbu" class="form-label">Alamat Lengkap Ibu</label>
        <textarea class="form-control" id="alamatIbu" name="alamatIbu" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="teleponIbu" class="form-label">Nomor Telepon Ibu</label>
        <input type="tel" class="form-control" id="teleponIbu" name="teleponIbu" required>
    </div>
    <div class="mb-3">
        <label for="agamaIbu" class="form-label">Agama Ibu</label>
        <input type="text" class="form-control" id="agamaIbu" name="agamaIbu" required>
    </div>
    <div class="mb-3">
        <label for="pekerjaanIbu" class="form-label">Pekerjaan Ibu</label>
        <input type="text" class="form-control" id="pekerjaanIbu" name="pekerjaanIbu" required>
    </div>
    <div class="mb-3">
        <label for="alamatKantorIbu" class="form-label">Alamat Kantor Ibu</label>
        <input type="text" class="form-control" id="alamatKantorIbu" name="alamatKantorIbu" required>
    </div>
    <div class="mb-3">
        <label for="gajiIbu" class="form-label">Gaji / Pendapatan Ibu</label>
        <input type="text" class="form-control" id="gajiIbu" name="gajiIbu" required>
    </div>
    <hr>
    <h4>Bagian Wali (Opsional)</h4>
    <div class="mb-3">
        <label for="namaWali" class="form-label">Nama Wali</label>
        <input type="text" class="form-control" id="namaWali" name="namaWali">
    </div>
    <div class="mb-3">
        <label for="nikWali" class="form-label">NIK Wali</label>
        <input type="text" class="form-control" id="nikWali" name="nikWali">
    </div>
    <div class="mb-3">
        <label for="tempatLahirWali" class="form-label">Tempat Lahir Wali</label>
        <input type="text" class="form-control" id="tempatLahirWali" name="tempatLahirWali">
    </div>
    <div class="mb-3">
        <label for="tanggalLahirWali" class="form-label">Tanggal Lahir Wali</label>
        <input type="date" class="form-control" id="tanggalLahirWali" name="tanggalLahirWali">
    </div>
    <div class="mb-3">
        <label for="pendidikanWali" class="form-label">Pendidikan Terakhir Wali</label>
        <input type="text" class="form-control" id="pendidikanWali" name="pendidikanWali">
    </div>
    <div class="mb-3">
        <label for="alamatWali" class="form-label">Alamat Lengkap Wali</label>
        <textarea class="form-control" id="alamatWali" name="alamatWali" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="teleponWali" class="form-label">Nomor Telepon Wali</label>
        <input type="tel" class="form-control" id="teleponWali" name="teleponWali">
    </div>
    <div class="mb-3">
        <label for="agamaWali" class="form-label">Agama Wali</label>
        <input type="text" class="form-control" id="agamaWali" name="agamaWali">
    </div>
    <div class="mb-3">
        <label for="pekerjaanWali" class="form-label">Pekerjaan Wali</label>
        <input type="text" class="form-control" id="pekerjaanWali" name="pekerjaanWali">
    </div>
    <div class="mb-3">
        <label for="alamatKantorWali" class="form-label">Alamat Kantor Wali</label>
        <input type="text" class="form-control" id="alamatKantorWali" name="alamatKantorWali">
    </div>
    <div class="mb-3">
        <label for="gajiWali" class="form-label">Gaji / Pendapatan Wali</label>
        <input type="text" class="form-control" id="gajiWali" name="gajiWali">
    </div>

    <button type="submit" class="btn btn-primary">Daftar</button>
</form>

                </div>
            </div>
        </div>
    </div>