<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="<?= base_url(); ?>" class="h1 text-cyan"><b>SISFO</b> KEPEGAWAIAN</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Forgot Your Password ?</p>
            <!-- Menampilkan pesan yang telah kita buat di session tadi, controler Auth setelah insert data sebelum di redirect ke halaman ini -->
            <?= $this->session->flashdata('message'); ?>
            <!-- Menampilkan pesan yang telah kita buat di session tadi, controler Auth setelah insert data sebelum di redirect ke halaman ini -->
            <!-- diarahkan ke method auth/forgotpassword -->
            <form action="<?= base_url('auth/forgotpassword'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter Email Address . . ." id="email" name="email" value="<?= set_value('email'); ?>"> <!-- value = untuk mengset agar hasil yang di input tidak hilang saat halaman direfres -->
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                    <?= form_error('email', '<small class="text-danger pl-2 text-bold">', ' </small>'); ?>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-lg">
                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- diarahkan ke method auth -->


            <p class="mb-1">
                <a href="<?= base_url('auth/'); ?>">Back to login</a>
            </p>
            <p class="mb-0">
                <a href="<?= base_url('auth/registration'); ?>" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->