
<?php $description = sfConfig::get('app_meta_description_'.$sf_context->getActionName()); slot('description', $description) ?>
<?php $title = sfConfig::get('app_title_'.$sf_context->getModuleName()); slot('title', $title[$sf_context->getActionName()])?>
<?php include_partial('global/header', array('isAuthenticated' => $isAuthenticated, 'place'=>'board')) ?>

<link   href="/css/sDashboard.css" rel="stylesheet">
<script src="/js/sdashboard/example/libs/gitter/jquery.gritter.js" type="text/javascript"> </script>
<script src="/js/sdashboard/example/libs/datatables/jquery.dataTables.js"> </script>
<script src="/js/sdashboard/example/libs/flotr2/flotr2.js" type="text/javascript"> </script>
<script src="/js/sdashboard/jquery-sDashboard.js" type="text/javascript"> </script>

<script type="text/javascript">
var ch_flag   = [];
ch_flag['tw'] = false;
ch_flag['fb'] = false;

	$(function() {
		//**********************************************//
		//dashboard json data
		//this is the data format that the dashboard framework expects
		//**********************************************//
		var dashboardJSON = [

<?php for($i=0; $i<count($link); $i++):  ?>
  <?php if($link[$i]['twitter_widget_id']): ?>
		  {
				widgetTitle : "<img src='/img/board/tw.png' width='15px'> <?php echo $link[$i]['name'] ?>",
				widgetId : "tw_<?php echo $link[$i]['id'] ?>",
				widgetContent : $("#tw_<?php echo $link[$i]['id'] ?>")
			}, 
  <?php endif ?>
  <?php if($link[$i]['facebook']): ?>
		  {
				widgetTitle : "<img src='/img/board/fb.png' width='15px'> <?php echo $link[$i]['name'] ?>",
				widgetId : "fb_<?php echo $link[$i]['id'] ?>",
				widgetContent : $("#fb_<?php echo $link[$i]['id'] ?>")
			}, 
  <?php endif ?>
<?php endfor ?>

		  {
				widgetTitle : "<img src='/img/board/fb.png' width='15px'> gifted",
				widgetId : "fb_gifted",
				widgetContent : $("#fb_gifted")
			}, 
		];

		//basic initialization example
		$("#myDashboard").sDashboard({
			dashboardData : dashboardJSON
		});
		
//		show_cat('tw');
//		active('f_tw');
	});

function check_all(type) {
  $('input.cb_'+type+':checkbox').prop('checked', ch_flag[type]);
  if(ch_flag[type])
    $('[id^='+type+'_]').css({'display':'block'});
  else
    $('[id^='+type+'_]').css({'display':'none'});
  
  ch_flag[type] = !ch_flag[type];
}
function show_board(open) {
  if($("#cb_"+open+":checked").val()){
    $("#"+open).css({'display':'block'});
    $("div#"+open).css({'display':'block'});
  }else{
    $("#"+open).css({'display':'none'});
  }
}

function set_check() {
  var arr = $("#myDashboard").sDashboard("option","dashboardData");
  for (var i = 0; i < arr.length; i++) {
    $("#cb_"+arr[i]['widgetId']).attr("checked", true);
  }
}
function show_cat(open) {
  $("ul#myDashboard li").css({'display':'none'});
  if(open=='all')
    $("ul#myDashboard li").css({'display':'block'});
  else
    $('[id^='+open+'_]').css({'display':'block'});
}
function active(id) {
	$('.filter').removeClass('active');
	$('#'+id).addClass('active');
}
function scroll_top() {
	$('html,body').animate({ scrollTop: 0 }, 'normal');
}
</script>
</head>

<body style="background-image:url('/img/board/wood.png');background-size:auto; min-height:200px;">

<div style="margin-top:<?php if($device == "pc"): ?>90px<?php else: ?>70px<?php endif ?>; margin-left:20px;">

  <div style="font-size:12px;color:grey;text-align:center" class="spot_dlg">
    <!--
    <span class="filter" id="f_tw" style="cursor:pointer" onclick="show_cat('tw'); active('f_tw');">twitter</span>　
    <span class="filter" id="f_fb" style="cursor:pointer" onclick="show_cat('fb'); active('f_fb');">facebook</span>　
    <span class="filter" id="f_all" style="cursor:pointer" onclick="show_cat('all'); active('f_all');">全て</span>　
    -->
    <a alt="wds" class="opensec" onclick="set_check(); scroll_top()">スポット選択</a>　
  </div>
	
	<ul id="myDashboard"></ul>

  <?php for($i=0; $i<count($link); $i++):  ?>
    <?php if($link[$i]['twitter_widget_id']): ?>
  	<div id="tw_<?php echo $link[$i]['id'] ?>" style=" width:<?php if($device == "pc"): ?>100%<?php else: ?>100%<?php endif ?>; height:412px; -webkit-overflow-scrolling: touch; <?php if($device == "pc"): ?>overflow:hidden;<?php else: ?>overflow:auto;<?php endif ?>">
  	  <!--<iframe id="frame_tw" src="/tw/<?php echo $link[$i]['id'] ?>" scrolling="no" frameborder="0" allowTransparency="true"
  		  style="width:100%;height:410px; border:none; overflow:hidden; background-color:white;"></iframe>-->
  		<iframe id="frame_tw" src="/twitter/<?php echo $link[$i]['id'] ?>.html" 
  		  scrolling="yes" frameborder="0" allowTransparency="true" 
  		  style="<?php if($device == "pc"): ?>width:100%<?php else: ?>width:200px<?php endif ?> !important; height:410px !important; border:none; overflow:auto; background-color:white;"></iframe>
  	</div>
  	<?php endif ?>
  	
    <?php if($link[$i]['facebook']): ?>
  	<div id="fb_<?php echo $link[$i]['id'] ?>"> 
      <iframe id="frame_fb" 
        src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F<?php echo urlencode($link[$i]['facebook']) ?>&amp;width&amp;height=410&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=true&amp;show_border=false&amp;appId=565651966841855" 
        scrolling="no" frameborder="0"  allowTransparency="true"
        style="width:100%;height:410px; border:none; overflow:hidden; background-color:white;"></iframe>
  	</div>
  	<?php endif ?>
  <?php endfor ?>

  	<div id="fb_gifted"> 
      <iframe id="frame_fb" 
        src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages/Gifted/166822786850953&amp;width&amp;height=410&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=true&amp;show_border=false&amp;appId=565651966841855" 
        scrolling="no" frameborder="0"  allowTransparency="true"
        style="width:100%;height:410px; border:none; overflow:hidden; background-color:white;"></iframe>
  	</div>
  
<script>
!function(d,s,id){
var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
fjs.parentNode.insertBefore(js,fjs);}
}(document,"script","twitter-wjs");
</script>

</div>

<!-- スポット -->
<div class="modal wds"><div class="modalBody" style="width:400px; height:500px; padding:20px;line-height: 130%; text-align:center; vertical-align:middle;  overflow: hidden;">
  <p class="close" style="margin-top:0px">－</p>
  
 <div style="font-size:9pt; color:#59E295">スポット選択</div>
  <table style="font-size:8pt; text-align:left; margin-bottom:2px;">
  <tr>
    <td class="cp pd18_w" onclick="check_all('tw')"><img src="/img/board/tw.png" width="15px"></td>
    <td class="cp pd18_w" onclick="check_all('fb')"><img src="/img/board/fb.png" width="15px"></td>
    <td class="pd18_w" >名称</td>
  </tr>
  </table>
 <div style="overflow-x:hidden; overflow-y:scroll; width:370px; height:420px; padding:0px;line-height:130%; text-align:center; vertical-align:middle;"> 
  <table style="font-size:8pt; text-align:left">
  <?php foreach($link as $key => $value):?>
    <?php if(!$value['twitter_widget_id'] && !$value['facebook']) { continue; } ?>
    <tr style="font-size:8pt; text-align:left">
      <td style="padding:0 10px; text-align:center">
        <?php if($value['twitter_widget_id']): ?>
          <input type="checkbox" name="show_id" class="cb_tw" value="tw_<?php echo $value['id'] ?>" id="cb_tw_<?php echo $value['id'] ?>" onclick="show_board('tw_<?php echo $value['id'] ?>');">
        <?php endif ?>
      </td>
      <td style="padding:0 10px; text-align:center">
        <?php if($value['facebook']): ?>
          <input type="checkbox" name="show_id" class="cb_fb" value="fb_<?php echo $value['id'] ?>" id="cb_fb_<?php echo $value['id'] ?>" onclick="show_board('fb_<?php echo $value['id'] ?>');">
        <?php endif ?>
      </td>
      <td nowrap><?php echo $value['name'] ?></td>
    </tr>
  <?php endforeach ?>
  </table>
 </div>
 <div style="font-size:7pt;color:#59E295;margin-top:10px;">
 ※Twitterの制限に達してしまった場合、時間を置いてお試し下さい。
 <!--<br>　(このページは更新しないようお願い致します。)-->
 </div>
  <p class="close" style="margin-top:-15px">－</p>
</div></div>
<!-- /スポット -->

<footer id="footer" >
  <?php include_partial('global/pankuzu', array('current' => $title[$sf_context->getActionName()], 'parent'=>array())) ?>
  <?php include_partial('global/footer', array()) ?>
</footer>

<style type="text/css">
.opensec {
  color:#009966;
}
.opensec:hover {
  color:#006666;
}
.active {
  color:#009966;
  font-weight:bold;
}
.cp   {  cursor: pointer; }
.pd17 {  padding: 17px; }
.pd18_w {  padding-right: 18px; padding-left: 19px; }

.sDashboard li {
<?php if($device == "pc"): ?>
	width: 400px;
<?php else: ?>
	width: 260px;
<?php endif ?>
}
<?php if($device == "pc"): ?>
<?php else: ?>
.sDashboard-circle-plus-icon {
  display: none;
}
.sDashboard-circle-remove-icon {
  display: none;
}
.spot_dlg {
  display: none;
}
<?php endif ?>
</style>

<script type="text/javascript">
</script>
