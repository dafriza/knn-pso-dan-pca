<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="row w-100">
        <a href="<?= base_url("user"); ?>" class="brand-link">
            <img src="<?= base_url("assets"); ?>/logo.png" alt="UNNES Logo" width="100%">
            <span class="brand-text font-weight-light"></span>
        </a>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
                <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="<?= base_url("user"); ?>" class="nav-link <?= (current_url() == base_url("user")) ? 'active' : ''?>">
                                <i class="fas fa-home mr-1"></i>
                                <p class="text-uppercase">
                                    Dashboard
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("user/about"); ?>" class="nav-link <?= (current_url() == base_url("user/about")) ? 'active' : ''?>">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                <p class="text-uppercase">
                                    About
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("user/dataset"); ?>" class="nav-link <?= (current_url() == base_url("user/dataset")) ? 'active' : ''?>">
                            <i class="fa fa-file-alt mr-2"></i>
                                <p class="text-uppercase">
                                    Dataset
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("user/pso"); ?>" class="nav-link <?= (current_url() == base_url("user/pso")) ? 'active' : ''?>" >
                            <i class="fa fa-square-root-alt mr-1"></i>
                                <p class="text-uppercase">
                                    KNN-PSO
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url("user/pca"); ?>" class="nav-link <?= (current_url() == base_url("user/pca")) ? 'active' : ''?>">
                            <i class="fa fa-square-root-alt mr-1"></i>
                                <p class="text-uppercase">
                                    KNN-PCA
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>
                    
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>