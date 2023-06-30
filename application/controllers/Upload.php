<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Nikaia\PythonBridge\Bridge;
class Upload extends CI_Controller
{
    function pso()
    {
        $filename = FCPATH . 'assets/dist/xls/' . $this->do_upload()['file_name'];
        $file_json = FCPATH . 'assets/dist/json/';
        $args['c1'] = $this->input->post('c1', true);
        $args['c2'] = $this->input->post('c2', true);
        $args['bobot_inersia'] = $this->input->post('bobot_inersia', true);
        $args['k'] = $this->input->post('k', true);
        $args['p'] = $this->input->post('p', true);
        $args['epoch'] = $this->input->post('k', true);
        print_r($this->execute_py_pso($filename, $file_json, $args));
        // print_r($filename);
        return redirect()->to(base_url('user/pso'));
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
        $output = shell_exec(escapeshellcmd('/usr/local/bin/python3 ' . FCPATH . 'assets/dist/python/pso.py ' . $filename . ' ' . $file_json.' '.$args['c1'].' '.$args['c2'].' '.$args['bobot_inersia'].' '.$args['k'].' '.$args['p'].' '.$args['epoch']));
        // $output = shell_exec(escapeshellcmd('/usr/local/bin/python3 ' . FCPATH . 'assets/dist/python/pso.py ' . $filename . ' ' . $file_json));
        // $output = exec('/usr/local/bin/python3 ' . FCPATH . 'assets/dist/python/pso.py');
        // try {
        //     $response = Bridge::create()
        //         ->setPython('/usr/local/bin/python3') // the path to the node (You can omit if in system path)
        //         ->setScript(FCPATH . 'assets/dist/python/pso.py') // the path to your script
        //         ->pipe(['foo' => 'bar']) // the data to pipe to the script
        //         ->run();
        // } catch (BridgeException $e) {
        //     echo $e->getMessage();
        // }

        // var_dump($response->json()); // ['foo' => 'bar']
        // var_dump($response->output()); // the raw output of the script {"foo":"bar"}
        return $output;
    }
}
