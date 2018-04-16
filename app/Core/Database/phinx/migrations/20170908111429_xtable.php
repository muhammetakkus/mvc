<?php


use Phinx\Migration\AbstractMigration;

class Xtable extends AbstractMigration
{
    public function change()
    {
        // create the table
        $table = $this->table('user_logins');
        $table->addColumn('user_id', 'integer')
            ->addColumn('username', 'string')
            ->addColumn('usernx', 'string', ['limit' => 20])
            ->addColumn('created', 'datetime')
            ->create();

        $this->down();
    }

    /**
     * Migrate Up.
     */
    public function up()
    {
		$this->dropTable('user_logins');
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        
    }
}
