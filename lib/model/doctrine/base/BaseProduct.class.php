<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Product', 'doctrine');

/**
 * BaseProduct
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $product_type
 * @property integer $place_id
 * @property string $name
 * @property integer $price
 * @property string $detail
 * @property string $url
 * @property string $thumbnail
 * @property string $site_name
 * @property string $site_url
 * @property string $site_thumbnail
 * @property integer $order_no
 * @property integer $delete_flag
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * 
 * @method integer   getId()             Returns the current record's "id" value
 * @method integer   getProductType()    Returns the current record's "product_type" value
 * @method integer   getPlaceId()        Returns the current record's "place_id" value
 * @method string    getName()           Returns the current record's "name" value
 * @method integer   getPrice()          Returns the current record's "price" value
 * @method string    getDetail()         Returns the current record's "detail" value
 * @method string    getUrl()            Returns the current record's "url" value
 * @method string    getThumbnail()      Returns the current record's "thumbnail" value
 * @method string    getSiteName()       Returns the current record's "site_name" value
 * @method string    getSiteUrl()        Returns the current record's "site_url" value
 * @method string    getSiteThumbnail()  Returns the current record's "site_thumbnail" value
 * @method integer   getOrderNo()        Returns the current record's "order_no" value
 * @method integer   getDeleteFlag()     Returns the current record's "delete_flag" value
 * @method timestamp getCreatedAt()      Returns the current record's "created_at" value
 * @method timestamp getUpdatedAt()      Returns the current record's "updated_at" value
 * @method Product   setId()             Sets the current record's "id" value
 * @method Product   setProductType()    Sets the current record's "product_type" value
 * @method Product   setPlaceId()        Sets the current record's "place_id" value
 * @method Product   setName()           Sets the current record's "name" value
 * @method Product   setPrice()          Sets the current record's "price" value
 * @method Product   setDetail()         Sets the current record's "detail" value
 * @method Product   setUrl()            Sets the current record's "url" value
 * @method Product   setThumbnail()      Sets the current record's "thumbnail" value
 * @method Product   setSiteName()       Sets the current record's "site_name" value
 * @method Product   setSiteUrl()        Sets the current record's "site_url" value
 * @method Product   setSiteThumbnail()  Sets the current record's "site_thumbnail" value
 * @method Product   setOrderNo()        Sets the current record's "order_no" value
 * @method Product   setDeleteFlag()     Sets the current record's "delete_flag" value
 * @method Product   setCreatedAt()      Sets the current record's "created_at" value
 * @method Product   setUpdatedAt()      Sets the current record's "updated_at" value
 * 
 * @package    gifted
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProduct extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('product');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('product_type', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('place_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('price', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('detail', 'string', null, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => '',
             ));
        $this->hasColumn('url', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('thumbnail', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('site_name', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 100,
             ));
        $this->hasColumn('site_url', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('site_thumbnail', 'string', 255, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 255,
             ));
        $this->hasColumn('order_no', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => false,
             'autoincrement' => false,
             'length' => 4,
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