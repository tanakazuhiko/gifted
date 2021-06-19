<?php

class mobileFilter extends sfFilter
{
  public function execute ($filterChain)
  {
    if ($this->isFirstCall())
    {
      //デバッグモードでのエラー回避
      $er = error_reporting();
      if ($er> E_STRICT) {
        error_reporting($er - E_STRICT);
      }
      
      $path = '/home/gifted/prod/lib/util/';
      set_include_path(get_include_path() . PATH_SEPARATOR . $path);
      //echo get_include_path();
      //require_once('Net/UserAgent/Mobile.php');

      // UserAgent
      $ua = $_SERVER['HTTP_USER_AGENT'];

      $agent = Net_UserAgent_Mobile::singleton($ua);

      //アクションでも使用できるようAttributeにセットしておく
      $this->getContext()->getRequest()->setAttribute('agent', $agent);

      //mobile
      if($agent->isDoCoMo() || $agent->isEZweb() || $agent->isSoftBank())
      {
        // キャリア判定
        if($agent->isDoCoMo())
        {
          $career = 'DoCoMo';
          $xml = '<!DOCTYPE html PUBLIC "-//i-mode group (ja)//DTD XHTML i-XHTML(Locale/Ver.=ja/1.0) 1.0//EN" "i-xhtml_4ja_10.dtd">';
          $this->getContext()->getResponse()->setHttpHeader('Content-Type', 'application/xhtml+xml; charset=Shift_JIS');

        }
        else if($agent->isEZweb())
        {
          $career = 'au';
          $xml = '<!DOCTYPE html PUBLIC "-//OPENWAVE//DTD XHTML 1.0//EN" "http://www.openwave.com/DTD/xhtml-basic.dtd">';
          $response = $this->getContext()->getResponse();
          $response->setHttpHeader('Expires', "Thu, 01 Dec 1994 16:00:00 GMT");
          $response->setHttpHeader('Last-Modified', gmdate("D, d M Y H:i:s")." GMT");
          $response->setHttpHeader('Cache-Control', 'no-cache,must-revalidate');
          $response->setHttpHeader('Cache-Control', 'post-check=0,pre-check=0', false);
          $response->setHttpHeader('Pragma', 'no-cache');

        }
        else if($agent->isSoftBank())
        {
          $career = 'SoftBank';
          $xml = '<!DOCTYPE html PUBLIC "-//JPHONE//DTD XHTML Basic 1.0 Plus//EN" "xhtml-basic10-plus.dtd">';
        }

        //mobile共通処理
        // 端末情報取得しておく
        $model = $agent->getModel();
        $device = "mob"; //"mob";
        $this->getContext()->getRequest()->setAttribute('career', $career);
        $this->getContext()->getRequest()->setAttribute('ua', $ua);
        $this->getContext()->getRequest()->setAttribute('xml', $xml);

        // 入力の文字コードをShift_JISからUTF-8にする。
        $this->convertInputEncoding();
        $request = $this->getContext()->getRequest();
        //$request->setRequestFormat('mobile');

        //view.ymlでhttp_metasを利用し、pc,mobile,iphoneなどのプラットフォーム別に指定しようとしたが面倒なのでfilterで設定
        sfContext::getInstance()->getResponse()->addHttpMeta('Content-Type', 'application/xhtml+xml; charset=shift_jis');
      }
      else if( 
        (
          strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile')  !== false &&
          strpos($_SERVER['HTTP_USER_AGENT'], 'Safari')  !== false &&
          strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')    === false
        ) 
        ||
        (
          strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false 
        )
        ||
        (
          (
            preg_match('/facebookexternalhit/',     $_SERVER['HTTP_USER_AGENT'])  ||
            preg_match('/mixi/',                    $_SERVER['HTTP_USER_AGENT'])  ||
            preg_match('/Gree\sSocial\sFeedback/',  $_SERVER['HTTP_USER_AGENT']) 
          ) 
          && $_GET['from'] != 'global'
        )
      )
      {
        $device = "smp"; //"smp";
        $request = $this->getContext()->getRequest();
        //$request->setRequestFormat('iphone');
        sfConfig::set('sf_web_debug', false);
      }
      else
      {
/*      if(($this->getContext()->getRequest()->getParameter('from') != "global") and ($this->getContext()->getRequest()->getParameter('from') != "local"))
        {
          //iframe内を直接参照された場合の処理
          header("Location: ".sfConfig::get('app_iframe_url').$_SERVER["REQUEST_URI"]);exit;
        }*/
        $device = "pc"; //"pc";
      }
    }

    $this->getContext()->getRequest()->setAttribute('device', $device);

    //echo    $this->getContext()->getRequest()->getAttribute('device');exit;
    
    // execute next filter
    $filterChain->execute();

/*
    //出力後の文字コード変換
    if($agent->isDoCoMo() || $agent->isEZweb() || $agent->isSoftBank())
    {
      $response = $this->getContext()->getResponse();
      $content = $response->getContent();
      $content = mb_convert_kana($content,"k","UTF-8");//全角カタカタを半角カタカナへ
     // ドコモ絵文字ちゃんと出力用
     $response->setContent(preg_replace_callback('/&#([A-F0-9]{4});/', create_function('$matches', 'return pack("H*", $matches[1]);'), mb_convert_encoding($content, 'SJIS-win', 'UTF-8')));

    // 携帯端末の場合はウェブデバックツールバーを出さないようにする。
    if($this->getContext()->getRequest()->getAttribute('career') != 'PC')
      sfConfig::set('sf_web_debug', false);
    }
*/    
  }

  //-------------------------------------------------------------------------------------------------------
  /**
   * ユーザエージェントからの入力の文字コードをShift_JISからUTF-8に変換する。
   */
  private function convertInputEncoding() {

    $paramHolder = sfContext::getInstance()->getRequest()->getParameterHolder();

    // 現在のリクエストパラメータをすべて取得。
    $parameters = $paramHolder->getAll();

    // パラメータのすべての値を再帰的に文字コード変換する。
    array_walk_recursive($parameters, array($this, 'convertEncoding'));

    // すべてのキーの値を入れ替える。setAllとかあれば良いのだけど...
    foreach($parameters as $key => $value)
      $paramHolder->set($key, $value);
  }

  // convertInputEncodingのヘルパ関数。引数に指定された値を変換する。
  private function convertEncoding(&$value) {
    if(mb_check_encoding($value, 'SJIS-WIN'))
      $value = mb_convert_encoding($value, "UTF-8", "SJIS-win");
  }
}
