<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Create_user extends CI_Migration {

        public function up()
        {
                $this->dbforge->add_field(array(
                        'id_user' => array(
                                'type' => 'INT',
                                'constraint' => 5,
                                'unsigned' => TRUE,
                                'auto_increment' => TRUE
                        ),
                        'blog_title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                        ),
                        'blog_description' => array(
                                'type' => 'TEXT',
                                'null' => TRUE,
                        ),
                        'name' => array(
                          'type' => 'VARCHAR',
                          'constraint' => '80'
                        )
                ));
                $this->dbforge->add_key('id_user', TRUE);
                $this->dbforge->create_table('users');
        }

        public function down()
        {
                $this->dbforge->drop_table('users',TRUE);
        }
}
