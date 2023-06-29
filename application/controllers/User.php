<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'DASHBOARD';
        $data['dataset'] = $this->db->get('dataset')->result_array();

        $this->load->view('templates/header', $data); //menampilkan halaman header.php : struktur folder -> file
        $this->load->view('templates/sidebar'); //menampilkan halaman sidebar.php : struktur folder -> file
        $this->load->view('templates/navbar', $data); //menampilkan halaman navbar.php : struktur folder -> file
        $this->load->view('user/index', $data); //menampilkan halaman index.php : struktur folder -> file
        $this->load->view('templates/footer'); //menampilkan halaman footer.php : struktur folder -> file
    }

    public function about()
    {
        $data['title'] = 'About';

        $this->load->view('templates/header', $data); //menampilkan halaman header.php : struktur folder -> file
        $this->load->view('templates/sidebar'); //menampilkan halaman sidebar.php : struktur folder -> file
        $this->load->view('templates/navbar', $data); //menampilkan halaman navbar.php : struktur folder -> file
        $this->load->view('user/about', $data); //menampilkan halaman about.php : struktur folder -> file
        $this->load->view('templates/footer'); //menampilkan halaman footer.php : struktur folder -> file
    }

    public function dataset()
    {
        $data['title'] = 'Data Set';
        $data['dataset'] = $this->db->get('dataset')->result_array();

        $this->load->view('templates/header', $data); //menampilkan halaman header.php : struktur folder -> file
        $this->load->view('templates/sidebar'); //menampilkan halaman sidebar.php : struktur folder -> file
        $this->load->view('templates/navbar', $data); //menampilkan halaman navbar.php : struktur folder -> file
        $this->load->view('user/dataset', $data); //menampilkan halaman index.php : struktur folder -> file
        $this->load->view('templates/footer'); //menampilkan halaman footer.php : struktur folder -> file
    }
    public function pso()
    {
        $data['title'] = 'KNN-PSO';
        // $data['dataset'] = $this->db->get('pso')->result_array();

        $this->load->view('templates/header', $data); //menampilkan halaman header.php : struktur folder -> file
        $this->load->view('templates/sidebar'); //menampilkan halaman sidebar.php : struktur folder -> file
        $this->load->view('templates/navbar', $data); //menampilkan halaman navbar.php : struktur folder -> file
        $this->load->view('user/pso', $data); //menampilkan halaman index.php : struktur folder -> file
        $this->load->view('templates/footer'); //menampilkan halaman footer.php : struktur folder -> file
    }
    public function pca()
    {
        $data['title'] = 'KNN-PCA';
        // $data['dataset'] = $this->db->get('pca')->result_array();

        $this->load->view('templates/header', $data); //menampilkan halaman header.php : struktur folder -> file
        $this->load->view('templates/sidebar'); //menampilkan halaman sidebar.php : struktur folder -> file
        $this->load->view('templates/navbar', $data); //menampilkan halaman navbar.php : struktur folder -> file
        $this->load->view('user/pca', $data); //menampilkan halaman index.php : struktur folder -> file
        $this->load->view('templates/footer'); //menampilkan halaman footer.php : struktur folder -> file
    }
    

}
