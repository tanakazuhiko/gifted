
<?php $description = sfConfig::get('app_meta_description_'.$sf_context->getActionName()); slot('description', $description) ?>
<?php $title = sfConfig::get('app_title_'.$sf_context->getModuleName()); ?>
<?php $tmp   = ($current_name) ? $current_name : $title[$sf_context->getActionName()]; ?>
<?php slot('title', $tmp) ?>
<?php slot('current_name', $current_name) ?>
<?php include_partial('global/header', array('isAuthenticated' => $isAuthenticated, 'place'=>$placeKey)) ?>

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
  <li id="tab3_menu" onclick="set_tab('tab3'); ga('send', 'top', 'link', 'click', 'logo');"><a name="#tab3">logo</a></li>
  <li id="tab2_menu" onclick="set_tab('tab2'); ga('send', 'top', 'link', 'click', 'list');" ><a name="#tab2">list</a></li>
  <li id="tab1_menu" onclick="set_tab('tab1'); ga('send', 'top', 'link', 'click', 'info');"><a name="#tab1">info</a></li>
  </ul>
</div>
<!-- /タブメニュー -->

<!-- タブ -->
<div class="tabcontent">

  <!-- tab3:LOGO -->
  <div class="area" id="tab3" style="text-align:center">

  <div style="font-size:12px;color:grey;line-height:150%;">
    <span class="filter active" data-filter="all" style="cursor:pointer">全て</span>(<?php echo $count_array['total'] ?>件)
    <span class="filter" data-filter="flag_care" style="cursor:pointer">生活介護</span>(<?php echo $count_array['category']['flag_care'] ?>件)
    <span class="filter" data-filter="flag_work" style="cursor:pointer">就労支援</span>(<?php echo $count_array['category']['flag_work'] ?>件)
    <span class="filter" data-filter="flag_school" style="cursor:pointer">学校</span>(<?php echo $count_array['category']['flag_school'] ?>件)
    <span class="filter" data-filter="flag_publication" style="cursor:pointer">出版/放送</span>(<?php echo $count_array['category']['flag_publication'] ?>件)
    <span class="filter" data-filter="flag_seeing" style="cursor:pointer">視覚</span>(<?php echo $count_array['category']['flag_seeing'] ?>件)
    <span class="filter" data-filter="flag_hearing" style="cursor:pointer">聴覚</span>(<?php echo $count_array['category']['flag_hearing'] ?>件)
    <?php if($device != "pc"): ?><!--br /--><?php endif ?>
    <br />
    <span class="filter" data-filter="flag_art" style="cursor:pointer">アート</span>(<?php echo $count_array['category']['flag_art'] ?>件)
    <span class="filter" data-filter="flag_museum" style="cursor:pointer">美術館</span>(<?php echo $count_array['category']['flag_museum'] ?>件)
    <span class="filter" data-filter="flag_dance" style="cursor:pointer">ダンス</span>(<?php echo $count_array['category']['flag_dance'] ?>件)
    <span class="filter" data-filter="flag_product" style="cursor:pointer">プロダクト</span>(<?php echo $count_array['category']['flag_product'] ?>件)
    <span class="filter" data-filter="flag_food" style="cursor:pointer">フード</span>(<?php echo $count_array['category']['flag_food'] ?>件)
    <span class="filter" data-filter="flag_other" style="cursor:pointer">その他</span>(<?php echo $count_array['category']['flag_other'] ?>件)

    <?php if($device == "pc"): ?>
    　都道府県：
    <select style="width:150px; display:inline;" onchange="change_filter(this.id)" id="select_area1" class="selectbox">
      <option value="all">全て</option>
      <?php for($i = 1; $i <= 47; $i++): ?>
        <option value="<?php echo $pref_id_array[$i] ?>" <?php if(!isset($count_array['pref'][$i])): ?>disabled style="background-color:whitesmoke;"<?php endif ?>>
        <?php echo $pref_id_array[$i] ?> <?php if(isset($count_array['pref'][$i])): ?>(<?php echo $count_array['pref'][$i] ?>件)<?php endif ?>
        </option>
      <?php endfor ?>
    </select>　
    <?php endif ?>

    <?php if($device != "pc"): ?><br /><?php else: ?><br /><?php endif ?>

    <span class="sort active" data-sort="data-area" data-order="desc" style="cursor:pointer">地域順</span>
    <?php if($device == "pc"): ?>
    <span class="sort" data-sort="data-area" data-order="desc" style="cursor:pointer">▲</span>
    <span class="sort" data-sort="data-area" data-order="asc" style="cursor:pointer">▼</span>
    <?php endif ?>　
    <span class="sort" data-sort="data-start" data-order="desc" style="cursor:pointer" >設立年順</span>
    <?php if($device == "pc"): ?>
    <span class="sort" data-sort="data-start" data-order="desc" style="cursor:pointer">▲</span>
    <span class="sort" data-sort="data-start" data-order="asc" style="cursor:pointer">▼</span>
    <?php endif ?>　
    <span class="sort" data-sort="random"  style="cursor:pointer">ランダム</span>
  </div>
  
  <div id="Grid">
    <?php for($i=0; $i<count($link); $i++):  ?>
      <!--div style="margin:15px 25px; float:left"-->
      <div style="margin:15px 25px;" 
        class="mix <?php 
          if($link[$i]['flag_care']) echo 'flag_care '; 
          if($link[$i]['flag_work']) echo 'flag_work '; 
          if($link[$i]['flag_art']) echo 'flag_art ';
          if($link[$i]['flag_museum']) echo 'flag_museum ';
          if($link[$i]['flag_product']) echo 'flag_product ';
          if($link[$i]['flag_dance']) echo 'flag_dance ';
          if($link[$i]['flag_school']) echo 'flag_school '; 
          if($link[$i]['flag_publication']) echo 'flag_publication '; 
          if($link[$i]['flag_food']) echo 'flag_food ';
          if($link[$i]['flag_other']) echo 'flag_other '; 
          if($link[$i]['flag_seeing']) echo 'flag_seeing '; 
          if($link[$i]['flag_hearing']) echo 'flag_hearing '; 
          echo $pref_id_array[$link[$i]['prefectureid']].' ';
        ?>" 
        data-name="<?php echo $link[$i]['name'] ?>" 
        data-area="<?php echo $link[$i]['prefectureid'] ?>"
        data-start="<?php echo $link[$i]['start_from'] ?>"
      >
      <a onmouseover="javascript:map_click(<?php echo $link[$i]['id'] ?>)"  href="<?php echo $link[$i]['url'] ?>" target="_blank">
      <img width="200px" class="place_image2" src="<?php echo $link[$i]['logo'] ?>"></a>
      </div>
    <?php endfor; ?>
  </div></div>
  <!-- /tab3 -->

  <!-- tab2:LIST -->
  <div class="area" id="tab2">
  
  <div style="font-size:12px;color:grey;text-align:center;line-height:150%;">
    <span class="filter active" data-filter="all" style="cursor:pointer">全て</span>(<?php echo $count_array['total'] ?>件)
    <span class="filter" data-filter="flag_care" style="cursor:pointer">生活介護</span>(<?php echo $count_array['category']['flag_care'] ?>件)
    <span class="filter" data-filter="flag_work" style="cursor:pointer">就労支援</span>(<?php echo $count_array['category']['flag_work'] ?>件)
    <span class="filter" data-filter="flag_school" style="cursor:pointer">学校</span>(<?php echo $count_array['category']['flag_school'] ?>件)
    <span class="filter" data-filter="flag_publication" style="cursor:pointer">出版/放送</span>(<?php echo $count_array['category']['flag_publication'] ?>件)
    <span class="filter" data-filter="flag_seeing" style="cursor:pointer">視覚</span>(<?php echo $count_array['category']['flag_seeing'] ?>件)
    <span class="filter" data-filter="flag_hearing" style="cursor:pointer">聴覚</span>(<?php echo $count_array['category']['flag_hearing'] ?>件)
    <?php if($device != "pc"): ?><!--br /--><?php endif ?>
    <br />
    <span class="filter" data-filter="flag_art" style="cursor:pointer">アート</span>(<?php echo $count_array['category']['flag_art'] ?>件)
    <span class="filter" data-filter="flag_museum" style="cursor:pointer">美術館</span>(<?php echo $count_array['category']['flag_museum'] ?>件)
    <span class="filter" data-filter="flag_dance" style="cursor:pointer">ダンス</span>(<?php echo $count_array['category']['flag_dance'] ?>件)
    <span class="filter" data-filter="flag_product" style="cursor:pointer">プロダクト</span>(<?php echo $count_array['category']['flag_product'] ?>件)
    <span class="filter" data-filter="flag_food" style="cursor:pointer">フード</span>(<?php echo $count_array['category']['flag_food'] ?>件)
    <span class="filter" data-filter="flag_other" style="cursor:pointer">その他</span>(<?php echo $count_array['category']['flag_other'] ?>件)

    <?php if($device == "pc"): ?>
    　都道府県別：
    <select style="width:150px; display:inline;" onchange="change_filter(this.id)" id="select_area2" class="selectbox">
      <option value="all">全て</option>
      <?php for($i = 1; $i <= 47; $i++): ?>
        <option value="<?php echo $pref_id_array[$i] ?>" <?php if(!isset($count_array['pref'][$i])): ?>disabled style="background-color:whitesmoke;"<?php endif ?>>
        <?php echo $pref_id_array[$i] ?> <?php if(isset($count_array['pref'][$i])): ?>(<?php echo $count_array['pref'][$i] ?>件)<?php endif ?>
        </option>
      <?php endfor ?>
    </select>　
    <?php endif ?>

    <?php if($device != "pc"): ?>　|　
      <!--
      <span class="sort2 active" data-sort="data-name" data-order="desc" style="cursor:pointer">名前順</span>
      <span class="sort2" data-sort="data-name" data-order="desc" style="cursor:pointer">↓</span>
      <span class="sort2" data-sort="data-name" data-order="asc" style="cursor:pointer">↑</span>
      -->
      <span class="sort2 active" data-sort="data-area" data-order="desc" style="cursor:pointer">地域順</span>
      <?php if($device == "pc"): ?>
      <span class="sort2" data-sort="data-area" data-order="desc" style="cursor:pointer">▲</span>
      <span class="sort2" data-sort="data-area" data-order="asc" style="cursor:pointer">▼</span>
      <?php endif ?>　
      <span class="sort2" data-sort="data-start" data-order="desc" style="cursor:pointer" >設立年順</span>
      <?php if($device == "pc"): ?>
      <span class="sort2" data-sort="data-start" data-order="desc" style="cursor:pointer">▲</span>
      <span class="sort2" data-sort="data-start" data-order="asc" style="cursor:pointer">▼</span>
      <?php endif ?>　
      <span class="sort2" data-sort="random"  style="cursor:pointer">ランダム</span>
    <?php endif ?>
  </div>
  
    <div class="ingrid in-halves">
      <div class="unit" style="width:100%;">
        <div style="margin-top:10px"></div>
        <div class="mainbox01"><div class="com-box">
        <dl>
        <?php if($device == "pc"): ?>
          <dt nowrap style="<?php if($device == "pc"): ?>width:300px;<?php else: ?><?php endif ?> font-size:8pt; font-weight:normal;color:#59E295;">
          名前&nbsp;
          <?php if($device == "pc"): ?>
          <span class="sort2" data-sort="data-name" data-order="desc" style="cursor:pointer">▲</span>
          <span class="sort2" data-sort="data-name" data-order="asc" style="cursor:pointer">▼</span>
          <?php endif ?>
          </dt>
          <dd style="font-size:8pt; font-weight:normal;color:#59E295;">
          <span>
          設立&nbsp;
          <?php if($device == "pc"): ?>
          <span class="sort2" data-sort="data-start" data-order="desc" style="cursor:pointer">▲</span>
          <span class="sort2" data-sort="data-start" data-order="asc" style="cursor:pointer">▼</span>
          <?php endif ?>
          </span>
          <span style="margin-left:28px;">
          住所&nbsp;
          <?php if($device == "pc"): ?>
          <span class="sort2" data-sort="data-area" data-order="desc" style="cursor:pointer">▲</span>
          <span class="sort2" data-sort="data-area" data-order="asc" style="cursor:pointer">▼</span>
          <?php endif ?>
          </span>
          </dd>
        <?php else: ?>
        <?php endif ?>

        <div id="Grid2">
          <?php for($i=0; $i<count($link); $i++):  ?>
            <div style="width:100%; border-bottom: 1px dashed #666;"
              class="mix <?php 
                if($link[$i]['flag_care']) echo 'flag_care '; 
                if($link[$i]['flag_work']) echo 'flag_work '; 
                if($link[$i]['flag_art']) echo 'flag_art ';
                if($link[$i]['flag_museum']) echo 'flag_museum ';
                if($link[$i]['flag_product']) echo 'flag_product ';
                if($link[$i]['flag_dance']) echo 'flag_dance ';
                if($link[$i]['flag_school']) echo 'flag_school '; 
                if($link[$i]['flag_publication']) echo 'flag_publication '; 
                if($link[$i]['flag_food']) echo 'flag_food ';
                if($link[$i]['flag_other']) echo 'flag_other '; 
                if($link[$i]['flag_seeing']) echo 'flag_seeing '; 
                if($link[$i]['flag_hearing']) echo 'flag_hearing '; 
                echo $pref_id_array[$link[$i]['prefectureid']].' ';
              ?>" 
              data-name="<?php echo $link[$i]['name'] ?>" 
              data-area="<?php echo $link[$i]['prefectureid'] ?>"
              data-start="<?php echo $link[$i]['start_from'] ?>"
            >          
              <dt nowrap style="<?php if($device == "pc"): ?>width:300px;<?php else: ?>width:100%;<?php endif ?> font-size:9pt; font-weight:normal">
              <a style="cursor:pointer"  target="_blank" class="preview"
                <?php if($device == "pc"): ?> href="<?php echo $link[$i]['image'] ?>" onclick="window.open('<?php echo $link[$i]['url'] ?>'); return false" onmouseover="javascript:map_click(<?php echo $link[$i]['id'] ?>)"
                <?php else: ?> href="<?php echo $link[$i]['url'] ?>" onmouseover="javascript:map_click(<?php echo $link[$i]['id'] ?>); /*link_detail(<?php echo $link[$i]['id'] ?>)*/"<?php endif ?>
              ><?php echo $link[$i]['name'] ?></a></dt>
              <?php if($device == "pc"): ?>
                <dd style="font-size:9pt; font-weight:normal">
                <span style="vertical-align:top"><?php echo substr($link[$i]['start_from'],0,4) ?>年</span>
                <span style="margin-left:10px; width:500px;display: inline-block;"><?php echo substr($link[$i]['address'], 12) ?></span>
                </dd>
              <?php else: ?>
                <dd style="font-size:9pt; font-weight:normal; width:0px;"></dd>
              <?php endif ?>
            </div>
          <?php endfor; ?>
        </div>
        
        </dl>
        </div></div>
      </div>
    </div>
  </div>
  <!-- /tab2 -->
  
  <!-- tab1:INFO -->
  <div class="area" id="tab1">

    <div style="font-size:11px;color:grey;">
      <table style="vertical-align:middle; width:97%;"><tr><td style="width:50px">
      <a onclick="move_place('prev')" style="cursor:default; opacity:0.2" id="prev_btn"><img src="/img/prev.png" style="width:50px"></a>
      </td><td style="text-align:center; vertical-align:bottom;">
      <select id="place_select" style="display:inline; width:<?php if($device == "pc"): ?>95%;<?php else: ?>90%;<?php endif ?>; margin-top:-10px;" 
        onchange="check_place()">
        <?php foreach($link as $key => $value):?>
        <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
        <?php endforeach ?>
      </select>
      </td><td style="width:50px">
      <a onclick="move_place('next')" style="cursor:pointer" id="next_btn"><img src="/img/next.png" style="width:50px"></a>
      </td></tr></table>
    </div>

    <div class="ingrid in-thirds"><div class="unit" style="width:100%">
  
      <div class="d_viewport"><div class="d_flipsnap_link">
        
        <div id="loading2" style="width:100%; text-align:center;"></div>
        <div id="link_detail" class="link_detail"></div>
        
      </div></div>
    </div></div>
  </div>
  <!-- /tab1 -->

</div>
<!-- /タブ -->

<!-- end id="page"> --></div>

<!-- footer -->
<footer id="footer">
  <?php include_partial('global/pankuzu', array('current' => $title[$sf_context->getActionName()], 'parent'=>array())) ?>
  <?php include_partial('global/footer', array()) ?>
</footer>

<style type="text/css">
.sort2 {
  color: grey;
}

.flipsnap_link {
  width: <?php echo (310 * count($link)) ?>px;
}
.item_link {
  width: 95%; 
  margin: 0 5px;
  float: left;
}
.viewport_link {
/*  width: 600px;*/
  overflow: hidden;
  margin: 0 auto;
  -webkit-transform: translateZ(0); /* Optional: When heavy at iOS6+ */
}
.item_link2 {
  width: 200px;
  margin: 0 5px;
  float: left;
}
.filter {
  padding: 5px;
}
.filter:hover {
  color:#59e295;
}
.active {
  font-weight:bold;
  color:#59E295
}
#Grid .mix{
  opacity: 0;
  display: none;
}
#Grid2 .mix{
  opacity: 0;
  display: none;
}
#map_canvas label { width: auto; display:inline; }
#map_canvas img { max-width: none; }
</style>

<!-- script -->
<script type="text/javascript">

var map = null;
var infowindow = new google.maps.InfoWindow();
var gmarkers = [];
var contentString = [];
var sort = [];
var i = 0;

$(function(){
  $('#Grid').mixitup();
  $('#Grid2').mixitup({
    targetSelector: '.mix',
    filterSelector: '.filter',
    sortSelector: '.sort2',
  });

  $('.filter').click(function() {
    $('.selectbox').val('all');
  });

  <?php if(!$current): ?>
  	$.ajax({
  		type: "GET",
  	  url: "/top/linkdetail?placeId="+<?php echo $link[0]['id'] ?>,
  		dataType: "html",
  	  cache: false,
      error: function(XMLHttpRequest, textStatus, errorThrown) {
      },
  	  success: function(html){
    	  $("#loading2").html("");
  			$("div.link_detail").html(html);
  			$('html,body').animate({ scrollTop: 0 }, 'normal');
  	  }
  	});
    //map_click(<?php echo $link[0]['id'] ?>);
  <?php endif ?>
});
function change_filter(id) {
  val1 = $('#'+id).val();
  $('#Grid').mixitup('filter', val1);
  $('#Grid2').mixitup('filter', val1);
  if(id=='select_area1')  $('#select_area2').val(val1);
  else                    $('#select_area1').val(val1);
}

function set_btn(){
  var index = $("#place_select").prop("selectedIndex");
  var len   = $('#place_select').children().length;
  //console.log(index+" <> "+ len);
  
  if(index <= 0){
    $('#prev_btn').css({ "cursor": "default", "opacity": "0.2" });
  }else{
    $('#prev_btn').css({ "cursor": "pointer", "opacity": "1" });
  }
  if(index >= len-1){
    $('#next_btn').css({ "cursor": "default", "opacity": "0.2" });
    index = len;
  }else{
    $('#next_btn').css({ "cursor": "pointer", "opacity": "1" });
  }
}
function move_place(type){
  var select_id = $('#place_select').val();
  var index = $("#place_select").prop("selectedIndex");
  var len   = $('#place_select').children().length;
  
  if(type=='prev')       index--;
  else if(type=='next')  index++;
  //console.log(index+" <> "+ len);

  if(index < 0 || index > len-1) return false;
  
  $("#place_select").prop("selectedIndex", index);
  check_place();
}
function check_place(){
  select_id = $('#place_select').val();
  link_detail(select_id);
  map_click(select_id);
  set_btn();
}
function link_detail(id) {
	$('.area').hide();
	$('.tab li').removeClass('active');
	$('#tab1_menu').addClass('active');
	$('#tab1').fadeIn();
	$('#tab1').show();
	
	$('#place_select').val(id);
  
  cur_name = $('#place_select option:selected').text();
  //console.log(cur_name);

	$("div.link_detail").html("");
  $("#loading2").html("<img src='/img/loading.gif' width='24px' style='margin: 100px 0;' />");
  
	$.ajax({
		type: "GET",
	  url: "/top/linkdetail?placeId="+id,
		dataType: "html",
	  cache: false,
    error: function(XMLHttpRequest, textStatus, errorThrown) {
    },
	  success: function(html){
  	  $("#loading2").html("");
			$("div.link_detail").html(html);
			$('html,body').animate({ scrollTop: 0 }, 'normal');
			$("title").text("gifted; "+ cur_name);

      detail_memo = $('#detail_memo').text();
      set_meta(cur_name, detail_memo);
	  }
	});
  //$("div.link_detail").load("/top/linkdetail?placeId="+id);
}
function set_meta(cur_name, detail_memo) {
  var cutFigure = '120'; //'80';
  var afterTxt  = ' …';
  var textLength = detail_memo.length;
  var textTrim   = detail_memo.substr(0,(cutFigure))
  if(cutFigure < textLength) {
    detail_memo = textTrim + afterTxt;
  } else if(cutFigure >= textLength) {
    detail_memo = textTrim;
  }
  img_src = $('#map_img').attr('src');
  tmp = img_src.slice(0,4);
  if(tmp == "/img") img_src = "http://gftd.me" + img_src;
  
  $('meta[name=keywords]').attr('content', cur_name + ',' + '<?php echo sfConfig::get('app_meta_keywords') ?>' );
  $('meta[name=description]').attr('content', detail_memo);
  $("meta[property='og\\:title']").attr("content", "gifted; " + cur_name);
  $("meta[property='og\\:image']").attr("content", img_src);
  $("meta[property='og\\:description']").attr("content",detail_memo);
}

<?php if($type): ?>
$(document).ready(function() {
	$('.area').hide();
	$('.tab li').removeClass('active');
	$('#tab3_menu').addClass('active');
	$('#tab3').fadeIn();
	$('#tab3').show();
});
<?php endif ?>

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
      //panControl: true,
      //scaleControl: true,
      //scrollwheel:false,
      //disableDefaultUI: true,
      zIndex:100
  };
  map  = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	google.maps.event.addListener(map, "click", function() { infowindow.close(); });
  
  <?php for($i=0; $i<count($link); $i++): if(!$link[$i]['latitude']) continue; ?>
    var Latlng = new google.maps.LatLng(<?php echo $link[$i]['latitude'] ?>, <?php echo $link[$i]['longitude'] ?>);
    contentString[<?php echo $link[$i]['id'] ?>] = "<div style='margin:0px; overflow: hidden;'>";
    contentString[<?php echo $link[$i]['id'] ?>] += "<img id='map_img' src='<?php echo $link[$i]['image'] ?>' width=150px>"
    contentString[<?php echo $link[$i]['id'] ?>] += "<div style='font-size:11px; color:grey; text-align:left;margin:5px 0px'><?php echo $link[$i]['name'] ?></div>";
    contentString[<?php echo $link[$i]['id'] ?>] += "</div>";
  	var marker = create_maker(Latlng, "<?php echo $link[$i]['name'] ?>", contentString["<?php echo $link[$i]['id'] ?>"], "<?php echo $i ?>", "<?php echo $link[$i]['id'] ?>");
  <?php endfor; ?>
  
  <?php if($current): ?>
    // 施設名の指定があれば初期表示
    map_click(<?php echo $current ?>);
  	//infowindow.open(map, gmarkers[<?php echo $current ?>]);
    //flipsnap.moveToPoint(<?php echo $current ?>);
    //gmarkers[<?php echo $current ?>].trigger("click");
  	//google.maps.event.trigger(gmarkers[<?php echo $current ?>], "click");
  	link_detail(<?php echo $current ?>);
  <?php endif ?>
}

$(function() {
	$('.place_image')
	.hover(
		function(){	$(this).stop().animate({'opacity':'0.85'}, 200);},
		function(){ $(this).stop().animate({'opacity':'1' }, 200);}
	);
	$('.place_image2')
	.hover(
		function(){	$(this).stop().animate({'opacity':'0.7'}, 200);},
		function(){	$(this).stop().animate({'opacity':'1'}, 200);}
	);
});

var dir     = 'asc';
var current = 'tab1';
var sortkey = 'prefectureId';
var flipsnap;

<?php if($device == "pc"): ?>
var percent = 0.7;
<?php else: ?>
var percent = 0.9;
<?php endif ?>

$(document).ready(function() {

  var w = $(window).width();
  new_w = w * percent;
/*
  $('#sort_prefectureId').css({color: '#59E295'});
  flipsnap = Flipsnap('.flipsnap_link', {
    distance: (new_w + 10),
  });
*/  
  $('.item_link').css({ width: new_w });
  $('.flipsnap_link').css({ width: (new_w * <?php echo (count($link)+1)?>) });
  $('.viewport_link').css({ width: (new_w * 0.9) });

  // 施設名の指定があれば初期表示
//  flipsnap.moveToPoint(<?php echo $current_no ?>);
  set_btn();  
});

function set_tab(cur) {
  current = cur;
}

</script>
