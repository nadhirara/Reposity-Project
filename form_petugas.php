<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Tambah Data Petugas</h1>
                                    </div>
                                    <?= validation_errors() ?>
                                    <form action="<?php echo base_url('petugas/registrasi_petugas');?>" class="user" method="POST">
                                        <div class="form-group">
                                            <input type="nama" class="form-control form-control-user"
                                                id="nama" aria-describedby="nama" name="nama"
                                                placeholder="Masukkan nama petugas" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="username" class="form-control form-control-user"
                                                id="username" aria-describedby="username" name="username"
                                                placeholder="Masukkan Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Masukkan Password" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="telp" name="telp" placeholder="Masukkan nomor telepon" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Save
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
