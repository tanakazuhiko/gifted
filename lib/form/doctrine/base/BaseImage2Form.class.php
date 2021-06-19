<?php

/**
 * Image2 form base class.
 *
 * @method Image2 getObject() Returns the current form's model object
 *
 * @package    gifted
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseImage2Form extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'type'        => new sfWidgetFormInputText(),
      'place_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Place'), 'add_empty' => true)),
      'img_no'      => new sfWidgetFormInputText(),
      'class'       => new sfWidgetFormInputText(),
      'title'       => new sfWidgetFormInputText(),
      'img'         => new sfWidgetFormInputText(),
      'contents'    => new sfWidgetFormTextarea(),
      'maker'       => new sfWidgetFormTextarea(),
      'url'         => new sfWidgetFormInputText(),
      'delete_flag' => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'type'        => new sfValidatorInteger(),
      'place_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Place'), 'required' => false)),
      'img_no'      => new sfValidatorString(array('max_length' => 10)),
      'class'       => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 100)),
      'img'         => new sfValidatorString(array('max_length' => 100)),
      'contents'    => new sfValidatorString(array('required' => false)),
      'maker'       => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'url'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'delete_flag' => new sfValidatorInteger(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('image2[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Image2';
  }

}
