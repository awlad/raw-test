<?php

use Phinx\Migration\AbstractMigration;

class SalaryTable extends AbstractMigration
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
        $table = $this->table('salary');
        $table->addColumn('basic_salary', 'float')->create();
        $table->addColumn('employee_id', 'integer')
                ->addForeignKey('employee_id', 'employees', ['id'])
                ->addColumn('house_rent', 'float')
                ->addColumn('allowance', 'float')
                ->addColumn('income_tax', 'float')
                ->addColumn('net_salary', 'float')
                ->addColumn('grade', 'string', array('limit' => 1 , 'default' => 'C'))
                ->addColumn('created_at', 'datetime', array('null' => true))
                ->addColumn('updated_at', 'datetime', array('null' => true))
                ->save();
    }
}
