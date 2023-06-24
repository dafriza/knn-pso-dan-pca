<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="<?= base_url(); ?>" class="h1 text-cyan"><b>SISFO</b> KEPEGAWAIAN</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Change Your Password for <?= $this->session->userdata('reset_email'); ?></p>
            <!-- Menampilkan pesan yang telah kita buat di session tadi, controler Auth setelah insert data sebelum di redirect ke halaman ini -->
            <?= $this->session->flashdata('message'); ?>
            <!-- Menampilkan pesan yang telah kita buat di session tadi, controler Auth setelah insert data sebelum di redirect ke halaman ini -->
            <!-- diarahkan ke method auth/forgotpassword -->
            <form action="<?= base_url('auth/changepassword'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Enter New Password ." id="password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                    <?= form_error('password', '<small class="text-danger pl-2 text-bold">', ' </small>'); ?>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Repeat New Password ." id="password1" name="password1">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                    <?= form_error('password1', '<small class="text-danger pl-2 text-bold">', ' </small>'); ?>
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
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->