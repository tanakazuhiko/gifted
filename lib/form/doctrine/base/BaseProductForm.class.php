<?php

/**
 * Product form base class.
 *
 * @method Product getObject() Returns the current form's model object
 *
 * @package    gifted
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProductForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'product_type'   => new sfWidgetFormInputText(),
      'place_id'       => new sfWidgetFormInputText(),
      'name'           => new sfWidgetFormInputText(),
      'price'          => new sfWidgetFormInputText(),
      'detail'         => new sfWidgetFormTextarea(),
      'url'            => new sfWidgetFormInputText(),
      'thumbnail'      => new sfWidgetFormInputText(),
      'site_name'      => new sfWidgetFormInputText(),
      'site_url'       => new sfWidgetFormInputText(),
      'site_thumbnail' => new sfWidgetFormInputText(),
      'order_no'       => new sfWidgetFormInputText(),
      'delete_flag'    => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'product_type'   => new sfValidatorInteger(array('required' => false)),
      'place_id'       => new sfValidatorInteger(),
      'name'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'price'          => new sfValidatorInteger(array('required' => false)),
      'detail'         => new sfValidatorString(array('required' => false)),
      'url'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'thumbnail'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'site_name'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'site_url'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'site_thumbnail' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'order_no'       => new sfValidatorInteger(array('required' => false)),
      'delete_flag'    => new sfValidatorInteger(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Product';
  }

}
