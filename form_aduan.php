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
                                        <h1 class="h4 text-gray-900 mb-4">Tambahkan Pengaduan Anda !</h1>
                                    </div>
                                    <?= validation_errors() ?>
                                    <?php
                                    if(!empty($error)){
                                      echo $error;
                                    }

                                    ?>
                                    
                                    <form action="<?= base_url('masyarakat/simpan_aduan') ?> " method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                        <label for="isiLaporan">Isi Laporan</label>
                                        <textarea class="form-control" id="isi_laporan" name="isi_laporan" rows="3" required></textarea>
                                        </div>
                                        <div class="form-group">
                                        <label for="foto">Foto</label>
                                        <input type="file" id="foto" name="foto" class="form-control-file" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Submit
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
