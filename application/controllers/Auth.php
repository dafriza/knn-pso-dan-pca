<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		error_reporting(0);
    }

    public function index()
    {
        redirect('user');  
    }
	function blocked() {
        $this->load->view('templates/header', $data); //menampilkan halaman header.php : struktur folder -> file
        $this->load->view('templates/sidebar'); //menampilkan halaman sidebar.php : struktur folder -> file
        $this->load->view('templates/navbar', $data); //menampilkan halaman navbar.php : struktur folder -> file
        $this->load->view('auth/blocked', $data); //menampilkan halaman index.php : struktur folder -> file
        $this->load->view('templates/footer'); //menampilkan halaman footer.php : struktur folder -> file
	}
}
