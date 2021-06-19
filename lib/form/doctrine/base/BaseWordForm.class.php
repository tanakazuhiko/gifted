<?php

/**
 * Word form base class.
 *
 * @method Word getObject() Returns the current form's model object
 *
 * @package    gifted
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWordForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'comment_type'      => new sfWidgetFormInputText(),
      'posted_at'         => new sfWidgetFormInputText(),
      'place_id'          => new sfWidgetFormInputText(),
      'parent_comment_id' => new sfWidgetFormInputText(),
      'member_id'         => new sfWidgetFormInputText(),
      'name'              => new sfWidgetFormInputText(),
      'mail'              => new sfWidgetFormInputText(),
      'title'             => new sfWidgetFormInputText(),
      'comment'           => new sfWidgetFormTextarea(),
      'url'               => new sfWidgetFormInputText(),
      'thumbnail'         => new sfWidgetFormInputText(),
      'delete_flag'       => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'comment_type'      => new sfValidatorInteger(array('required' => false)),
      'posted_at'         => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'place_id'          => new sfValidatorInteger(array('required' => false)),
      'parent_comment_id' => new sfValidatorInteger(array('required' => false)),
      'member_id'         => new sfValidatorInteger(array('required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 100)),
      'mail'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'title'             => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'comment'           => new sfValidatorString(array('required' => false)),
      'url'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'thumbnail'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'delete_flag'       => new sfValidatorInteger(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('word[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Word';
  }

}
