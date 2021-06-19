<?php
  $ua     = $_SERVER['HTTP_USER_AGENT'];
  $device = ((strpos($ua,'iPhone')!==false)||(strpos($ua,'Android')!==false)) ? 'smp' : 'pc';
  $action = $sf_context->getActionName();
?>
<?php if(!isset($no_top) || $no_top==false): ?>
<div id="pagetop"><img src="/img/arrowtop.png" class="cnr"></div>
<?php endif ?>
<div class="GNMenu"><div class="GNMinside headerArea">
<a href="/"><img class="switch" src="/img/logo.png" ></a>
<a id="pagetop2" style="cursor: pointer"><img class="switch" style="margin-left:5px; cursor: pointer" src="/img/<?php echo $place ?>.png" ></a> 
<?php if($action != 'shobu'): ?>
<span style="<?php if($device=='smp'): ?>width:120px; margin-top:-20px;<?php else: ?>width:250px; margin-top:45px;<?php endif ?> font-size:12px; text-shadow: 1px 1px #FFFFFF; float:right;">
<?php if($device=='pc' || ($device=='smp' && $action!='link')): ?>
<a href="/link" class="h_menu" style="color:#767477;padding: 5px;">リンク</a>
<?php endif ?>
<?php if($device=='pc' || ($device=='smp' && $action!='event')): ?>
<a href="/event" class="h_menu" style="color:#767477;padding: 5px;">イベント</a>
<?php endif ?>
<?php if($device=='pc'): ?>
<a href="/art" class="h_menu" style="color:#767477;padding: 5px;">アート</a>
<?php endif ?>
</span>
<?php endif ?>
</div></div>
<style type="text/css">
a:hover {
  color: #59E295
}
</style>
<script type="text/javascript">
$(document).ready(function() {
  $(".h_menu") .hover(function(){
     $(this).css('color', '#59E295');
  },function(){
     $(this).css('color', '#767477');
  });
});
</script>