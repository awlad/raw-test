<?php

use Phinx\Migration\AbstractMigration;

class SupplierEmployeeTable extends AbstractMigration
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
        $table = $this->table('supplier_employees');
        $table->addColumn('is_current', 'boolean', ['default' => false])->create();
        $table->addColumn('employee_id', 'integer')
            ->addForeignKey('employee_id', 'employees', ['id'])
            ->addColumn('supplier_id', 'integer')
            ->addForeignKey('supplier_id', 'suppliers', ['id'])
            ->addColumn('created_at', 'datetime', array('null' => true))
            ->addColumn('updated_at', 'datetime', array('null' => true))
            ->save();
    }
}
