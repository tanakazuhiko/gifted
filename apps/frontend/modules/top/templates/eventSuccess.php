
<?php $description = sfConfig::get('app_meta_description_'.$sf_context->getActionName()); slot('description', $description) ?>
<?php $title = sfConfig::get('app_title_'.$sf_context->getModuleName()); slot('title', $title[$sf_context->getActionName()])?>
<?php include_partial('global/header', array('isAuthenticated' => $isAuthenticated, 'place'=>'event')) ?>

<div class="map_base">
  <div id="map_area">
    <div id="map_canvas" style="margin:0;padding:0;width:100%;height:<?php if($device == "pc"): ?>300px<?php else: ?>250px<?php endif ?>;/*display:none*/"></div>
  </div>
</div>

<div style="margin-bottom:0px"></div>

<!-- page -->
<div id="page">
<div class="clearfix"></div>

<!-- タブメニュー -->
<div class="sepH10">
  <ul class="tab">
  <li id="tab1_menu" onclick="set_tab('tab1'); ga('send', 'top', 'link', 'click', 'list');"><a name="#tab1">list</a></li>
  <li id="tab2_menu" onclick="set_tab('tab2'); ga('send', 'top', 'link', 'click', 'info');" ><a name="#tab2">calender</a></li>
  </ul>
</div>
<!-- /タブメニュー -->

<!-- タブ -->
<div class="tabcontent">

  <!-- tab1 -->
  <div class="area" id="tab1">

  <div style="font-size:12px;color:grey;text-align:center;line-height:150%;">
    
    <!--
    <span class="filter" style="cursor:pointer" onclick="event_list('current',true)">開催中</span>(<?php echo $count_array['date']['current'] ?>件)&nbsp;
    <span class="filter" style="cursor:pointer" onclick="event_list('future',true)">開催予定</span>(<?php echo $count_array['date']['future'] ?>件)&nbsp;
    span class="filter" id="filter_active2” style="cursor:pointer" onclick="event_list('active',true)">開催中+開催予定</span>(<?php echo ($count_array['date']['future']+$count_array['date']['current']) ?>件)&nbsp; 
    <span class="filter" style="cursor:pointer" onclick="event_list('active',true)">開催中+開催予定</span>(件)&nbsp;
    <?php if($device != "pc"): ?><br /><?php else: ?> | <?php endif ?>
    -->
    
    <span class="filter active" style="cursor:pointer"  id="filter_active" onclick="event_list('flag_art',true)">アート</span>(<?php echo $count_array['category']['flag_art'] ?>件)&nbsp;
    <span class="filter" style="cursor:pointer" onclick="event_list('flag_product',true)">プロダクト</span>(<?php echo $count_array['category']['flag_product'] ?>件)&nbsp;
    <span class="filter" style="cursor:pointer" onclick="event_list('flag_music',true)">音楽</span>(<?php echo $count_array['category']['flag_music'] ?>件)&nbsp;
    <span class="filter" style="cursor:pointer" onclick="event_list('flag_dance',true)">ダンス</span>(<?php echo $count_array['category']['flag_dance'] ?>件)&nbsp;
    <span class="filter" style="cursor:pointer" onclick="event_list('flag_talk',true)">講演</span>(<?php echo $count_array['category']['flag_talk'] ?>件)&nbsp;
    <span class="filter" style="cursor:pointer" onclick="event_list('flag_food',true)">フード</span>(<?php echo $count_array['category']['flag_food'] ?>件)&nbsp;
    <br />
    <?php if($device == "pc"): ?>
    都道府県：
    <select style="width:200px; display:inline;" onchange="event_list2(this.id, 'pref_')" id="select_area" class="selectbox">
      <option value="all">全て</option>
      <?php for($i = 1; $i <= 47; $i++): ?>
        <option value="<?php echo $i ?>" <?php if(!isset($count_array['pref'][$i])): ?>disabled style="background-color:whitesmoke;"<?php endif ?>>
        <?php echo $pref_id_array[$i] ?> <?php if(isset($count_array['pref'][$i])): ?>(<?php echo $count_array['pref'][$i] ?>件)<?php endif ?>
        </option>
      <?php endfor ?>
    </select>　
    スポット：
    <select style="width:200px; display:inline;" onchange="event_list2(this.id, 'place_'); set_spot();" id="select_spot" class="selectbox">
      <option value="all">全て</option>
      <?php foreach($count_array['place'] as $name => $count): ?>
      <?php if($name==""||$name=="koro/art & design in welfare") continue; ?>
        <option value="<?php echo $name ?>"><?php echo $name ?> (<?php echo $count ?>件)</option>
      <?php endforeach; ?>
    </select>　
    年度：
    <select style="width:200px; display:inline;" onchange="event_list2(this.id, 'year_')" id="select_year" class="selectbox">
      <option value="all">全て</option>
      <?php for($i = $year_array['max']; $i >= $year_array['min']; $i--): ?>
        <option value="<?php echo $i ?>" <?php if(!isset($count_array['year'][$i])): ?>disabled style="background-color:whitesmoke;"<?php endif ?>>
          <?php echo $i ?>年 <?php if(isset($count_array['year'][$i])): ?>(<?php echo $count_array['year'][$i] ?>件)<?php endif ?>
        </option>
      <?php endfor ?>
   </select>
   <?php endif ?>
  </div>

    <div class="ingrid in-halves">
      <div class="unit" style="width:100%;">
        <div style="margin-top:10px"></div>
        <div class="mainbox01"><div class="com-box">
        <dl>
        <?php if($device == "pc"): ?>
          <dt nowrap style="width:370px; font-size:8pt; font-weight:normal;color:#59E295;">
          イベント&nbsp;
          </dt>
          <dd style="font-size:8pt; font-weight:normal;color:#59E295;">
          <span>
          会期&nbsp;
          </span>
          <span style="margin-left:145px;">
          会場&nbsp;
          </span>
          </dd>
        <?php else: ?>
        <?php endif ?>

<div id="Grid2">
<span class="loading2"></span>
</div>
        </dl>
        </div></div>
      </div>
    </div>
  </div>
  <!-- /tab1 -->

  <!-- tab2 -->
  <div class="area" id="tab2">
    <div class="ingrid in-thirds"><div class="unit" style="width:100%; ">
    <div style="margin-bottom:10px;"></div>

<iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;<?php if($device != "pc"): ?>showNav=0&amp;<?php endif ?>showCalendars=0&amp;showTz=0&amp;mode=WEEK&amp;height=700&amp;wkst=2&amp;bgcolor=%23FFFFFF&amp;src=30eb24tklutqm4aa0qkasqa4ds%40group.calendar.google.com&amp;color=%232952A3&amp;ctz=Asia%2FTokyo;"
 style=" border-width:0 " width="<?php if($device == "pc"): ?>900<?php else: ?>100%<?php endif ?>" height="700" frameborder="0" scrolling="no"></iframe>

    </div></div>
  </div>
  <!-- /tab2 -->

</div>
<!-- /タブ -->

<!-- end id="page"> --></div>

<!-- footer -->
<footer id="footer">
  <?php include_partial('global/pankuzu', array('current' => $title[$sf_context->getActionName()], 'parent'=>array())) ?>
  <?php include_partial('global/footer', array()) ?>
</footer>

<!-- style -->
<style type="text/css">
#Grid .mix {
  opacity: 0;
  display: none;
}
#Grid2 .mix {
/*  opacity: 0;
  display: none;*/
}
.sort {
  color: grey;
}
.dn {
  display:none;
}
.pd5 {
  padding: 5px;
}
.fwn {
  font-weight:normal;
}
.cw {
  color:white;
}
.vam {
  vertical-align:middle;
}
.grid2_div {
  width:100%; border-top: 1px dashed #666;
}
.grid2_dt {
  line-height:140%; cursor:pointer; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;
}
.grid2_dd {
  font-weight:normal;
}
.grid2_span {
  display:inline-block; width:160px;
}
.grid2_span2 {
  margin-left:10px; display:inline-block; width:60px;
}
.grid2_span3 {
  cursor:pointer; background-image:none; font-weight:normal; color:white;
}
.filter {
  padding: 5px;
}
.filter_popup {
  cursor:pointer;
  font-size:9pt;
  background-image:none;
  white-space: nowrap;
}
.filter:hover {
  color:#59e295;
}
.flag_current {
  /*color:#f8ed9f;*/
}
.flag_future {
  /*color:#fff;*/
}
.flag_past {
  /*color:#c0c0c0;*/
}
.active {
  font-weight:bold;
  color:#59E295
  /*background-image: -ms-radial-gradient(center, circle closest-side, #9BFF82 0%, #FFFFFF 100%);
  background-image: -moz-radial-gradient(center, circle closest-side, #9BFF82 0%, #FFFFFF 100%);
  background-image: -o-radial-gradient(center, circle closest-side, #9BFF82 0%, #FFFFFF 100%);
  background-image: -webkit-gradient(radial, center center, 0, center center, 140, color-stop(0, #9BFF82), color-stop(1, #FFFFFF));
  background-image: -webkit-radial-gradient(center, circle closest-side, #9BFF82 0%, #FFFFFF 100%);
  background-image: radial-gradient(circle closest-side at center, #9BFF82 0%, #FFFFFF 100%);*/
}
#map_canvas label { width: auto; display:inline; }
#map_canvas img { max-width: none; }

.new_icon{
  width:50px;
  height: 12px;
  text-align:center;
  font-size:12px;
  padding:1px 3px;
  margin-right: 3px;
  color:#ffffff;
  background-color:#cc3366;
}
</style>

<!-- script -->
<script type="text/javascript">

var map = null;
var infowindow = new google.maps.InfoWindow();
var gmarkers = [];
var contentString = [];
var sort = [];
var i = 0;
var dir     = 'asc';
var current = 'tab1';
var open_flag = [];
var spot_marker;

$(function(){
	$('.area').hide();
	$('.tab li').removeClass('active');
	$('#tab1_menu').addClass('active');
	$('#tab1').fadeIn();
	$('#tab1').show();

  $(window).bind("load", function() {
  });

  $('.filter').bind("click", function() {
  	$('.filter').removeClass('active');
  	$(this).addClass('active');
  });

//  event_list('active');
	event_list('flag_art',true);
 	$('#filter_active').addClass('active');
});

function event_list2(id, type) {
  $('select.selectbox').not('select#'+id).val('all');
  val1 = $('#'+id).val();
  event_list(type + val1, false);
}

function event_list(type, init) {
  if(init)  $('select.selectbox').val('all');
 	$('.filter').removeClass('active');
	$("#Grid2").html('<div id="Grid2"><span class="loading2"></span></div>');
  $(".loading2").html("<img src='/img/loading.gif' width='12px' style='margin: 20px 20px 0;' />");

  setTimeout(function() {
  	$.ajax({
  		type: "GET",
  	  url: "/top/eventlist?type="+type,
  		dataType: "html",
  	  cache: false,
      error: function(XMLHttpRequest, textStatus, errorThrown) {
      },
  	  success: function(html){
    	  $(".loading2").html("");
  			$("#Grid2").html(html);
  	  }
  	});
  }, 0);
}

function change_filter(id) {
  val1 = $('#'+id).val();
  $('select.selectbox').not('select#'+id).val('all');
}

function close_dlg() {
	$('.modal').css({'display':'none'});
  $('select.selectbox').val('all');
}
function scroll_top() {
	$('html,body').animate({ scrollTop: 0 }, 'normal');
	$('.modal').css({'display':'none'});
}
function spot_null() {
	if(spot_marker)
	  spot_marker.setMap(null);
}
function set_spot() {
  name = $('#select_spot').val();

	$.ajax({
		type: "GET",
	  url: "/top/placedetail?name="+name,
		dataType: "json",
	  cache: false,
    error: function(XMLHttpRequest, textStatus, errorThrown) {
    },
	  success: function(data){
	    console.log(data['latitude']);
	    spot(data['id'], data['latitude'], data['longitude'], data['name'], data['image']);
	  }
	});
}
function spot(id, lat, lng, name, image) {
	if(spot_marker)	spot_marker.setMap(null);

	var spot_latlng = new google.maps.LatLng(lat, lng);
	spot_marker = new google.maps.Marker({position:spot_latlng, map:map});
  //console.log(spot_latlng);

  contentString[id] = "<div style='margin:0px; overflow: hidden;'>";
  contentString[id] += "<img src='"+image+"' width=150px>"
  contentString[id] += "<div style='font-size:11px; color:grey; text-align:left;margin:5px 0px'>"+name+"</div>";
  contentString[id] += "</div>";

  map.setZoom(7);
	infowindow.setContent(contentString[id]);
	infowindow.open(map, spot_marker);
}
function event_detail(id) {
  if ($('#event_detail_'+id).css('display') == 'none') {
//  if(!$.inArray(id, open_flag)){
      open_flag.push(id);
      $("#loading").html("<img src='/img/loading.gif' width='12px' style='margin: 10px 0;' />");

    	$.ajax({
    		type: "GET",
    	  url: "/top/eventdetail?eventId="+id,
    		dataType: "html",
    	  cache: false,
        error: function(XMLHttpRequest, textStatus, errorThrown) {
        },
    	  success: function(html){
      	  $("#loading").html("");
    			$("#event_detail_"+id).html(html);
          $('#event_detail_'+id).slideDown('fast');
    	  }
    	});
//  }
  } else {
    $('#event_detail_'+id).slideUp('fast');
		$("#event_detail_"+id).html('');
  }
}

function create_maker(latlng, label, html, no, id) {
	var marker = new google.maps.Marker({position: latlng, map: map, title: label});

	google.maps.event.addListener(marker, "click", function() {
		infowindow.setContent(html);
		infowindow.open(map, marker);

  	link_detail(id);
    //flipsnap.moveToPoint(no);
    //alert(id);
	});

	gmarkers[id] = marker;
	i++;
	return marker;
}
function map_click(i) {
  map.setZoom(7);
	infowindow.setContent(contentString[i]);
	infowindow.open(map, gmarkers[i]);
}
google.maps.event.addDomListener(window, "load", initialize);

$(function(){
  initialize();
});

function initialize() {
  var center   = new google.maps.LatLng(34.651, 135.582);
  var myOptions = {
      zoom: 6,
      center: center,
      zoomControl: true,
      zoomControlOptions: {
        position: google.maps.ControlPosition.LEFT_CENTER,
        style: google.maps.ZoomControlStyle.LARGE
      },
      streetViewControl:false,
      mapTypeId: google.maps.MapTypeId.TERRAIN,
      zIndex:100
  };
  map  = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	google.maps.event.addListener(map, "click", function() { infowindow.close(); });
}

function set_tab(cur) {
  current = cur;
}

</script>
