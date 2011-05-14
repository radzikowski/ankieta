<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Config', 'doctrine');

/**
 * BaseConfig
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $value
 * @property timestamp $created_at
 * 
 * @method string    getName()       Returns the current record's "name" value
 * @method string    getValue()      Returns the current record's "value" value
 * @method timestamp getCreatedAt()  Returns the current record's "created_at" value
 * @method Config    setName()       Sets the current record's "name" value
 * @method Config    setValue()      Sets the current record's "value" value
 * @method Config    setCreatedAt()  Sets the current record's "created_at" value
 * 
 * @package    ibum
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseConfig extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('config');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('value', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}