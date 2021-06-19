
<?php slot('title', sfConfig::get('app_title_error').' - '.sfContext::getInstance()->getResponse()->getTitle())?>
<?php slot('body_id', 'Top') ?>
<?php include_partial('global/header', array('title' => '404エラー', 'isAuthenticated' => $isAuthenticated )) ?>

<div class="container">
	<h2 class="cntsTitle">ページがありません。</h2>
	<div class="cntsBox"><div class="formBox">
		<p class="leadTxt" style="color:red">再度TOPページから試してください。<br><?php echo $msg;?></p>

		<p class="btn"><a href="/">トップページへ</a></p>
	</div></div><!-- /cntsBox -->
</div><!-- /container -->

<?php include_partial('global/footer', array()) ?>
