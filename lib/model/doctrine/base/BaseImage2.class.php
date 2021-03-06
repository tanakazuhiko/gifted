<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Image2', 'doctrine');

/**
 * BaseImage2
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $type
 * @property integer $place_id
 * @property string $img_no
 * @property string $class
 * @property string $title
 * @property string $img
 * @property string $contents
 * @property string $maker
 * @property string $url
 * @property integer $delete_flag
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Place $Place
 * 
 * @method integer   getId()          Returns the current record's "id" value
 * @method integer   getType()        Returns the current record's "type" value
 * @method integer   getPlaceId()     Returns the current record's "place_id" value
 * @method string    getImgNo()       Returns the current record's "img_no" value
 * @method string    getClass()       Returns the current record's "class" value
 * @method string    getTitle()       Returns the current record's "title" value
 * @method string    getImg()         Returns the current record's "img" value
 * @method string    getContents()    Returns the current record's "contents" value
 * @method string    getMaker()       Returns the current record's "maker" value
 * @method string    getUrl()         Returns the current record's "url" value
 * @method integer   getDeleteFlag()  Returns the current record's "delete_flag" value
 * @method timestamp getCreatedAt()   Returns the current record's "created_at" value
 * @method timestamp getUpdatedAt()   Returns the current record's "updated_at" value
 * @method Place     getPlace()       Returns the current record's "Place" value
 * @method Image2    setId()          Sets the current record's "id" value
 * @method Image2    setType()        Sets the current record's "type" value
 * @method Image2    setPlaceId()     Sets the current record's "place_id" value
 * @method Image2    setImgNo()       Sets the current record's "img_no" value
 * @method Image2    setClass()       Sets the current record's "class" value
 * @method Image2    setTitle()       Sets the current record's "title" value
 * @method Image2    setImg()         Sets the current record's "img" value
 * @method Image2    setContents()    Sets the current record's "contents" value
 * @method Image2    setMaker()       Sets the current record's "maker" value
 * @method Image2    setUrl()         Sets the current record's "url" value
 * @method Image2    setDeleteFlag()  Sets the current record's "delete_flag" value
 * @method Image2    setCreatedAt()   Sets the current record's "created_at" value
 * @method Image2    setUpdatedAt()   Sets the current record's "updated_at" value
 * @method Image2    setPlace()       Sets the current record's "Place" value
 * 
 * @package    gifted
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseImage2 extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('image2');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('type', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('place_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('img_no', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('class', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('title', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('img', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('contents', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('maker', 'string', 500, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 500,
             ));
        $this->hasColumn('url', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('delete_flag', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
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
        $this->hasColumn('updated_at', 'timestamp', 25, array(
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
        $this->hasOne('Place', array(
             'local' => 'place_id',
             'foreign' => 'id'));
    }
}