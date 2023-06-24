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
                <!-- menampilkan pesan eror jika form_validasi tidak lolos -->
                <?= $this->session->flashdata('message'); ?>

                <!-- menampilkan pesan sukses setelah role berhasil di insert ke db -->
                <!-- tombol untuk memunculkan modal -->
                <!-- tombol untuk memunculkan modal -->
                <div class="container-fluid" style="overflow-y:scroll;height:500px">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Precission</th>
                            <th scope="col">Recall</th>
                            <th scope="col">F1-Score</th>
                            <th scope="col">Suport</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- looping nomer -->
                        <?php $i = 1;?>
                        <!-- looping nomer -->
                        <?php foreach ($dataset as $r) : ?>
                            <tr>
                                <th><?= $r['name']; ?></th>
                                <td><?= $r['precisions']; ?></td>
                                <td><?= $r['recall']; ?></td>
                                <td><?= $r['f1_score']; ?></td>
                                <td><?= $r['suport']; ?></td>
                            </tr>
                            <!-- looping nomer -->
                            <?php $i++; ?>
                            <!-- looping nomer -->
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

