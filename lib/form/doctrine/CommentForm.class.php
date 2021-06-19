<?php

/**
 * Comment form.
 *
 * @package    www
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommentForm extends BaseCommentForm
{
  public function configure()
  {
    $name_min     = '1';
    $name_max     = '100';
    $name_len     = '20';
    $comment_max  = '2000';
    
    // setWidgets
    $this->setWidgets(array(
      'name'            => new sfWidgetFormInput(array(), array('size' => $name_len, 'maxlength' => $name_max, 'placeholder'=>'お名前', 'autocomplete'=>'on', 'style'=>'display:inline;', 'class'=>'required')),
      'mail'            => new sfWidgetFormInput(array(), array('size' => $name_len, 'placeholder'=>'メール', 'autocomplete'=>'on', 'style'=>'display:inline;ime-mode: disabled;', 'class'=>'required', 'type'=>'email')),
      'comment'         => new sfWidgetFormTextarea(array(), array('maxlength' => '2000', 'rows'=>'4', 'placeholder'=>'コメント', 'class'=>'required')),
      'place_id'        => new sfWidgetFormInputHidden    (array(),array()),
   ));

    // setNameFormat
    $this->widgetSchema->setNameFormat('comment[%s]');

    // setValidators
    $this->setValidators(array(
      'name'          => new sfValidatorString  (array('required' => true,'min_length' => $name_min,'max_length' => $name_max), array('required' => 'お名前が未入力です。','min_length' => '氏名は'.$name_min.'文字以上で入力してください','max_length' => '氏名は'.$name_max.'文字以内で入力してください')),
      'mail'          => new sfValidatoremail   (array('required' => true), array('required' => 'メールが未入力です。','invalid'  => '正しいメールアドレスを入力してください。',)),
      'comment'       => new sfValidatorString  (array('required' => true, 'max_length' => $comment_max), array('required' => 'コメントが未入力です。', 'max_length' => 'コメントは'.$comment_max.'文字以内で入力してください')),
      'place_id'      => new sfValidatorString  (array('required' => true)),
    ));
  
  }
}
