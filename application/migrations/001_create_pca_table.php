<?php defined('BASEPATH') or exit('No direct script access allowed');
class Migration_Create_pca_table extends CI_Migration
{
	public function __construct() {
		parent::__construct();
		$this->load->dbforge();
	}
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
            ],
            'precision' => [
                'type' => 'DOUBLE',
            ],
            'recall' => [
                'type' => 'DOUBLE',
            ],
            'f1_score' => [
                'type' => 'DOUBLE',
            ],
            'support' => [
                'type' => 'DOUBLE',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('pca', true);
    }

    public function down()
    {
        $this->dbforge->drop_table('pca', true);
    }
}
