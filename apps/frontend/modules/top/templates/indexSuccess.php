
<?php $append=($isAuthenticated)?'2':''; $title=sfConfig::get('app_title_'.$sf_context->getModuleName()); slot('title', $title[$sf_context->getActionName().$append])?>
<?php include_partial('global/header', array('isAuthenticated' => $isAuthenticated )) ?>

<div id="page">

<div class="intro ingrid in-fourths">
  <div class="unit">


  </div>
  <div class="unit span-three">

<!--
  <div class="infobox2 ie8-lte-hdn">
    <div class="list-carousel responsive">
    <span class="mo-hdn">Mobageモバコインカード／Amebaプリペイドカードなど、</span>便利な<a href="/category" class="txtl">バーチャル・プリカ</a>が続々登場！
      <ul id="cardlist">
        <li><a href="/ameba/1500"><img src="/img/img_card_ameba_1500_01.png" /></a></li>
        <li><a href="/ameba/5000"><img src="/img/img_card_ameba_5000_01.png" /></a></li>
        <li><a href="/mobage/2000"><img src="/img/img_card_mobage_2000_01.png" /></a></li>
        <li><a href="/mobage/5000"><img src="/img/img_card_mobage_5000_01.png" /></a></li>
        <li><a href="/mobage/10000"><img src="/img/img_card_mobage_10000_01.png" /></a></li>
        <li><a href="/musicjp/1000"><img src="/img/img_card_musicjp_1000_01.png" /></a></li>
        <li><a href="/musicjp/3000"><img src="/img/img_card_musicjp_3000_01.png" /></a></li>
        <li><a href="/ameba/1500"><img src="/img/img_card_ameba_1500_01.png" /></a></li>
        <li><a href="/ameba/5000"><img src="/img/img_card_ameba_5000_01.png" /></a></li>
        <li><a href="/mobage/2000"><img src="/img/img_card_mobage_2000_01.png" /></a></li>
        <li><a href="/mobage/5000"><img src="/img/img_card_mobage_5000_01.png" /></a></li>
        <li><a href="/mobage/10000"><img src="/img/img_card_mobage_10000_01.png" /></a></li>
        <li><a href="/musicjp/1000"><img src="/img/img_card_musicjp_1000_01.png" /></a></li>
        <li><a href="/musicjp/3000"><img src="/img/img_card_musicjp_3000_01.png" /></a></li>
      </ul>
      <div class="clearfix"></div>
        <a class="cardlist-prev" id="cardlist_prev" href=""><span></span></a>
        <a class="cardlist-next" id="cardlist_next" href=""><span></span></a>
    </div>
  </div>
-->
    <div class="mo-hdn ingrid in-thirds">
      <div class="unit span-two">
        <div class="top-mess sepV10 sepH20">
        <h1>gifted :: 神様のおくりもの</h1>
        <h3>共にいることが大切である。共にいてくれる人がいれば、問いだけあって答えがないところであっても人はなお前に向かって生きることができる。</h3>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="clearfix"></div>

<!-- タブメニュー -->
<div class="sepH10">
  <ul class="tab">
  <li><a name="#tab1">place</a></li>
  <li><a name="#tab2">shop</a></li>
  <li><a name="#tab3">art</a></li>
  <li><a name="#tab4">etc</a></li>
  </ul>
</div>
<!-- /タブメニュー -->

<!-- タブ -->
<div class="tabcontent">

  <div class="area" id="tab1">
    <div class="ingrid in-thirds">
      <div class="unit span-two">
      </div>

    </div>
  </div><!-- end tab1 -->

  <div class="area" id="tab2">
    <div class="ingrid in-thirds">
      <div class="unit span-two">
      </div>

      <aside class="unit">
        <div class="infobox lh">
        </div>
      </aside>
    </div>
  </div><!-- end tab2 -->

  <div class="area" id="tab3">
    <div class="ingrid in-halves">
      <div class="unit">
      </div>

      <aside class="unit">
        <div class="infobox lh">
        </div>
      </aside>
    </div>
  </div><!-- end tab3 -->


  <div class="area" id="tab4">
    <div class="ingrid in-thirds">
      <div class="unit span-two">
      </div>
    </div>
  </div><!-- end tab4 -->


  <div class="area" id="tab5">
    <div class="ingrid in-halves">
      <div class="unit">
      </div>

      <aside class="unit">
        <div class="infobox lh">
        </div>
      </aside>
    </div>
  </div><!-- end tab5 -->

</div>
<!-- /タブ -->

<div class="pcH30"></div>

  <div class="ingrid in-halves">

    <div class="unit">
    <h2 class="h-style01"><span><span class="h-ico01">infomation</span></span></h2>
      <div class="mainbox01">
        <ul class="news01">
          <li><a href="/faq#type-of-prepaidcard">2013.08.01</a></li>
          <li><a href="/faq#receipt-of-goods">2013.07.31</a></li>
          <li class="more"><a href="/news">もっと見る</a></li>
        </ul>
      </div>
    </div>
  </div>

<!-- end id="page"> --></div>

<footer id="footer">
  <?php include_partial('global/pankuzu', array('current' => $title[$sf_context->getActionName()], 'parent'=>array())) ?>
  <?php include_partial('global/footer', array()) ?>
</footer>
