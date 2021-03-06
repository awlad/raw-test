<?php

use Phinx\Migration\AbstractMigration;

class SupplierTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('suppliers');
        $table->addColumn('name', 'string', array('limit' => 30))
            ->addColumn('address', 'text')
            ->addColumn('contact_number', 'string', array('limit' => 20))
            ->addColumn('email', 'string')
            ->addColumn('zip_code', 'string', array('limit' => 10))
            ->addColumn('created_at', 'datetime', array('null' => true))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->create();

    }
}
