<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="#">Home</a></li>
                        <li class="breadcrumb-item "><?= $title ?></li>
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
                <!-- <h3 class="card-title"><?= $title ?></h3> -->
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                            aria-controls="nav-home" aria-selected="true">KNN PCA</a>
                        <a class="nav-link " id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                            aria-controls="nav-profile" aria-selected="false">Input Proses</a>
                        <!-- <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                            aria-controls="nav-contact" aria-selected="false">Contact</a> -->
                    </div>
                </nav>
                <!-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div> -->
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <?= $this->session->flashdata('message') ?>
                        <?php if(!is_null($dataset)):?>
                        <div class="container-fluid" style="overflow-y:scroll;height:500px">
                            <h4>Hasil Seleksi Fitur</h4>
                            <p>Banyaknya attribut terpilih : <?= $dataset->total_attributes ?></p>
                            <p>Attribut terpilih :
                                <?= $dataset->attributes[0] . ', ' . $dataset->attributes[1] . ', ' . $dataset->attributes[2] . ', ' . $dataset->attributes[3] . ', ' . $dataset->attributes[4] ?>
                            </p>
                            <br><br>
                            <h3>Hasil Klasifikasi (dalam Confusion Matrix)</h3>
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2" class="text-center">Prediksi</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td>Positif</td>
                                    <td>Negatif</td>
                                </tr>
                                <tr>
                                    <td rowspan="2" class="text-center">Actual</td>
                                    <td>Positif</td>
                                    <td><?= $dataset->confusion_matrix[0][0] ?></td>
                                    <td><?= $dataset->confusion_matrix[0][1] ?></td>
                                </tr>
                                <tr>
                                    <td>Negatif</td>
                                    <td><?= $dataset->confusion_matrix[1][0] ?></td>
                                    <td><?= $dataset->confusion_matrix[1][1] ?></td>
                                </tr>
                            </table>
                            <br>
                            <p>Nilai Akurasi : <?= $dataset->accuracy ?></p>
                            <p>Report : <?= $dataset->classification_report ?></p>
                        </div>
						<?php else: ;?>
						<div class="container-fluid">
							Data Masih belum diinput
						</div>
                        <?php endif ;?>
                    </div>
                </div>
                <div class="tab-pane fade " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card-body">
                        <div class="container-fluid" style="overflow-y:scroll;height:500px">
                            <?php echo form_open_multipart('upload/pca'); ?>
                            <h4>Input Parameter PCA</h4>
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="choose_dataset">Choose File</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="file_dataSet"
                                                aria-describedby="choose_dataset" name="file_dataset">
                                            <label class="custom-file-label" for="file_dataSet">No file
                                                chossen</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="row">
							<div class="col-3">
                                    <div class="form-group">
                                        <label for="best_komponen">Nilai Best Komponen</label>
                                        <input type="text" class="form-control" id="best_komponen" aria-describedby="best_komponen"
                                            name="best_komponen">
                                    </div>
                                </div>
							</div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
