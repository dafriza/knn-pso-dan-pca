<div class="register-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="<?= base_url(); ?>" class="h1 text-cyan"><b>Yus Rent Car</b></a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Register a new membership</p>

            <form action="<?= base_url('auth/registration'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Full Name . . ." value="<?= set_value('name'); ?>" id="name" name="name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                    <?= form_error('name', '<small class="text-danger pl-2 text-bold">', ' </small>'); ?>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>" id="email" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                    <?= form_error('email', '<small class="text-danger pl-2 text-bold">', ' </small>'); ?>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                </div>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="NIP" value="<?= set_value('nip'); ?>" id="email" name="nip">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-atlas"></span>
                        </div>
                    </div>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                    <?= form_error('email', '<small class="text-danger pl-2 text-bold">', ' </small>'); ?>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter Address" value="<?= set_value('address'); ?>" id="email" name="address">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-house-user"></span>
                        </div>
                    </div>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                    <?= form_error('email', '<small class="text-danger pl-2 text-bold">', ' </small>'); ?>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                </div>
                <div class="input-group mb-3">
                    <select class="form-control"  value="<?= set_value('role'); ?>"  name="role">
                      <option value="" disabled selected>Select Your Role</option>
                      <option value="Owner">Owner</option>
                      <option value="Karyawan">Karyawan</option>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user-tag"></span>
                        </div>
                    </div>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                    <?= form_error('email', '<small class="text-danger pl-2 text-bold">', ' </small>'); ?>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="password1" name="password1">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                    <?= form_error('password1', '<small class="text-danger pl-2 text-bold">', ' </small>'); ?>
                    <!-- menampilkan pesan eror jika tidak sesuai rule validasi -->
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Retype password" id="password2" name="password2">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-info btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <br>
            <a href="<?= base_url('auth'); ?>" class="text-center">I already have a membership</a> <!-- base_url : struktur nama kontroler -> methodnya -->
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->