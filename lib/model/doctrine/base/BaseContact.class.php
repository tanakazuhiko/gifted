<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Contact', 'doctrine');

/**
 * BaseContact
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property string $mail
 * @property string $comment
 * @property integer $delete_flag
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * 
 * @method integer   getId()          Returns the current record's "id" value
 * @method string    getName()        Returns the current record's "name" value
 * @method string    getMail()        Returns the current record's "mail" value
 * @method string    getComment()     Returns the current record's "comment" value
 * @method integer   getDeleteFlag()  Returns the current record's "delete_flag" value
 * @method timestamp getCreatedAt()   Returns the current record's "created_at" value
 * @method timestamp getUpdatedAt()   Returns the current record's "updated_at" value
 * @method Contact   setId()          Sets the current record's "id" value
 * @method Contact   setName()        Sets the current record's "name" value
 * @method Contact   setMail()        Sets the current record's "mail" value
 * @method Contact   setComment()     Sets the current record's "comment" value
 * @method Contact   setDeleteFlag()  Sets the current record's "delete_flag" value
 * @method Contact   setCreatedAt()   Sets the current record's "created_at" value
 * @method Contact   setUpdatedAt()   Sets the current record's "updated_at" value
 * 
 * @package    gifted
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseContact extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('contact');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('mail', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('comment', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('delete_flag', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('created_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
        $this->hasColumn('updated_at', 'timestamp', 25, array(
             'type' => 'timestamp',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 25,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}