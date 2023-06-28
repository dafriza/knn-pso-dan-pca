<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Reader\Xls;
class GenerateDataset extends CI_Controller
{
    public function index()
    {
        $inputFileName = FCPATH."assets/dist/xls/healthcare-dataset-stroke-data-no-missing-value.xls";
		$reader = new Xls();
        $spreadsheet = $reader->load($inputFileName);
		$nameCollumn = $spreadsheet->getActiveSheet()->rangeToArray('A1:L1');
		$datas = $spreadsheet->getActiveSheet()->toArray();
		$new_datas = array();
		for ($i=1; $i < count($datas); $i++) { 
			for ($j=0; $j < count($datas[$i]) ; $j++) { 
				$new_datas[$i-1][$nameCollumn[0][$j]] = $datas[$i][$j];
			}
		}

		// $res = $this->db->insert_batch('dataset', $new_datas);
		// if($res){
		// 	echo 'Berhasil Generate Data!';
		// }else{
		// 	return $res;
		// }
		print_r(json_encode($new_datas));
    }
}
