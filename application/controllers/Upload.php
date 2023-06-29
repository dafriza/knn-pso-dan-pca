<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload extends CI_Controller
{
    // public function index()
    // {
    //     $filename = FCPATH . 'assets/dist/xls/' . $this->do_upload()['file_name'];
    //     $file_json = FCPATH . 'assets/dist/json/';
	// 	$args = [];
	// 	// $args['c1'] = $this->input->post('c1',TRUE);
	// 	// $args['c2'] = $this->input->post('c2',TRUE);
	// 	// $args['bobot_inersia'] = $this->input->post('bobot_inersia',TRUE);
	// 	// $args['k'] = $this->input->post('k',TRUE);
	// 	// $args['p'] = $this->input->post('p',TRUE);
	// 	// $args['epoch'] = $this->input->post('k',TRUE);
	// 	// print_r($args);
    //     print_r($this->execute_py($filename, $file_json));
    //     // print_r($filename);
    //     return redirect()->to(base_url('user/pso'));
    //     // print_r($file_name);
    //     // print_r(do_upload());
    // }
	function pso() 
	{
		// $filename = FCPATH . 'assets/dist/xls/' . $this->do_upload()['file_name'];
        $file_json = FCPATH . 'assets/dist/json/';
		$args['c1'] = $this->input->post('c1',TRUE);
		$args['c2'] = $this->input->post('c2',TRUE);
		$args['bobot_inersia'] = $this->input->post('bobot_inersia',TRUE);
		$args['k'] = $this->input->post('k',TRUE);
		$args['p'] = $this->input->post('p',TRUE);
		$args['epoch'] = $this->input->post('k',TRUE);
        print_r($this->execute_py_pso($filename, $file_json, $args));
        // print_r($filename);
        // return redirect()->to(base_url('user/pso'));
	}
	function pca()
	{
		$filename = FCPATH . 'assets/dist/xls/' . $this->do_upload()['file_name'];
        $file_json = FCPATH . 'assets/dist/json/';
        print_r($this->execute_py_pca($filename, $file_json));
        // print_r($filename);
        // print_r($file_json);
        return redirect()->to(base_url('/user/pca'));
	}

    function do_upload()
    {
        $config['upload_path'] = FCPATH . 'assets/dist/xls';
        $config['allowed_types'] = 'xls';

        // $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_dataset')) {
            $error = ['error' => $this->upload->display_errors()];
            print_r($this->upload->display_errors());
        } else {
            // $data = ['upload_data' => $this->upload->data()];
            // print_r('success'.PHP_EOL.$this->input->post());
            return $this->upload->data();
            // $this->load->view('upload_success', $data);
        }
    }

    function execute_py_pca($filename, $file_json)
    {
        // ob_start();
        // passthru('/usr/local/bin/python3 ' . FCPATH . 'assets/dist/python/pca.py ' . $filename.' '.$file_json);
        // $output = ob_get_clean();
        $output = shell_exec(escapeshellcmd('/usr/local/bin/python3 ' . FCPATH . 'assets/dist/python/pca.py ' . $filename . ' ' . $file_json));
        return $output;
    }
    function execute_py_pso($filename, $file_json, $args)
    {
        // ob_start();
        // passthru('/usr/local/bin/python3 ' . FCPATH . 'assets/dist/python/pso.py ' . $filename.' '.$file_json);
        // $output = ob_get_clean();
        // $output = shell_exec(escapeshellcmd('/usr/local/bin/python3 ' . FCPATH . 'assets/dist/python/pso.py ' . $filename . ' ' . $file_json.' '.$args['c1'].' '.$args['c2'].' '.$args['bobot_inersia'].' '.$args['k'].' '.$args['p'].' '.$args['epoch']));
		// $output = shell_exec(escapeshellcmd('/usr/local/bin/python3 ' . FCPATH . 'assets/dist/python/pso.py ' . $filename . ' ' . $file_json));
		$output = exec('/usr/local/bin/python3 ' . FCPATH . 'assets/dist/python/pso.py');
        return $output;
    }
}
