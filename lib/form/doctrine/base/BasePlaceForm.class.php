<?php

/**
 * Place form base class.
 *
 * @method Place getObject() Returns the current form's model object
 *
 * @package    gifted
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePlaceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'companyid'         => new sfWidgetFormInputText(),
      'name'              => new sfWidgetFormTextarea(),
      'prefectureid'      => new sfWidgetFormInputText(),
      'address'           => new sfWidgetFormTextarea(),
      'tel'               => new sfWidgetFormInputText(),
      'fax'               => new sfWidgetFormTextarea(),
      'start_from'        => new sfWidgetFormInputText(),
      'closedays'         => new sfWidgetFormTextarea(),
      'openhours'         => new sfWidgetFormTextarea(),
      'mail'              => new sfWidgetFormTextarea(),
      'url'               => new sfWidgetFormTextarea(),
      'twitter'           => new sfWidgetFormTextarea(),
      'twitter_widget_id' => new sfWidgetFormInputText(),
      'facebook'          => new sfWidgetFormTextarea(),
      'access'            => new sfWidgetFormTextarea(),
      'capacity'          => new sfWidgetFormTextarea(),
      'copy'              => new sfWidgetFormTextarea(),
      'memo'              => new sfWidgetFormTextarea(),
      'image'             => new sfWidgetFormTextarea(),
      'logo'              => new sfWidgetFormInputText(),
      'latitude'          => new sfWidgetFormInputText(),
      'longitude'         => new sfWidgetFormInputText(),
      'accessurl'         => new sfWidgetFormTextarea(),
      'link_flag'         => new sfWidgetFormInputText(),
      'flag_care'         => new sfWidgetFormInputText(),
      'flag_work'         => new sfWidgetFormInputText(),
      'flag_art'          => new sfWidgetFormInputText(),
      'flag_museum'       => new sfWidgetFormInputText(),
      'flag_product'      => new sfWidgetFormInputText(),
      'flag_school'       => new sfWidgetFormInputText(),
      'flag_publication'  => new sfWidgetFormInputText(),
      'flag_food'         => new sfWidgetFormInputText(),
      'flag_dance'        => new sfWidgetFormInputText(),
      'flag_other'        => new sfWidgetFormInputText(),
      'flag_shop'         => new sfWidgetFormInputText(),
      'flag_seeing'       => new sfWidgetFormInputText(),
      'flag_hearing'      => new sfWidgetFormInputText(),
      'onlineshop_url'    => new sfWidgetFormTextarea(),
      'delete_flag'       => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'companyid'         => new sfValidatorInteger(array('required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 256, 'required' => false)),
      'prefectureid'      => new sfValidatorInteger(),
      'address'           => new sfValidatorString(array('max_length' => 512, 'required' => false)),
      'tel'               => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'fax'               => new sfValidatorString(array('max_length' => 256)),
      'start_from'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'closedays'         => new sfValidatorString(array('max_length' => 512)),
      'openhours'         => new sfValidatorString(array('max_length' => 512)),
      'mail'              => new sfValidatorString(array('max_length' => 256, 'required' => false)),
      'url'               => new sfValidatorString(array('max_length' => 512, 'required' => false)),
      'twitter'           => new sfValidatorString(array('max_length' => 256)),
      'twitter_widget_id' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'facebook'          => new sfValidatorString(array('max_length' => 256)),
      'access'            => new sfValidatorString(array('required' => false)),
      'capacity'          => new sfValidatorString(array('max_length' => 512)),
      'copy'              => new sfValidatorString(),
      'memo'              => new sfValidatorString(),
      'image'             => new sfValidatorString(array('max_length' => 512)),
      'logo'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'latitude'          => new sfValidatorNumber(array('required' => false)),
      'longitude'         => new sfValidatorNumber(array('required' => false)),
      'accessurl'         => new sfValidatorString(array('max_length' => 256)),
      'link_flag'         => new sfValidatorInteger(array('required' => false)),
      'flag_care'         => new sfValidatorInteger(array('required' => false)),
      'flag_work'         => new sfValidatorInteger(array('required' => false)),
      'flag_art'          => new sfValidatorInteger(array('required' => false)),
      'flag_museum'       => new sfValidatorInteger(array('required' => false)),
      'flag_product'      => new sfValidatorInteger(array('required' => false)),
      'flag_school'       => new sfValidatorInteger(array('required' => false)),
      'flag_publication'  => new sfValidatorInteger(array('required' => false)),
      'flag_food'         => new sfValidatorInteger(array('required' => false)),
      'flag_dance'        => new sfValidatorInteger(array('required' => false)),
      'flag_other'        => new sfValidatorInteger(array('required' => false)),
      'flag_shop'         => new sfValidatorInteger(array('required' => false)),
      'flag_seeing'       => new sfValidatorInteger(array('required' => false)),
      'flag_hearing'      => new sfValidatorInteger(array('required' => false)),
      'onlineshop_url'    => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'delete_flag'       => new sfValidatorInteger(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('place[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Place';
  }

}
