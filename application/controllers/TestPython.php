<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TestPython extends CI_Controller
{
    public function index()
    {
        // $command = escapeshellcmd(FCPATH."assets/dist/python/test.py");
        // $output = shell_exec($command);
        // echo $output;
        // $this->load->view('welcome_message');
        ob_start();
        passthru('/usr/local/bin/python3 '. FCPATH."assets/dist/python/test.py".' "daffa" "rizky" 21 08 2001');
        $output = ob_get_clean();
		print_r($output);
    }
}
?>
