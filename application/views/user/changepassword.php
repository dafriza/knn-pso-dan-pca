<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $title; ?></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <!-- menampilkan pesan eror jika tidak lolos form validasi -->
                <?= form_error('current_password', '<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-ban"></i>', '</div>'); ?>
                <!-- menampilkan pesan eror jika tidak lolos form validasi -->
                <?= form_error('new_password1', '<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-ban"></i>', '</div>'); ?>
                <!-- menampilkan pesan eror jika tidak lolos form validasi -->
                <?= form_error('new_password2', '<div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fas fa-ban"></i>', '</div>'); ?>
                <?php
                if ($this->session->Flashdata('sama')) {
                    echo ' <div id="alert1" class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="fas fa-exclamation-circle"></i> Password cannot be same as current! - ';
                    echo '</h5></div>';
                } else {
                    if ($this->session->Flashdata('salah')) {
                        echo ' <div id="alert1" class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="far fa-times-circle"></i> The current password false ! - ';
                        echo '</h5></div>';
                    } else {
                        if ($this->session->Flashdata('berhsil')) {
                            echo ' <div id="alert1" class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Password change - ';
                            echo '</h5></div>';
                        }
                    }
                }
                ?>

                <form action="<?= base_url('user/changepassword'); ?>" method="post">
                    <div class="form-group row">
                        <label for="current_password" class="col-sm-1 col-form-label">Current Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="curent_password" name="current_password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_password1" class="col-sm-1 col-form-label">New Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="new_password1" name="new_password1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_password2" class="col-sm-1 col-form-label">Repeat Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" id="new_password2" name="new_password2">
                        </div>
                    </div>
                    <button class="btn btn-sm bg-info" type="submit" href="<?= base_url('user/changePassword'); ?>">
                        <span class="badge bg-teal"></span>
                        <i class="fas fa-pencil-alt"></i> Edit
                    </button>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->