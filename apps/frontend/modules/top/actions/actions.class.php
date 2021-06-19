<?php

/**
 * top actions.
 *
 * @package    gifted
 * @subpackage top
 * @author     kzhk.tnk@gmail.com
 * @version    shobu  2013.10.10
 *             link   2013.11.04
 */
class topActions extends sfActions
{
 /**
  * 共通前処理
  */
  public function preExecute()
  {
    $this->work_array       = sfConfig::get('app_work_type_array');
    $this->type_array       = sfConfig::get('app_product_type_array');
    $this->pref_id_array    = sfConfig::get('app_prefecture_id_array');
    $this->mail_setting     = sfConfig::get('app_mail_array');
    $this->isAuthenticated  = $this->getUser()->isAuthenticated();
    $this->name             = $this->getUser()->getAttribute('name',      null, sfConfig::get('app_session_name_member'));
    $this->member_id        = ($member_id = $this->getUser()->getAttribute('member_id', null, sfConfig::get('app_session_name_member'))) ? commonUtil::decrypt($member_id) : '';

    $this->from_name    = $this->mail_setting['support_name'];
    $this->from_mail    = $this->mail_setting['support_mail'];

    // フォーム生成
    $this->form         = new CommentForm();

    $this->placeId      = $this->getRequest()->getParameter('placeId');
    $this->placeName    = $this->getRequest()->getParameter('placeName');
    $this->placeKey     = $this->getRequest()->getParameter('place');
    $this->place        = Doctrine_Core::getTable('Place')->find( $this->placeId );

    $ua                 = $_SERVER['HTTP_USER_AGENT'];
    $this->device       = ((strpos($ua,'iPhone')!==false)||(strpos($ua,'Android')!==false)) ? 'smp' : 'pc';
  }

//===========================================================================================
// ■ アクション
//===========================================================================================
 /**
  * トップ
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->executeLink($request);
    $this->placeKey = "link";
    $this->setTemplate("link");
  }

 /**
  * しょうぶ学園
  */
  public function executeDetail(sfWebRequest $request)
  {
    // type
    $this->type         = $request->getParameter("type");

    // image
    $this->image  = Doctrine_Core::getTable('Image')->getList( $this->placeId, '1' );
    shuffle($this->image);

    // event
    $this->event_all    = Doctrine_Core::getTable('Event')->getList( $this->placeId );
    $this->event        = array_slice($this->event_all, 0, sfConfig::get('app_count_event_init'));
    $this->event_num    = count($this->event_all);
    $this->event_page   = ceil($this->event_num / sfConfig::get('app_count_event'));

    // comment
    $this->comment_all  = Doctrine_Core::getTable('Comment')->getList( $this->placeId );
    if(isset($this->comment_all[sfConfig::get('app_comment_type_comment')]))
    {
      $this->comment      = array_slice($this->comment_all[sfConfig::get('app_comment_type_comment')], 0, sfConfig::get('app_count_comment'));
      $this->comment_num  = count($this->word_all[sfConfig::get('app_comment_type_comment')]);
      $this->comment_page = ceil($this->comment_num / sfConfig::get('app_count_comment'));
    }
    else
    {
      $this->comment      = array();
      $this->comment_num  = 0;
      $this->comment_page = 0;
    }

    // word_all
    $this->word_all  = Doctrine_Core::getTable('Word')->getList( $this->placeId );

    // interview
    $this->interview      = array_slice($this->word_all[sfConfig::get('app_comment_type_interview')], 0, sfConfig::get('app_count_interview'));
    $this->interview_num  = count($this->word_all[sfConfig::get('app_comment_type_interview')]);
    $this->interview_page = ceil($this->interview_num / sfConfig::get('app_count_interview'));

    // blog
    $this->blog      = array_slice($this->word_all[sfConfig::get('app_comment_type_blog')], 0, sfConfig::get('app_count_blog'));
    $this->blog_num  = count($this->word_all[sfConfig::get('app_comment_type_blog')]);
    $this->blog_page = ceil($this->blog_num / sfConfig::get('app_count_blog'));

    // product
    $this->product   = Doctrine_Core::getTable('Product')->getList( $this->placeId );
  }

 /**
  * リンク
  */
  public function executeLink(sfWebRequest $request)
  {
    // 名称指定があれば初期表示
    $current        = $request->getParameter("current");
    $obj            = ($current) ? Doctrine_Core::getTable('Place')->findOneByName($current) : '';
    $this->current  = ($obj) ? $obj['id'] : '';
    $this->current_name = $current;

    $check_flag     = ($request->getParameter("check_flag")) ? $request->getParameter("check_flag") : false;
    $this->type     = $request->getParameter("type");

    // データ取得
    $this->link         = Doctrine_Core::getTable('Place')->getLinkList($key='prefectureId', $dir='asc', $check_flag);
    //$this->event        = Doctrine_Core::getTable('Event')->getAllList2('100','べてるの家');
    $this->image        = Doctrine_Core::getTable('Image')->getAllList('2');
    $this->count_array  = Doctrine_Core::getTable('Place')->getCountArray();

    // current_no
    $this->current_no = 0;
    foreach($this->link as $key => $value)
    {
      if($value['id'] == $this->current) $this->current_no  = $key;
    }
  }

 /**
  * イベント
  */
  public function executeEvent(sfWebRequest $request)
  {
    $this->type         = $request->getParameter("type");
    $this->current      = null;
    $this->link         = Doctrine_Core::getTable('Place')->getAllList();
    //$this->event        = Doctrine_Core::getTable('Event')->getAllList($type='current', $this->device);
    $this->tags_array   = Doctrine_Core::getTable('Event')->getAllTags();
    $this->year_array   = Doctrine_Core::getTable('Event')->getYear();
    $this->count_array  = Doctrine_Core::getTable('Event')->getCountArray();
    ksort ($this->count_array['place']);
    //echo "<pre>"; print_r($this->count_array); echo "</pre>"; exit;

    // 名称指定があれば初期表示
    $this->place    = $request->getParameter("place");
  }

 /**
  * ダッシュボード
  */
  public function executeBoard(sfWebRequest $request)
  {
    $this->link     = Doctrine_Core::getTable('Place')->getLinkList($key='prefectureId', $dir='asc');
  }

 /**
  * ワークス
  */
  public function executeWork(sfWebRequest $request)
  {
  }

 /**
  * フード
  */
  public function executeFood2(sfWebRequest $request)
  {
    $this->brand_array      = array();
    $this->data_array       = array();

    $id                       = "id01";
    $this->brand_array[$id]   = array("name"=>"テミルプロジェクト", "url"=>"http://www.temil-project.jp/");
    $this->data_array[$id][]  = array("id"=>"02","class"=>"w","name"=>"焼きドーナッツ5種類!","img"=>"id01-02.jpg","data"=>"","maker"=>"","url"=>"https://www.facebook.com/temil.project/photos/a.359284700768714.88425.193804737316712/640363422660839/");
    $this->data_array[$id][]  = array("id"=>"04","class"=>"w","name"=>"石けりコロロ","img"=>"id01-04.jpg","data"=>"ポルボローネ3種詰め合わせ<br />マザー牧場の牛乳を使った、ほろほろっととろける優しいクッキーです。","maker"=>"","url"=>"https://www.facebook.com/temil.project/posts/704609736236207");
    $this->data_array[$id][]  = array("id"=>"10","class"=>"w","name"=>"山本シェフのシュークリーム6種類！","img"=>"id01-10.jpg","data"=>"","maker"=>"","url"=>"https://www.facebook.com/temil.project/photos/a.196715953692257.49159.193804737316712/462972250399958/");
    $this->data_array[$id][]  = array("id"=>"14","class"=>"w","name"=>"辻口博啓シェフとLAUNDRYとこむぎっこでつくったマフィン","img"=>"id01-14.jpg","data"=>"北海道産のハスカップにこだわり、辻口シェフが考案したアイアシュッケとマフィン、そして、コンフィチュール。","maker"=>"","url"=>"http://www.temil-project.jp/make_sweets/project01.html");
    $this->data_array[$id][]  = array("id"=>"15","class"=>"w","name"=>"クイニーアマンプロジェクト！","img"=>"id01-15.jpg","data"=>"!-Styleとの協働事業、クイニーアマンプロジェクト！","maker"=>"","url"=>"https://www.facebook.com/temil.project/posts/685120164851831");
    shuffle($this->data_array[$id]);

    $id                       = "id02";
    $this->brand_array[$id]   = array("name"=>"ブラウンシュガーファースト", "url"=>"http://www.bs1stonline.com/");
    $this->data_array[$id][]  = array("id"=>"01","class"=>"w","name"=>"ココクッキー","img"=>"id02-01.jpg","data"=>"価格：1,500円（1袋2粒入り/12袋セット）<br />卵・乳製品・白砂糖不使用。動物性の食品は使用していないヴィーガンレシピです。","maker"=>"製造：社会福祉法人こぐま福祉会のみんなの館","url"=>"http://www.bs1stonline.com/菓子");
    $this->data_array[$id][]  = array("id"=>"02","class"=>"w","name"=>"チョコココクッキー・フォーコスメキッチン","img"=>"id02-02.jpg","data"=>"価格：1,575円（7g×16粒）<br />VEGAN Recipe<br />乳・卵不使用のレシピ。<br />保存料などの添加物もいっさい無添加。","maker"=>"製造：社会福祉法人翔の会ブルーベリー / 社会福祉法人こぐま福祉会のみんなの館","url"=>"https://www.facebook.com/BrownSugar1st/posts/786503691363569");
    $this->data_array[$id][]  = array("id"=>"03","class"=>"w","name"=>"ココクッキー","img"=>"id02-03.jpg","data"=>"価格：1,500円（1袋2粒入り/12袋セット）<br />卵・乳製品・白砂糖不使用。動物性の食品は使用していないヴィーガンレシピです。","maker"=>"製造：社会福祉法人こぐま福祉会のみんなの館","url"=>"http://www.bs1stonline.com/菓子");
    $this->data_array[$id][]  = array("id"=>"06","class"=>"w","name"=>"ココクッキー","img"=>"id02-06.jpg","data"=>"価格：1,500円（1袋2粒入り/12袋セット）<br />卵・乳製品・白砂糖不使用。動物性の食品は使用していないヴィーガンレシピです。","maker"=>"製造：社会福祉法人こぐま福祉会のみんなの館","url"=>"http://www.bs1stonline.com/菓子");
    $this->data_array[$id][]  = array("id"=>"07","class"=>"w","name"=>"ココクッキー","img"=>"id02-07.jpg","data"=>"価格：1,500円（1袋2粒入り/12袋セット）<br />卵・乳製品・白砂糖不使用。動物性の食品は使用していないヴィーガンレシピです。","maker"=>"製造：社会福祉法人こぐま福祉会のみんなの館","url"=>"http://www.bs1stonline.com/菓子");
    shuffle($this->data_array[$id]);

    $id                       = "id03";
    $this->brand_array[$id]   = array("name"=>"千葉のいいものカタログ", "url"=>"http://www.chibanoiimono.com/");
    $this->data_array[$id][]  = array("id"=>"01","class"=>"b","name"=>"びわ葉茶","img"=>"id03-01.jpg","data"=>"価格：800円<br />賞味期限：製造日より1年<br />60g（ティーパック5g×12個・4個ずつ真空包装）<br />ギフト対応可能（60g・100g、送料別途）","maker"=>"製造：特定非営利活動法人 生活自立研究会　富浦作業所","url"=>"http://www.chibanoiimono.com/order.html#id72");
    $this->data_array[$id][]  = array("id"=>"02","class"=>"b","name"=>"こだわり卵のシフォンケーキ","img"=>"id03-02.jpg","data"=>"価格：800円(ボックス入り、クール便・送料・代引き手数料別途)<br />消費期限：製造日より3日間<br />直径180ｍｍ×高さ95ｍｍ（350g）","maker"=>"製造：社会福祉法人 千葉市手をつなぐ育成会　でい・さくさべ","url"=>"http://www.chibanoiimono.com/order.html#id79");
    $this->data_array[$id][]  = array("id"=>"03","class"=>"b","name"=>"ぷりんせすプリン","img"=>"id03-03.jpg","data"=>"価格：85g 350円<br />消費期限：製造日より6日<br />ラムリキュールのきいた大人のシロップ「玄米焙煎ラムシロップ」orお子様にも安心の優しいシロップ「素糖精製キビシロップ」の２種が選べます。<br />ギフト対応可能（クール便・6個入りギフトボックス2,100円、送料別途）","maker"=>"製造：特定非営利活動法人 はぁもにぃ　就労支援プロジェクト「お菓子工房はぁもにぃ」","url"=>"http://www.chibanoiimono.com/order.html#id73");
    $this->data_array[$id][]  = array("id"=>"04","class"=>"b","name"=>"ルフトアイスクリーム ストロベリー","img"=>"id03-04.jpg","data"=>"価格：90ml 200円<br />賞味期限：製造日より半年（自主販売期限）<br />ギフト対応可能（クール便・送料別途）","maker"=>"製造：社会福祉法人 オリーブの樹　オリーブハウス","url"=>"http://www.chibanoiimono.com/order.html#id74");
    $this->data_array[$id][]  = array("id"=>"05","class"=>"b","name"=>"アービーさんのやさしい手作りパイ","img"=>"id03-05.jpg","data"=>"価格：アーモンドパイ・ブルーベリーパイ・季節のパイ（７×７㎝・60g）120円<br />アップルパイ・ブルーベリークリームチーズパイ（６×10㎝・70g）130円<br />60g（ティーパック5g×12個・4個ずつ真空包装）<br />賞味期限：製造日より1週間<br />ギフト対応可能（5個・10個・20個入り、送料別途）","maker"=>"製造：社会福祉法人 パルネット　PAL稲毛　パイショップアービヨーヨー","url"=>"http://www.chibanoiimono.com/order.html#id75");
    shuffle($this->data_array[$id]);
/*
	datas['id01_06'] = "クイニーアマン試作完成！<br />今回から配合も変わり、クラブハリエ木野内シェフのこだわりが！<br />4月から全国の希望する就労支援施設にて";
	datas['id01_07'] = "南部せんべいの粉と青森産リンゴのお菓子";
	datas['id01_08'] = "3種類のプレーン、いちご、ココアと、フロランタン、キャラメルナッツのオレンジケーキ";
	datas['id01_12'] = "ふじみ野に新しいカフェが誕生しました。<br />その名もテミカフェ。<br />最高のパンケーキと最高の紅茶をご用意して、皆様のご来店をお待ちしております。";
	datas['id01_13'] = "今年はLOFTで販売される事となりました。";
	urls['id01_06'] = "https://www.facebook.com/temil.project/posts/704609736236207";
	urls['id01_07'] = "https://www.facebook.com/temil.project/posts/701053006591880";
	urls['id01_08'] = "https://www.facebook.com/temil.project/photos/a.196715953692257.49159.193804737316712/695220057175175/";
	urls['id01_12'] = "https://www.facebook.com/photo.php?fbid=4306258535853&set=pcb.4306261295922";
	urls['id01_13'] = "https://www.facebook.com/temil.project/photos/a.196715953692257.49159.193804737316712/692342787462902/";
*/
  }

 /**
  * アート
  */
  public function executeArt(sfWebRequest $request)
  {
    $this->type       = $request->getParameter("type");
    $this->work_type  = $this->work_array[$this->type];
    $this->data_array = Doctrine_Core::getTable('Image2')->getList($this->type);
    $this->setTemplate("work");
    sfConfig::set('sf_web_debug', false);
  }

 /**
  * プロダクト
  */
  public function executeProduct(sfWebRequest $request)
  {
    $this->type       = $request->getParameter("type");
    $this->work_type  = $this->work_array[$this->type];
    $this->data_array = Doctrine_Core::getTable('Image2')->getList($this->type);
    $this->setTemplate("work");
  }


//===========================================================================================
// ■ Ajax
//===========================================================================================
 /**
  * スポット詳細(Ajax)
  */
  public function executePlacedetail($request)
  {
    $name     = $request->getParameter("name");
    $place    = Doctrine_Core::getTable('Place')->findOneByName($name);

    $ret_array = array();
    if(isset($place))
    {
      $ret_array['id'] = $place['id'];
      $ret_array['name'] = $place['name'];
      $ret_array['latitude'] = $place['latitude'];
      $ret_array['longitude'] = $place['longitude'];
      $ret_array['image'] = $place['image'];
    }
    echo json_encode($ret_array);
    die();
  }

 /**
  * イベント一覧(Ajax)
  */
  public function executeEventlist($request)
  {
    $type  = $request->getParameter("type");
    $event = Doctrine_Core::getTable('Event')->getAllList($type, $this->device);
    $tags_array   = Doctrine_Core::getTable('Event')->getAllTags();
    $link         = Doctrine_Core::getTable('Place')->getAllList();

    return $this->renderPartial('top/event_list', array('event' => $event, 'device'=>$this->device, 'pref_id_array'=>$this->pref_id_array, 'tags_array' => $tags_array, 'link' => $link));
  }

 /**
  * イベント詳細(Ajax)
  */
  public function executeEventdetail($request)
  {
    $eventId  = $request->getParameter("eventId");
    $event    = Doctrine_Core::getTable('Event')->findOneById($eventId);

    return $this->renderPartial('top/event_detail', array('event' => $event, 'device'=>$this->device));
  }

 /**
  * リンク詳細(Ajax)
  */
  public function executeLinkdetail($request)
  {
    $placeId  = $request->getParameter("placeId");
    $detail   = Doctrine_Core::getTable('Place')->findOneById($placeId);
    //$event  = Doctrine_Core::getTable('Event')->getAllList();
    $event    = Doctrine_Core::getTable('Event')->getAllList2($placeId, $detail->getName());
    $image    = Doctrine_Core::getTable('Image')->getAllList('2');

    return $this->renderPartial('top/link_detail', array('detail' => $detail, 'event' => $event, 'image' => $image, 'device'=>$this->device));
  }

 /**
  * twitter(Ajax)
  */
  public function executeTwitter(sfWebRequest $request)
  {
    $placeId  = $request->getParameter("placeId");
    $height   = $request->getParameter("height");
    $detail   = Doctrine_Core::getTable('Place')->findOneById($placeId);

    return $this->renderPartial('top/twitter', array('detail'=>$detail, 'device'=>$this->device, 'height'=>$height));
  }

 /**
  * もっと見る：comment(Ajax)
  */
  public function executeMorecomment($request)
  {
    $count    = $request->getParameter("count");
    $comment  = Doctrine_Core::getTable('Comment')->getList(
      $this->placeId, sfConfig::get('app_comment_type_comment'), sfConfig::get('app_count_comment'), sfConfig::get('app_count_comment')*$count );

    return $this->renderPartial('top/comment', array('comment' => $comment[sfConfig::get('app_comment_type_comment')]));
  }

 /**
  * もっと見る：interview(Ajax)
  */
  public function executeMoreinterview($request)
  {
    $count    = $request->getParameter("count");
    $comment  = Doctrine_Core::getTable('Word')->getList(
      $this->placeId, sfConfig::get('app_comment_type_interview'), sfConfig::get('app_count_interview'), sfConfig::get('app_count_interview')*$count );

    return $this->renderPartial('top/words', array('words' => $comment[sfConfig::get('app_comment_type_interview')]));
  }

 /**
  * もっと見る：blog(Ajax)
  */
  public function executeMoreblog($request)
  {
    $count    = $request->getParameter("count");
    $comment  = Doctrine_Core::getTable('Word')->getList(
      $this->placeId, sfConfig::get('app_comment_type_blog'), sfConfig::get('app_count_blog'), sfConfig::get('app_count_blog')*$count );

    return $this->renderPartial('top/words', array('words' => $comment[sfConfig::get('app_comment_type_blog')]));
  }

 /**
  * もっと見る：event(Ajax)
  */
  public function executeMoreevent($request)
  {
    $count = $request->getParameter("count");
    $event = Doctrine_Core::getTable('Event')->getList(
      $this->placeId, sfConfig::get('app_count_event'), sfConfig::get('app_count_event')*$count );

    return $this->renderPartial('top/event', array('event' => $event, 'device'=>$this->device));
  }

 /**
  * コメント投稿(Ajax)
  */
  public function executeComment($request)
  {
    $data = $request->getParameter("comment");
    $data["comment_type"] = sfConfig::get('app_comment_type_comment');

    $this->logMessage(print_r($data, true), 'info');

    $obj  = Doctrine_Core::getTable('Comment')->insertData($data);

    $this->sendMail($data, 'comment');

    $comment[0]['name']         = $obj->getName();
    $comment[0]['mail']         = $obj->getMail();
    $comment[0]['comment']      = $obj->getComment();
    $comment[0]['comment_type'] = $obj->getCommentType();
    $comment[0]['created_at']   = $obj->getCreatedAt();

    return $this->renderPartial('top/comment', array('comment' => $comment));
  }

 /**
  * お問い合わせ
  */
  public function executeContact($request)
  {
    $data = $request->getParameter("contact");

    $this->logMessage(print_r($data, true), 'info');

    $obj  = Doctrine_Core::getTable('Contact')->insertData($data);

    $this->sendMail($data, 'contact');

    return sfView::NONE;
  }

  //===========================================================================================
  // private
  //===========================================================================================
  /**
   * メール送信
   */
  private function sendMail($data, $type)
  {
    // メール情報
    $to_name    = $data['name'].' 様';
    $to_mail    = $data['mail'];
    $subject    = $this->mail_setting['subject_'.$type];
    $subject_support    = $this->mail_setting['subject_'.$type.'_support'];

    $param_array = array(
      'name'          => $data['name'],
      'mail'          => $data['mail'],
      'comment'       => $data['comment'],
      'user_flag'     => true,
    );

    if($type=="contact")
    {
      $body =  $this->getComponent('common', 'createContactMailBody', $param_array);

      // メール送信(本人)
      commonUtil::sendMail($this->getMailer(), $this->from_name, $this->from_mail, $to_name, $to_mail, $subject, $body);
    }

    $param_array = array(
      'name'          => $data['name'],
      'mail'          => $data['mail'],
      'comment'       => $data['comment'],
      'user_flag'     => false,
      '_server'       => $_SERVER,
    );

    if($type=="contact")
    {
      $body_support     = $this->getComponent('common', 'createContactMailBody', $param_array);
    }
    else
    {
      $body_support     = $this->getComponent('common', 'createCommentMailBody', $param_array);
    }

    // メール送信(管理者)
    commonUtil::sendMail($this->getMailer(), $this->from_name, $this->from_mail,
      $this->mail_setting['support_name'], $this->mail_setting['support_mail'], $subject_support, $body_support);
  }

}
