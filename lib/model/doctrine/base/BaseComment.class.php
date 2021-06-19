<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Comment', 'doctrine');

/**
 * BaseComment
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $comment_type
 * @property string $posted_at
 * @property integer $place_id
 * @property integer $parent_comment_id
 * @property integer $member_id
 * @property string $name
 * @property string $mail
 * @property string $title
 * @property string $comment
 * @property string $url
 * @property string $thumbnail
 * @property integer $delete_flag
 * @property timestamp $created_at
 * @property timestamp $updated_at
 * @property Place $Place
 * 
 * @method integer   getId()                Returns the current record's "id" value
 * @method integer   getCommentType()       Returns the current record's "comment_type" value
 * @method string    getPostedAt()          Returns the current record's "posted_at" value
 * @method integer   getPlaceId()           Returns the current record's "place_id" value
 * @method integer   getParentCommentId()   Returns the current record's "parent_comment_id" value
 * @method integer   getMemberId()          Returns the current record's "member_id" value
 * @method string    getName()              Returns the current record's "name" value
 * @method string    getMail()              Returns the current record's "mail" value
 * @method string    getTitle()             Returns the current record's "title" value
 * @method string    getComment()           Returns the current record's "comment" value
 * @method string    getUrl()               Returns the current record's "url" value
 * @method string    getThumbnail()         Returns the current record's "thumbnail" value
 * @method integer   getDeleteFlag()        Returns the current record's "delete_flag" value
 * @method timestamp getCreatedAt()         Returns the current record's "created_at" value
 * @method timestamp getUpdatedAt()         Returns the current record's "updated_at" value
 * @method Place     getPlace()             Returns the current record's "Place" value
 * @method Comment   setId()                Sets the current record's "id" value
 * @method Comment   setCommentType()       Sets the current record's "comment_type" value
 * @method Comment   setPostedAt()          Sets the current record's "posted_at" value
 * @method Comment   setPlaceId()           Sets the current record's "place_id" value
 * @method Comment   setParentCommentId()   Sets the current record's "parent_comment_id" value
 * @method Comment   setMemberId()          Sets the current record's "member_id" value
 * @method Comment   setName()              Sets the current record's "name" value
 * @method Comment   setMail()              Sets the current record's "mail" value
 * @method Comment   setTitle()             Sets the current record's "title" value
 * @method Comment   setComment()           Sets the current record's "comment" value
 * @method Comment   setUrl()               Sets the current record's "url" value
 * @method Comment   setThumbnail()         Sets the current record's "thumbnail" value
 * @method Comment   setDeleteFlag()        Sets the current record's "delete_flag" value
 * @method Comment   setCreatedAt()         Sets the current record's "created_at" value
 * @method Comment   setUpdatedAt()         Sets the current record's "updated_at" value
 * @method Comment   setPlace()             Sets the current record's "Place" value
 * 
 * @package    gifted
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseComment extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('comment');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('comment_type', 'integer', 1, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 1,
             ));
        $this->hasColumn('posted_at', 'string', 10, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 10,
             ));
        $this->hasColumn('place_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('parent_comment_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'default' => '0',
             'notnull' => true,
             'autoincrement' => false,
             'length' => 4,
             ));
        $this->hasColumn('member_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
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
        $this->hasColumn('title', 'string', 100, array(
             'type' => 'string',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => false,
             'notnull' => false,
             'autoincrement' => false,
             'length' => 100,
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
        $this->hasOne('Place', array(
             'local' => 'place_id',
             'foreign' => 'id'));
    }
}