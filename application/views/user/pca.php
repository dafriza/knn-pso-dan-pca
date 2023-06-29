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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
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
                        <a class="nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                            aria-controls="nav-home" aria-selected="true">KNN PSO</a>
                        <a class="nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                            role="tab" aria-controls="nav-profile" aria-selected="false">Input Proses</a>
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
                <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <?= $this->session->flashdata('message') ?>
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
                                    <?php $i = 1; ?>
                                    <!-- looping nomer -->
                                    <?php foreach ($dataset as $r) : ?>
                                    <tr>
                                        <th><?= $r['name'] ?></th>
                                        <td><?= $r['precisions'] ?></td>
                                        <td><?= $r['recall'] ?></td>
                                        <td><?= $r['f1_score'] ?></td>
                                        <td><?= $r['suport'] ?></td>
                                    </tr>
                                    <!-- looping nomer -->
                                    <?php $i++; ?>
                                    <!-- looping nomer -->
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                    aria-labelledby="nav-profile-tab">
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
