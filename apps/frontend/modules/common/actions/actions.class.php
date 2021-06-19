<?php

class commonActions extends sfActions
{
  /**
  * 共通前処理
  *
  * @param
  */
  public function preExecute()
  {
    $this->isAuthenticated  	= $this->getUser()->isAuthenticated();
    $this->member_id 					= $this->getUser()->getAttribute('member_id');
    $this->member 						= Member::getMemberDetail($this->member_id);
  }

  /**
  * 汎用メッセージ
  *
  */
  public function executeError()
  {
    $this->msg 		= $this->getUser()->getAttribute('msg');
    $this->debug 	= $this->getUser()->getAttribute('debug');
  }

  /**
   * 404エラー対応
   *
   */
  public function executeError404(sfWebRequest $request)
  {
    $this->msg 		= $this->getUser()->getAttribute('msg');
    $this->debug 	= $this->getUser()->getAttribute('debug');
  }

}
