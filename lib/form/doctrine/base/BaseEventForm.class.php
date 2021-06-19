<?php

/**
 * Event form base class.
 *
 * @method Event getObject() Returns the current form's model object
 *
 * @package    gifted
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'place_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Place'), 'add_empty' => false)),
      'name'         => new sfWidgetFormTextarea(),
      'startdate'    => new sfWidgetFormDate(),
      'enddate'      => new sfWidgetFormDate(),
      'year'         => new sfWidgetFormInputText(),
      'closeddays'   => new sfWidgetFormTextarea(),
      'openhours'    => new sfWidgetFormTextarea(),
      'prefectureid' => new sfWidgetFormInputText(),
      'place'        => new sfWidgetFormTextarea(),
      'price'        => new sfWidgetFormTextarea(),
      'contents'     => new sfWidgetFormTextarea(),
      'image'        => new sfWidgetFormTextarea(),
      'url'          => new sfWidgetFormTextarea(),
      'contact'      => new sfWidgetFormTextarea(),
      'latitude'     => new sfWidgetFormInputText(),
      'longitude'    => new sfWidgetFormInputText(),
      'event_flag'   => new sfWidgetFormInputText(),
      'flag_art'     => new sfWidgetFormInputText(),
      'flag_product' => new sfWidgetFormInputText(),
      'flag_music'   => new sfWidgetFormInputText(),
      'flag_food'    => new sfWidgetFormInputText(),
      'flag_talk'    => new sfWidgetFormInputText(),
      'flag_dance'   => new sfWidgetFormInputText(),
      'flag_other'   => new sfWidgetFormInputText(),
      'tags'         => new sfWidgetFormTextarea(),
      'delete_flag'  => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'place_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Place'))),
      'name'         => new sfValidatorString(array('max_length' => 1024)),
      'startdate'    => new sfValidatorDate(array('required' => false)),
      'enddate'      => new sfValidatorDate(array('required' => false)),
      'year'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'closeddays'   => new sfValidatorString(array('max_length' => 1024)),
      'openhours'    => new sfValidatorString(array('max_length' => 1024, 'required' => false)),
      'prefectureid' => new sfValidatorInteger(array('required' => false)),
      'place'        => new sfValidatorString(array('max_length' => 1024)),
      'price'        => new sfValidatorString(array('max_length' => 1024)),
      'contents'     => new sfValidatorString(),
      'image'        => new sfValidatorString(array('max_length' => 1024)),
      'url'          => new sfValidatorString(array('max_length' => 1024)),
      'contact'      => new sfValidatorString(array('max_length' => 1024)),
      'latitude'     => new sfValidatorNumber(array('required' => false)),
      'longitude'    => new sfValidatorNumber(array('required' => false)),
      'event_flag'   => new sfValidatorInteger(array('required' => false)),
      'flag_art'     => new sfValidatorInteger(array('required' => false)),
      'flag_product' => new sfValidatorInteger(array('required' => false)),
      'flag_music'   => new sfValidatorInteger(array('required' => false)),
      'flag_food'    => new sfValidatorInteger(array('required' => false)),
      'flag_talk'    => new sfValidatorInteger(array('required' => false)),
      'flag_dance'   => new sfValidatorInteger(array('required' => false)),
      'flag_other'   => new sfValidatorInteger(array('required' => false)),
      'tags'         => new sfValidatorString(array('required' => false)),
      'delete_flag'  => new sfValidatorInteger(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('event[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Event';
  }

}
