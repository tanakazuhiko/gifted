
<?php $description = sfConfig::get('app_meta_description_'.$sf_context->getActionName()); slot('description', $description) ?>
<?php slot('title', $placeName)?>
<?php include_partial('global/header', array('isAuthenticated' => $isAuthenticated, 'place'=>$placeKey)) ?>

<div class="viewport"><div class="flipsnap">

  <?php for($i=0; $i<count($image); $i++): ?>
  <div class="item">
    <?php if($i>0): ?><img src="/img/prev.png" style="width:80px; opacity:0.1" class="move_btn prev prev_btn"><?php endif ?>
    <a href="<?php echo $image[$i]['url'] ?>" target="_blank">
    <img class="switch tooltip" src="<?php echo $image[$i]['src'] ?>"
      title="<?php echo $image[$i]['title'] ?><br>image; <?php echo $image[$i]['url'] ?>"></a>
    <?php if($i<(count($image)-1)): ?><img src="/img/next.png" style="width:80px; opacity:0.1" class="move_btn next next_btn"><?php endif ?>
  </div>
  <?php endfor ?>

</div></div>

<!-- page -->
<div id="page">
<div class="clearfix"></div>

<!-- タブメニュー -->
<div class="sepH10">
  <ul class="tab">
  <li><a id="tab1_menu" name="#tab1" onclick="view_map();hide_image();ga('send', 'event', 'shobu', 'click', 'events');">events</a></li>
  <li><a id="tab2_menu" name="#tab2" onclick="hide_map();hide_image();ga('send', 'event', 'shobu', 'click', 'words');">words</a></li>
  <li><a id="tab3_menu" name="#tab3" onclick="hide_map();view_image();ga('send', 'event', 'shobu', 'click', 'images');">images</a></li>
  <li><a id="tab4_menu" name="#tab4" onclick="hide_map();hide_image();ga('send', 'event', 'shobu', 'click', 'works');">works</a></li>
  <li><a id="tab5_menu" name="#tab5" onclick="view_map();hide_image();ga('send', 'event', 'shobu', 'click', 'info');">info</a></li>
  </ul>
</div>
<!-- /タブメニュー -->

<!-- タブ -->
<div class="tabcontent">
  <!-- tab1 -->
  <div class="area" id="tab1">
    <div class="ingrid in-halves">

      <div class="unit" style="width:96%;">
        <div class="mainbox01" style="line-height:120%;margin-top:10px">
          <ul class="news01">
            <?php include_partial('top/event', array('event'=>$event, 'device'=>$device)) ?>
            <div id="moreevent" class="moreevent"></div>
            <li style="text-align:center; margin-bottom:10px" id="moreevent_link2">
              <a id="moreevent_link" onclick="more_event()" style="cursor:pointer; font-size:9pt"><span id="loading">more</span></a>
            </li>
          </ul>
        </div>
      </div>

    </div>
  </div>
  <!-- /tab1 -->

  <!-- tab2 -->
  <div class="area" id="tab2">
    <div class="ingrid in-halves">

      <div class="unit" style="width:96%">
        <h2 class="selector01">text & interviews</h2>
        <div class="mainbox01" >
          <?php include_partial('top/words', array('words'=>$interview)) ?>
          <div id="moreinterview" class="moreinterview"></div>
          <li style="text-align:center; margin-bottom:10px" id="moreinterview_link2">
            <a id="moreinterview_link" onclick="more_interview()" style="cursor:pointer; font-size:9pt"><span id="loading3">more</span></a>
          </li>
          <div class="clearfix" ></div>
        </div>
      </div>

      <div class="unit" style="width:96%">
        <h2 class="selector01">reviews & blogs</h2>
        <div class="mainbox01" >
          <?php include_partial('top/words', array('words'=>$blog)) ?>
          <div id="moreblog" class="moreblog"></div>
          <?php if($blog_page>1): ?>
          <li style="text-align:center; margin-bottom:10px" id="moreblog_link2">
            <a id="moreblog_link" onclick="more_blog()" style="cursor:pointer; font-size:9pt"><span id="loading_blog">more</span></a>
          </li>
          <?php endif ?>
        </div>
      </div>

      <div class="unit" >
<h2 class="selector01">twitter</h2>
<a data-chrome="noheader nofooter" class="twitter-timeline" href="https://twitter.com/shobu_style" data-widget-id="364872401630138368">@shobu_style</a>
<script>
!function(d,s,id){
  var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
  if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js,fjs);}
}(document,"script","twitter-wjs");
</script>
      </div>

      <div class="unit">
<h2 class="selector01">facebook</h2>
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=398707030235490";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="fb-like-box" data-href="https://www.facebook.com/pages/%E3%81%97%E3%82%87%E3%81%86%E3%81%B6%E5%AD%A6%E5%9C%92/116065665197755?fref=ts"
  data-width="450px" data-height="600" data-show-faces="true" data-header="false" data-stream="true" data-show-border="true"
  style="border-color:silver"></div>
      </div>

    </div>
  </div><!-- end tab2 -->

  <!-- tab3 -->
  <div class="area" id="tab3">

    <div class="ingrid in-thirds">
      <div class="unit span-two" style="width:100%; vertical-align: middle; border-radius:10px; -webkit-border-radius:10px; -moz-border-radius:10px;">
      <h2 class="selector01"><a href="http://vimeo.com/80134997" style="color:#8F808F">so : but (and) = 1.2.3.4 (trailer)</a></h2>
<table><tr><td>
<iframe src="//player.vimeo.com/video/80134997?title=0&amp;byline=0&amp;portrait=0&amp;color=c9ff23" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</td><td style="padding:5px 10px;vertical-align: middle;">
<img class="movie_image" src="/img/shobu/m3-1.png"><br>
<img class="movie_image" src="/img/shobu/m3-2.png"><br>
<img class="movie_image" src="/img/shobu/m3-3.png"><br>
</td></tr></table>
<span style="font-size:8px;color:grey">movie; <a href="http://vimeo.com/mvj" target="_blank" style="color:grey">MotionVisualJapan</a></span>
      </div>
    </div>
    <div style="margin-bottom:20px"></div>

    <div class="ingrid in-thirds">
      <div class="unit span-two" style="width:100%; vertical-align: middle; border-radius:10px; -webkit-border-radius:10px; -moz-border-radius:10px;">
      <h2 class="selector01"><a href="https://vimeo.com/73518970" style="color:#8F808F">SHOBU STYLE 2013</a></h2>
<table><tr><td>
<iframe src="//player.vimeo.com/video/73518970?title=0&amp;byline=0&amp;portrait=0&amp;color=c9ff23" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</td><td style="padding:5px 10px;vertical-align: middle;">
<img class="movie_image" src="/img/shobu/m2-1.png"><br>
<img class="movie_image" src="/img/shobu/m2-2.png"><br>
<img class="movie_image" src="/img/shobu/m2-3.png"><br>
</td></tr></table>
<span style="font-size:8px;color:grey">movie; <a href="http://vimeo.com/mvj" target="_blank" style="color:grey">MotionVisualJapan</a></span>
      </div>
    </div>
    <div style="margin-bottom:20px"></div>

    <div class="ingrid in-thirds">
      <div class="unit span-two" style="width:100%; vertical-align: middle; border-radius:10px; -webkit-border-radius:10px; -moz-border-radius:10px;">
      <h2 class="selector01"><a href="https://vimeo.com/66952255" style="color:#8F808F">音・パフォーマンス：【otto＆orabu】from しょうぶ学園</a></h2>
<table><tr><td>
<iframe src="//player.vimeo.com/video/66952255?title=0&amp;byline=0&amp;portrait=0&amp;color=c9ff23" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
</td><td style="padding:5px 10px;vertical-align: middle;">
<img class="movie_image" src="/img/shobu/m1-1.png"><br>
<img class="movie_image" src="/img/shobu/m1-2.png"><br>
<img class="movie_image" src="/img/shobu/m1-3.png"><br>
</td></tr></table>
<span style="font-size:8px;color:grey">movie; <a href="http://vimeo.com/mvj" target="_blank" style="color:grey">MotionVisualJapan</a></span>
      </div>
    </div>
    <div style="margin-bottom:20px"></div>

    <div class="ingrid in-thirds">
      <div class="unit span-two" style="width:100%; vertical-align: middle; border-radius:10px; -webkit-border-radius:10px; -moz-border-radius:10px;">
      <h2 class="selector01"><a href="http://www.youtube.com/watch?feature=player_embedded&v=Eb86tJB-iEg" style="color:#8F808F">otto & orabu PV for IMS Live 2013/3/9</a></h2>
<table><tr><td>
<iframe width="640" height="360" src="//www.youtube.com/embed/Eb86tJB-iEg?feature=player_detailpage" frameborder="0" allowfullscreen ></iframe>
</td><td style="padding:5px 10px;vertical-align: middle;">
<img class="movie_image" src="/img/shobu/m1.png"><br>
<img class="movie_image" src="/img/shobu/m2.png"><br>
<img class="movie_image" src="/img/shobu/m3.png"><br>
</td></tr></table>
<span style="font-size:8px;color:grey">movie; <a href="http://www.youtube.com/user/roadiz" target="_blank" style="color:grey">朗土 泉山</a></span>
      </div>
    </div>
    <div style="margin-bottom:20px"></div>

    <div class="ingrid in-thirds">
      <div class="unit span-two">
      <h2 class="selector01"><a href="http://www.youtube.com/watch?feature=player_embedded&v=AxwrOuIfr-o" style="color:#8F808F">KAGOSHIMA MUSIC FESTA 2012</a></h2>
<table><tr><td>
<iframe width="640" height="360" src="//www.youtube.com/embed/AxwrOuIfr-o?feature=player_detailpage" frameborder="0" allowfullscreen></iframe>
</td><td style="padding:5px 10px;vertical-align: middle;">
<img class="movie_image" src="/img/shobu/m4.png"><br>
<img class="movie_image" src="/img/shobu/m6.png"><br>
<img class="movie_image" src="/img/shobu/m5.png"><br>
</td></tr></table>
<span style="font-size:8px;color:grey">movie; <a href="http://www.youtube.com/user/shuri401" target="_blank" style="color:grey">shuri401</a></span>
      </div>
    </div>
    <div style="margin-bottom:20px"></div>

    <div class="ingrid in-thirds">
      <div class="unit span-two">
      <h2 class="selector01"><a href="http://www.youtube.com/watch?feature=player_embedded&v=CW0wkgMgAzc" style="color:#8F808F">Otto & Orabu in Good neighbors jamboree 2011</a></h2>
<table><tr><td>
<iframe width="640" height="360" src="//www.youtube.com/embed/CW0wkgMgAzc?feature=player_detailpage" frameborder="0" allowfullscreen ></iframe>
</td><td style="padding:5px 10px;vertical-align: middle;">
<img class="movie_image" src="/img/shobu/m15.png"><br>
<img class="movie_image" src="/img/shobu/m11.png"><br>
<img class="movie_image" src="/img/shobu/m7.png"><br>
</td></tr></table>
<span style="font-size:8px;color:grey">movie; <a href="http://www.youtube.com/user/shobustyle" target="_blank" style="color:grey">shobustyle</a></span>
      </div>
    </div>
    <div style="margin-bottom:20px"></div>
    <div class="ingrid in-thirds">
      <div class="unit span-two">
      <h2 class="selector01"><a href="http://www.youtube.com/watch?feature=player_embedded&v=s0aEJcOnFmY" style="color:#8F808F">Otto & Orabu in Good neighbors jamboree 2010</a></h2>
<table><tr><td>
<iframe width="640" height="360" src="//www.youtube.com/embed/s0aEJcOnFmY?feature=player_detailpage" frameborder="0" allowfullscreen ></iframe>
</td><td style="padding:5px 10px;vertical-align: middle;">
<img class="movie_image" src="/img/shobu/m14.png"><br>
<img class="movie_image" src="/img/shobu/m12.png"><br>
<img class="movie_image" src="/img/shobu/m13.png"><br>
</td></tr></table>
<span style="font-size:8px;color:grey">movie; <a href="http://www.youtube.com/user/shobustyle" target="_blank" style="color:grey">shobustyle</a></span>
      </div>
    </div>
  </div><!-- end tab3 -->

  <!-- tab4 -->
  <div class="area" id="tab4">

    <span style="font-size:8px;color:grey">※画像をクリックしたまま左にドラッグすると、画像がスクロールして作品をご覧いただけます。</span>

    <div class="ingrid in-thirds">
      <div class="unit">
        <h2 class="selector01">nui project</h2>
    		<div class="viewport" style="margin-top:20px">
    			<div class="flipsnap3">
            <?php include_partial('top/nui', array('product'=>$product[sfConfig::get('app_product_type_nui')],'type'=>'')) ?>
    			</div>
    		</div>
   		</div>
    </div>
    <span style="font-size:8px;color:grey">image; 工房しょうぶの仕事 SHOBU WORKS 2008 (DVD)</span>
    <div style="margin-bottom:20px"></div>

    <div class="ingrid in-thirds">
      <div class="unit">
        <h2 class="selector01">art & craft</h2>
    		<div class="viewport" style="margin-top:20px">
    			<div class="flipsnap4">
            <?php include_partial('top/nui', array('product'=>$product[sfConfig::get('app_product_type_art')],'type'=>'')) ?>
    			</div>
    		</div>
   		</div>
    </div>
    <span style="font-size:8px;color:grey">image; 工房しょうぶの仕事 SHOBU WORKS 2008 (DVD)</span>
    <div style="margin-bottom:20px"></div>

    <div class="ingrid in-thirds">
      <div class="unit">
        <h2 class="selector01">woodwork & pottery</h2>
    		<div class="viewport" style="margin-top:20px">
    			<div class="flipsnap7">
            <?php include_partial('top/nui', array('product'=>$product[sfConfig::get('app_product_type_products')],'type'=>sfConfig::get('app_product_type_products'))) ?>
    			</div>
    		</div>
   		</div>
    </div>
    <span style="font-size:8px;color:grey">image; 工房しょうぶの仕事 SHOBU WORKS 2008 (DVD)</span>
    <div style="margin-bottom:20px"></div>

    <div class="ingrid in-thirds">
      <div class="unit">
        <h2 class="selector01">foods</h2>
    		<div class="viewport" style="margin-top:20px">
    			<div class="flipsnap5">
            <?php include_partial('top/nui', array('product'=>$product[sfConfig::get('app_product_type_food')],'type'=>sfConfig::get('app_product_type_food'))) ?>
    			</div>
    		</div>
   		</div>
    </div>
    <div style="margin-bottom:20px"></div>

    <div class="ingrid in-halves">
      <div class="unit">
        <h2 class="selector01">books & dvds</h2>
    		<div class="viewport" style="margin-top:20px">
    			<div class="flipsnap2">
            <?php include_partial('top/product', array('product'=>$product[sfConfig::get('app_product_type_product')])) ?>
    			</div>
    		</div>
      </div>
    </div>
    <div style="margin-bottom:20px"></div>

  </div><!-- end tab4 -->

  <!-- tab5 -->
  <div class="area" id="tab5">
    <div class="ingrid in-halves">
      <div class="unit" style="width:98%;">
        <div style="margin-top:10px"></div>
        <div class="mainbox01"><div class="com-box">
        <dl>
        <dt>施設名</dt><dd><table><tr><td>社会福祉法人太陽会 障害者支援センターSHOBU STYLE</td></tr></table></dd>
        <dt>住所</dt>
        <dd>
        〒892-0871　鹿児島県鹿児島市吉野町5066番地<br>
        </dd>
        <dt>TEL</dt><dd><a href="tel:0992436639">099-243-6639</a></dd>
        <dt>FAX</dt><dd>099-243-7415</dd>
        <dt>メール</dt><dd><a href="mailto:info@shobu.jp">info@shobu.jp</a></dd>
        <dt>URL</dt><dd><a href="http://www.shobu.jp" target="_blank">http://www.shobu.jp</a></dd>
        <dt style="">アクセス</dt><dd style=""><table><tr><td><?php echo nl2br($place->getAccess()) ?></td></tr></table></dd>
        </dl>
        </div></div>
      </div>
    </div>
  </div><!-- end tab5 -->

  <div style="margin-bottom:5px"></div>

  <div id="map_area">
    <h2 class="selector01">map</h2>
    <div id="map_canvas" style="margin:0;padding:0;width:96%;height:400px;/*display:none*/"></div>
  </div>

  <div id="image_area" style="/*height:0px; visibility:hidden*/">
    <h2 class="selector01" id="image_area1" style="/*display:none*/">pinterest</h2>
    <a data-pin-do="embedBoard" href="http://www.pinterest.com/tanakazuhiko/shobu/" data-pin-scale-height="400" data-pin-board-width="1000"></a>
    <script src="//assets.pinterest.com/js/pinit.js"></script>
  </div>

</div>
<!-- /タブ -->

<div style="margin-bottom:5px"></div>

<h2 class="selector01">comment</h2>
<div class="mainbox01" style="width:92%">

  <div id="newcomment" class="newcomment"></div>

  <?php for($i=0; $i<count($comment); $i++): ?>
  <div style="width:80%;float:<?php if($i%2==0): ?>left<?php else: ?>right<?php endif ?>;">
    <div class="arrow_box<?php if($i%2!=0): ?>2<?php endif ?> over_box">
    <?php echo nl2br($comment[$i]['comment']) ?>
  </div></div>
  <div class="clearfix"></div>
  <div style="padding:10px 0px;margin:10px 0px; font-size:8pt;float:<?php if($i%2==0): ?>left<?php else: ?>right<?php endif ?>;">
    <?php echo $comment[$i]['name'] ?>&nbsp;&nbsp;<?php echo date('Y年n月j日 H:i',strtotime($comment[$i]['created_at'])) ?><br><br></div>
  <div class="clearfix" ></div>
  <?php endfor; ?>

  <?php if($comment_page>1): ?>
  <div id="morecomment" class="morecomment"></div>
  <div style="text-align:center; margin-bottom:10px" id="morecomment_link2">
  <a id="morecomment_link" onclick="more_comment()" style="cursor:pointer;"><span id="loading2">more</span></a></div>
  <?php endif ?>

<div  style="text-align:center;font-size:9pt"><a alt="wd3" class="opensec">コメントする</a></div>

</div>

<div class="clearfix" ></div>

<!-- SNS -->
<!-- Facebook -->
<!--
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=565651966841855";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-like-box" data-href="https://www.facebook.com/pages/gftdme/166822786850953" data-width="200" data-height="10" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
<!-- Twitter ->
<div style="float:left;margin-right:9px;margin-bottom:10px">
<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-dnt="true">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
<!-- google ->
<div style="float:left; margin-right:9px;margin-bottom:10px">
<div class="g-plusone" data-size="medium" data-annotation="none"></div>
</div>
<script type="text/javascript">
window.___gcfg = {lang: 'ja'};
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
po.src = 'https://apis.google.com/js/plusone.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
<!-- LINE ->
<!--
<script type="text/javascript" src="https://media.line.naver.jp/js/line-button.js" ></script>
<script type="text/javascript">
new jp.naver.line.media.LineButton({"pc":false,"lang":"ja","type":"a"});
</script>
-->
<!-- /SNS -->

<div class="clearfix" ></div>

<!-- end id="page"> --></div>

<!-- footer -->
<footer id="footer">
  <?php include_partial('global/pankuzu', array('current' => $placeName, 'parent'=>array())) ?>
  <?php include_partial('global/footer', array()) ?>
</footer>

<div class="modal wd3"><div class="modalBody" style="height:400px">
<p style="line-height: 150%">

  <div style="margin-top:20px;text-align:center;color:#59E295; font-size:10pt;" id="comment_msg" ></div>

  <form id="commentForm" method="post">
    <?php /* csrf対策用 */ echo $form->renderHiddenFields() ?>
    <input type="hidden" name="comment[place_id]" value="<?php echo $placeId ?>">
    <dl class="formset">
      <dt style="text-shadow: 0 1px 1px #333;font-weight: normal;" class="msg_box">お名前</dt>
      <dd>
        <?php echo $form['name'] ?><div id="error_name" style="display:none;color:#59E295;font-size:9pt" />
        <?php if($form['name']->renderError()):?><br><?php echo CommonUtil::replace_li_tag($form['name']->renderError()) ?><?php endif?>
      </dd>
      <dt style="text-shadow: 0 1px 1px #333;font-weight: normal;" class="msg_box">メール
      <br><span style="font-size:9px;color:#59E295">(非公開)</span></dt>
      <dd>
        <?php echo $form['mail'] ?><div id="error_mail" style="display:none;color:#59E295;font-size:9pt" />
        <?php if($form['mail']->renderError()):?><br><?php echo CommonUtil::replace_li_tag($form['mail']->renderError()) ?><?php endif?>
      </dd>
      <dt style="text-shadow: 0 1px 1px #333;font-weight: normal;" class="msg_box">コメント</dt>
      <dd>
        <span style="color:#59E295; margin-bottom:5px">
        <?php if($form['comment']->renderError()):?><?php echo CommonUtil::replace_li_tag($form['comment']->renderError()) ?><?php endif?>
        </span>
        <?php echo $form['comment'] ?>
        <div id="error_comment" style="display:none;color:#59E295;font-size:9pt" />
      </dd>
    </dl>
  	<div class="clearfix"></div>
    <button id="send" type="submit" style="background-color:grey" >コメントする</button>
  </form>

</p>
  <p class="close" style="margin-top:20px">－</p>
</div></div>

<!-- script -->
<script type="text/javascript">
<?php if($type): ?>
<?php
if($type=="events")     $tab="1";
elseif($type=="words")  $tab="2";
elseif($type=="images") $tab="3";
elseif($type=="works")  $tab="4";
elseif($type=="info")   $tab="5";
else                    $tab="1";
?>
$(document).ready(function() {
	$('.area').hide();
	$('.tab li').removeClass('active');
	$('#tab<?php echo $tab ?>_menu').parent().addClass('active');
	$('#tab<?php echo $tab ?>').fadeIn();
	$('#tab<?php echo $tab ?>').show();

	//if($type=="words") hide_map();
});
<?php endif ?>

$(document).ready(function() {
	var touchFlg = false;//---最初はタッチされていない
	var maxPage = 5-1;

	var $pointer = $('.pointer span');
	var flipsnap = Flipsnap('.flipsnap', {});

  flipsnap.element.addEventListener('fspointmove', function() {
    $pointer.filter('.current').removeClass('current');
    $pointer.eq(flipsnap.currentPoint).addClass('current');
  }, false);

  var $next = $('.next').click(function() {
    flipsnap.toNext();
  });
  var $prev = $('.prev').click(function() {
    flipsnap.toPrev();
  });

	//---５秒でページを切り替える
	function changeFunc() {
		if ( touchFlg ) return;//----タッチ中であれば処理しない
		maxPage < flipsnap.currentPoint+1 ? flipsnap.moveToPoint(0) : flipsnap.toNext();
	}
	//setInterval(changeFunc,3000);

	//---タッチの管理
	$(".flipsnap").on("touchstart mousedown" ,function(){touchFlg = true});
	$(".flipsnap").on("touchend touchcancel mouseup" ,function(){touchFlg = false});

  Flipsnap('.flipsnap2', {
    distance: 210,
  });
  Flipsnap('.flipsnap3', {
    distance: 210,
  });
  Flipsnap('.flipsnap4', {
    distance: 210,
  });
  Flipsnap('.flipsnap5', {
    distance: 210,
  });
  Flipsnap('.flipsnap7', {
    distance: 210,
  });
});

$(function() {
	$('.nui_image, .product_image, .movie_image')
	.hover(
		function(){
			$(this).stop().animate({
				'opacity':'0.8'
			}, 200);
		},
		function () {
			$(this).stop().animate({
				'opacity':'1'
			}, 200);
		}
	);
	$('.prev_btn, .next_btn')
	.hover(
		function(){
			$(this).stop().animate({
				'opacity':'0.4'
			}, 200);
		},
		function () {
			$(this).stop().animate({
				'opacity':'0.1'
			}, 200);
		}
	);
});

$(document).ready(function(){
	comment_hover();
});
this.comment_hover = function(){
  $(".over_box").hover(function() {
    $(this).stop().animate({ backgroundColor: "#B8F8D4", color: "#2C2C2C"}, 200);
  },function() {
    $(this).stop().animate({ backgroundColor: "#ffffff", color: "#515151"}, 200);
  });
};

$(document).ready(function() {
  // コメントフォーム
  //  $("#commentForm").validate(); // バリデーションとAjaxPOSTがうまく共存できない為コメントアウト
  $("#send").click(function(event) {
    event.preventDefault();
    var form  = $("#commentForm");
    var param = {};
    res = form.serializeArray();
    var error_flag = false;
    $(form.serializeArray()).each(function(i, v){
      param[v.name] = v.value;
      if(v.name=="comment[name]"){
        if(!v.value){
          $("#error_name").css("display", "block");
          $("#error_name").html("お名前が未入力です。");
          error_flag = true;
        }else{
          $("#error_name").css("display", "none");
        }
      }
      else if(v.name=="comment[mail]"){
        if(!v.value){
          $("#error_mail").css("display", "block");
          $("#error_mail").html("メールが未入力です。");
          error_flag = true;
        }
        else if(!v.value.match( /^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/g)) {
          $("#error_mail").css("display", "block");
          $("#error_mail").html("正しいメールアドレスを入力してください。");
          error_flag = true;
        }else{
          $("#error_mail").css("display", "none");
        }
      }
      else if(v.name=="comment[comment]"){
        if(!v.value){
          $("#error_comment").css("display", "block");
          $("#error_comment").html("コメントが未入力です。");
          error_flag = true;
        }else{
          $("#error_comment").css("display", "none");
        }
      }
    });
    if(error_flag)  return false;
    console.log(param);

    $.ajax({
  	  url: "<?php echo url_for('top/comment?placeId='.$placeId) ?>",
  		type: "POST",
      data: param,
      success: function(data) {
        $("#commentForm").css("display", "none");
  			$("div.newcomment").prepend(data);
        $("#comment_name").val("");
        $("#comment_mail").val("");
        $("#comment_comment").val("");
        $("#comment_msg").html("投稿が完了しました。<br /><br />コメントありがとうございました。");
      },
      error: function() {
        alert('error');
      }
    });
    return false;
  });
});

var count_event = 0;
function more_event() {
  count_event++;
  $("#loading").html("<img src='/img/loading.gif' width='12px' />");
	$.ajax({
		type: "GET",
	  url: "<?php echo url_for('top/moreevent?placeId='.$placeId) ?>",
		dataType: "html",
		data: "count="+count_event,
	  cache: false,
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      //alert(textStatus +":"+ errorThrown);
    },
	  success: function(html){
  	  $("#loading").html("more");
			$("div.moreevent").append(html);
	  }
	});
  if(count_event >= <?php echo $event_page-1 ?>){
		$("#moreevent_link").remove();
		$("#moreevent_link2").append("<p style='color:#59E295;text-align:center; margin-bottom:10px; font-size:10pt'><img src='/img/end.png' width='10px'></p>");
  }
}
var count_comment = 0;
function more_comment() {
  count_comment++;
  $("#loading2").html("<img src='/img/loading.gif' width='12px' />");
	$.ajax({
		type: "GET",
	  url: "<?php echo url_for('top/morecomment?placeId='.$placeId) ?>",
		dataType: "html",
		data: "count="+count_comment,
	  cache: false,
    error: function(XMLHttpRequest, textStatus, errorThrown) {
      //alert(textStatus +":"+ errorThrown);
    },
	  success: function(html){
  	  $("#loading2").html("more");
			$("div.morecomment").append(html);
	  }
	});
  if(count_comment >= <?php echo $comment_page-1 ?>){
		$("#morecomment_link").remove();
		$("#morecomment_link2").html("<p style='color:#59E295;text-align:center; margin-bottom:10px; font-size:10pt'><img src='/img/end.png' width='10px'></p>");
  }
}
var count_interview = 0;
function more_interview() {
  var loading = "#loading3";
  count_interview++;
  $(loading).html("<img src='/img/loading.gif' width='12px' />");
	$.ajax({
		type: "GET",
	  url: "<?php echo url_for('top/moreinterview?placeId='.$placeId) ?>",
		dataType: "html",
		data: "count="+count_interview,
	  cache: false,
    error: function(XMLHttpRequest, textStatus, errorThrown) {
    },
	  success: function(html){
  	  $(loading).html("more");
			$("div.moreinterview").append(html);
	  }
	});
  if(count_interview >= <?php echo $interview_page-1 ?>){
		$("#moreinterview_link").remove();
		$("#moreinterview_link2").html("<p style='color:#59E295;text-align:center; margin-bottom:10px; font-size:10pt'><img src='/img/end.png' width='10px'></p>");
  }
}
var count_blog = 0;
function more_blog() {
  var loading = "#loading_blog";
  count_blog++;
  $(loading).html("<img src='/img/loading.gif' width='12px' />");
	$.ajax({
		type: "GET",
	  url: "<?php echo url_for('top/moreblog?placeId='.$placeId) ?>",
		dataType: "html",
		data: "count="+count_blog,
	  cache: false,
    error: function(XMLHttpRequest, textStatus, errorThrown) {
    },
	  success: function(html){
  	  $(loading).html("more");
			$("div.moreblog").append(html);
	  }
	});
  if(count_blog >= <?php echo $blog_page-1 ?>){
		$("#moreblog_link").remove();
		$("#moreblog_link2").html("<p style='color:#59E295;text-align:center; margin-bottom:10px; font-size:10pt'><img src='/img/end.png' width='10px'></p>");
  }
}

function hide_map(){
	$("#map_area").css({'display':'none'});
}
function view_map(){
	$("#map_area").css({'display':'block'});
}
hide_image();
function hide_image(){
	$("#image_area1").css({'display':'none'});
	$("#image_area").css({'height':'0'});
	$("#image_area").css({'visibility':'hidden'});
}
function view_image(){
	$("#image_area1").css({'display':'block'});
	$("#image_area").css({'height':'520'});
	$("#image_area").css({'visibility':'visible'});
}


$(function(){
  initialize();
});
function initialize() {
  var myLatlng = new google.maps.LatLng(<?php echo $place->getLatitude() ?>, <?php echo $place->getLongitude() ?>);
  var center   = new google.maps.LatLng(<?php echo $place->getLatitude()+3 ?>, <?php echo $place->getLongitude()+5 ?>);
  var myOptions = {
      zoom: 6,
      center: center,
      mapTypeId: google.maps.MapTypeId.TERRAIN,
      scrollwheel:false,
      streetViewControl:false,
      disableDefaultUI: true,
      zIndex:100
  };
  var map  = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

  var contentString = "<div style='margin:0px; overflow: hidden;'>";
  contentString += "<img src='https://s-media-cache-ak0.pinimg.com/564x/32/93/86/3293860689af7b661f3de06171c55be6.jpg' width=200px"
  contentString += " class='tooltip' title='image; http://www.g-mark.org/award/describe/40584'>";
  contentString += "<div class='' style='font-size:11px; color:grey; text-align:left;margin:5px 0px'><?php echo $placeName ?></div>";
  contentString += "<div style='font-size:8px; color:grey;margin:5px 0px'><?php echo nl2br($place->getAddress())?></div>";
  contentString += "</div>";
  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });
  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title:"<?php echo $placeName ?>",
  });
  infowindow.open(map,marker);

  var open_flag = true;
  google.maps.event.addListener(marker, 'click', function() {
    if(open_flag){
      infowindow.close();
      open_flag = false;
    }else{
      infowindow.open(map,marker);
      open_flag = true;
    }
  });
  google.maps.event.addListener(marker, 'mouseover', function() {
    infowindow.open(map,marker);
    open_flag = true;
  });

  <?php for($i=0; $i<count($event_all); $i++): if(!$event_all[$i]['latitude']) continue; ?>
    var Latlng = new google.maps.LatLng(<?php echo $event_all[$i]['latitude'] ?>, <?php echo $event_all[$i]['longitude'] ?>);
    var contentString = "<div style='margin:0px; overflow: hidden;'>";
    contentString += "<img src='<?php echo $event_all[$i]['image'] ?>' width=150px>"
    contentString += "</div>";
    var infowindow_<?php echo $i ?> = new google.maps.InfoWindow({
      content: contentString
    });
    var marker_<?php echo $i ?> = new google.maps.Marker({
      position: Latlng,
      map: map,
      title:"<?php echo $event_all[$i]['name'] ?>",
    });

    var open_flag_<?php echo $i ?> = true;

    //infowindow_<?php echo $i ?>.open(map, marker_<?php echo $i ?>);
    google.maps.event.addListener(marker_<?php echo $i ?>, 'click', function() {
      if(open_flag_<?php echo $i ?>){
        infowindow_<?php echo $i ?>.close();
        open_flag_<?php echo $i ?> = false;
      }else{
        infowindow_<?php echo $i ?>.open(map,marker_<?php echo $i ?>);
        open_flag_<?php echo $i ?> = true;
      }
    });
  <?php endfor; ?>
}
</script>
