<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dataset extends CI_Model
{
	private $table = 'dataset';
    public function getAll()
    {
		return $this->db->get($this->table)->result_array();
    }
}
