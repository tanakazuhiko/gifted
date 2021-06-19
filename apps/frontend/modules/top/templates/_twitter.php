
<a class="twitter-timeline" data-chrome="noheader nofooter noborders" 
  height="<?php if($device == "pc"): ?><?php if($height): ?><?php echo $height ?><?php else: ?>400<?php endif ?><?php else: ?>400<?php endif ?>" 
  href="https://twitter.com/<?php echo $detail['twitter'] ?>" 
  data-widget-id="<?php echo $detail['twitter_widget_id'] ?>" id="<?php echo $detail['twitter_widget_id'] ?>"></a>

<script>
!function(d,s,id){
  var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
  if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js,fjs);}
}(document,"script","twitter-wjs");
</script>

<style type="text/css">
/*
$(document).ready(function() {
	$("#410739042821496832").width("10px");
	$("#<?php echo $tw_id ?>").css("display", "block");
});
*/
</style>

<style type="text/css">
/*
.twitter-timeline {
  display:none;
   min-width: 800px !important;
}
*/
</style>
