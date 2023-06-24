<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
class Migration_Create_dataset_table extends CI_Migration { 
	public function __construct() {
		parent::__construct();
		$this->load->dbforge();
	}
    public function up() { 
            $this->dbforge->add_field(array(
            'id' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
            ),
            'gender' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '200'
            ),
			'age' => array(
					'type' => 'DOUBLE',
			),
			'hypertension' => array(
					'type' => 'DOUBLE',
			),
			'heart_disease' => array(
					'type' => 'DOUBLE',
			),
			'ever_married' => array(
				'type' => 'VARCHAR',
				'constraint' => '5'
			),
			'work_type' => array(
				'type' => 'VARCHAR',
				'constraint' => '255'
			),
			'residence_type' => array(
				'type' => 'VARCHAR',
				'constraint' => '255'
			),
			'avg_glucose_level' => array(
				'type' => 'DOUBLE',
			),
			'bmi' => array(
				'type' => 'DOUBLE',
			),
			'smoking_status' => array(
				'type' => 'VARCHAR',
				'constraint' => '255'
			),
			'stroke' => array(
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
        $this->dbforge->create_table('dataset',TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('dataset',TRUE);
    }
}
