<body class="bg-gradient-dark">

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
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Petugas</h1>
                                    </div>
                                    <?= validation_errors() ?>
                                    <?php
                                        if(!empty($error)){
                                            echo $error;
                                        }
                                    ?>

                                    <form action="<?php echo base_url('petugas/login');?>" class="user" method="POST">
                                        <div class="form-group">
                                            <input type="username" class="form-control form-control-user"
                                                id="username" aria-describedby="username" name="username"
                                                placeholder="Masukkan Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="password" name="password" placeholder="Masukkan Password" required>
                                        </div>
                                        <button type="submit" class="btn btn-dark btn-user btn-block">
                                            Login
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
