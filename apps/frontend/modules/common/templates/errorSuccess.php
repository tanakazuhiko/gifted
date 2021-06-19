
<?php slot('title', sfConfig::get('app_title_error').' - '.sfContext::getInstance()->getResponse()->getTitle())?>
<?php slot('body_id', 'Top') ?>
<?php include_partial('global/header', array('title' => 'エラー', 'isAuthenticated' => $isAuthenticated )) ?>

<div class="container">
  <h2 class="cntsTitle">エラーが発生しました</h2>
  <div class="cntsBox"><div class="formBox">
    <p class="leadTxt" style="color:red">
    <?php if($msg): ?>
      <?php echo  $msg;?>
    <?php else: ?>
      再度試してもうまくいかない場合は事務局にお問合せください。<br>
    <?php endif; ?>
    </p>
    <p class="btn"><a href="/">トップページへ</a></p>
  </div></div><!-- /cntsBox -->
</div><!-- /container -->


<?php include_partial('global/footer', array()) ?>
