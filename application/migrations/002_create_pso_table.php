<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class Migration_Create_pso_table extends CI_Migration { 
	public function __construct() {
		parent::__construct();
		$this->load->dbforge();
	}
    public function up() { 
            $this->dbforge->add_field(array(
            'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
            ),
            'name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200'
            ),
			'precision' => array(
					'type' => 'DOUBLE',
			),
			'recall' => array(
					'type' => 'DOUBLE',
			),
			'f1_score' => array(
					'type' => 'DOUBLE',
			),
			'support' => array(
					'type' => 'DOUBLE',
			),
			'created_at' => array(
					'type' => 'TIMESTAMP',
					'null' => TRUE
			),
			'updated_at' => array(
					'type' => 'TIMESTAMP',
					'null' => TRUE
			),
			'deleted_at' => array(
					'type' => 'TIMESTAMP',
					'null' => TRUE
			),
			
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('pso',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('pso',TRUE);
    }
}
