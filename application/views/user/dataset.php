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
                            <th scope="col">Id</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age</th>
                            <th scope="col">Hypertension</th>
                            <th scope="col">Heart Diase</th>
                            <th scope="col">Ever Maried</th>
                            <th scope="col">Work Type</th>
                            <th scope="col">Residence Type</th>
                            <th scope="col">Avg Glucose Level</th>
                            <th scope="col">BMI</th>
                            <th scope="col">Smoking Status</th>
                            <th scope="col">Stroke</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- looping nomer -->
                        <?php $i = 1;?>
                        <!-- looping nomer -->
                        <?php foreach ($dataset as $r) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th> <!-- menampilkan hasil looping nmr -->
                                <td><?= $r['id']; ?></td>
                                <td><?= $r['gender']; ?></td>
                                <td><?= $r['age']; ?></td>
                                <td><?= $r['hypertension']; ?></td>
                                <td><?= $r['heart_disease']; ?></td>
                                <td><?= $r['ever_married']; ?></td>
                                <td><?= $r['work_type']; ?></td>
                                <td><?= $r['residence_type']; ?></td>
                                <td><?= $r['avg_glucose_level']; ?></td>
                                <td><?= $r['bmi']; ?></td>
                                <td><?= $r['smoking_status']; ?></td>
                                <td><?= $r['stroke']; ?></td>
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

