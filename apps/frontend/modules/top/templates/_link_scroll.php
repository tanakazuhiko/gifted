
  <!-- tab1 -->
  <div class="area" id="tab1">

    <span style="font-size:11px;color:grey">
    　※地図上のスポットをクリックすると、詳細が表示されます。
    </span>

    <div class="ingrid in-thirds"><div class="unit">
  
      <div class="viewport"><div class="flipsnap_link">
  
      <?php for($i=0; $i<count($link); $i++):  ?>
        <div class="item_link">
          <div style="margin-top:10px"></div>
          <div class="mainbox01"><div class="com-box2">
          <dl>
          <dt></dt>
          <dd>
          <table><tr><td>
          <a onmouseover="javascript:map_click(<?php echo $link[$i]['id'] ?>)" style="cursor:pointer;color:#59E295; font-size:12pt">
          <?php echo $link[$i]['name'] ?></a> <?php if($link[$i]['delete_flag']){ echo "（未公開）"; } ?>
          </td></tr></table>
          </dd>
          <dt></dt><dd><table><tr><td><span style="font-size:8pt"><?php echo nl2br(htmlspecialchars_decode($link[$i]['copy'])) ?></span></td></tr></table></dd>
          <?php if($link[$i]['start_from']): ?><dt></dt><dd><span style="font-size:9pt"><?php echo $link[$i]['start_from'] ?> 創立</span></dd><?php endif ?>
          <?php if($link[$i]['address']): ?>
          <dt></dt><dd><table><tr><td><?php echo nl2br(substr($link[$i]['address'], 12)) ?></td></tr></table></dd>
          <?php endif ?>
          <?php if($link[$i]['tel']): ?>
          <!--
          <dt>TEL</dt><dd><a href="tel:<?php echo $link[$i]['tel'] ?>"><?php echo $link[$i]['tel'] ?></a>
            <?php if($link[$i]['fax']): ?>
            <span style="margin-left:180px">FAX</span><span style="margin-left:30px"><?php echo $link[$i]['fax'] ?></span>
            <?php endif ?>
          </dd>
          -->
          <?php endif ?>
          <?php if($link[$i]['mail']): ?>
          <!--dt>メール</dt><dd><a href="mailto:<?php echo $link[$i]['mail'] ?>"><?php echo $link[$i]['mail'] ?></a></dd-->
          <?php endif ?>
          <dt></dt><dd><table cellspacing=0 cellpadding=0><tr><td><a href="<?php echo $link[$i]['url'] ?>" target="_blank"><?php echo $link[$i]['url'] ?></a></td></tr></table></dd>
          
          <?php if($link[$i]['facebook']): ?>
          <dt></dt><dd style="font-size:8pt"><table><tr><td>fb: <a href="https://www.facebook.com/<?php echo $link[$i]['facebook'] ?>" target="_blank">https://www.facebook.com/<?php echo $link[$i]['facebook'] ?></a></td></tr></table></dd>
          <?php endif ?>
          <?php if($link[$i]['twitter']): ?>
          <dt></dt><dd style="font-size:8pt"><table><tr><td>tw: <a href="https://twitter.com/<?php echo $link[$i]['twitter'] ?>" target="_blank">https://twitter.com/<?php echo $link[$i]['twitter'] ?></a></td></tr></table></dd>
          <?php endif ?>
          
          <dt></dt>
          <dd>
            <table style="width:<?php if($device == "pc"): ?>95%<?php else: ?>90%<?php endif ?>">
            <tr><td style="font-size:9pt"><?php echo nl2br(htmlspecialchars_decode($link[$i]['memo'])) ?>
            <?php if($link[$i]['logo']): ?>
              <br><br><div style="width:100%; text-align:center">
              <a href="<?php echo $link[$i]['url'] ?>" target="_blank">
              <img width="200px" class="place_image" src="<?php echo $link[$i]['logo'] ?>"></a></div>
            <?php endif ?>
            </td></tr></table>
          </dd>
          
        <?php if($device == "pc"): ?>
        
          <?php if(isset($image[$link[$i]['id']]) && count($image[$link[$i]['id']])): ?>
          <div style="color:#59E295;font-size:10pt; margin:10px 0px 0px 20px; ">images</div>
          <dt></dt>
          <dd style="margin-top:0px">
          <style type="text/css">
          .flipsnap_link_<?php echo $link[$i]['id'] ?> {
            width: <?php echo (210 * count($image[$link[$i]['id']])) ?>px;
          }
          </style>
          <script type="text/javascript">
          $(document).ready(function() {
            Flipsnap('.flipsnap_link_<?php echo $link[$i]["id"] ?>', {
              distance: 210,
            });	
          });
          </script>
            <div class="viewport_link" style="margin-top:0px">
            <div class="flipsnap_link_<?php echo $link[$i]['id'] ?>">
              <?php for($n=0; $n<count($image[$link[$i]['id']]); $n++): ?>
                <div class="item_link2">
                <?php if($image[$link[$i]['id']][$n]['url']): ?>
                <a href="<?php echo $image[$link[$i]['id']][$n]['url'] ?>" target="_blank">
                <img src="<?php echo $image[$link[$i]['id']][$n]['src'] ?>" width="200px" class="tooltip place_image" 
                  title="image; <?php echo $image[$link[$i]['id']][$n]['url'] ?>"></a>
                <?php else: ?>
                <img src="<?php echo $image[$link[$i]['id']][$n]['src'] ?>" width="200px" class="tooltip place_image" 
                  title="copyright <?php echo $link[$i]['name'] ?>">
                <?php endif ?>
                </div>
              <?php endfor; ?>
            </div></div>      
          </dd>
          <?php endif ?>

        <?php endif ?>

        <?php if($device == "pc"): ?>
          
          <?php if(isset($event[$link[$i]['id']]) && count($event[$link[$i]['id']])): ?>
          <div style="color:#59E295;font-size:10pt; margin:10px 0px 0px 20px; ">news</div>
          <dt></dt>
          <dd>
            <table ><tr><td style="font-size:9pt;">
            <?php for($n=0; $n<count($event[$link[$i]['id']]); $n++):  if($n>=5) break;?>
              <span id="event_<?php echo $event[$link[$i]['id']][$n]['id'] ?>" style="margin-bottom:10px">
              <span style="font-size:9pt; margin-bottom:10px">
                <?php echo ($event[$link[$i]['id']][$n]['year']) ? $event[$link[$i]['id']][$n]['year'].'　　&nbsp;&nbsp;' : date('Y.m.d',strtotime($event[$link[$i]['id']][$n]['startdate'])) ?></span>&nbsp;&nbsp;
              <?php if($device != "pc"): ?><br /><?php endif ?>
              <a id="news_title_<?php echo $event[$link[$i]['id']][$n]['id'] ?>" name="<?php echo $event[$link[$i]['id']][$n]['id'] ?>"
                onclick="news_open(<?php echo $event[$link[$i]['id']][$n]['id'] ?>); return false" 
                <?php if($device == "pc"): ?>
                  onMouseOver="imagePreview()" 
                  onMouseOut="color_news(<?php echo $event[$link[$i]['id']][$n]['id'] ?>)"
                  <?php if($event[$link[$i]['id']][$n]['image']): ?>
                    href="<?php echo $event[$link[$i]['id']][$n]['image'] ?>" title="<?php echo $event[$link[$i]['id']][$n]['image'] ?>" class="preview"
                  <?php endif ?>
                <?php endif ?>
                style="cursor:pointer;<?php if(!$event[$link[$i]['id']][$n]['contents']&&!$event[$link[$i]['id']][$n]['image']): ?>color:white<?php endif ?>">
                <?php echo $event[$link[$i]['id']][$n]['name'] ?> <?php echo ($place=$event[$link[$i]['id']][$n]['place']) ? '（'.$place.'）' : ''; ?>
              </a>
              <?php if($event[$link[$i]['id']][$n]['contents']||$event[$link[$i]['id']][$n]['image']): ?>  
              <div id="news_detail_<?php echo $event[$link[$i]['id']][$n]['id'] ?>" 
                style="margin-bottom:20px; font-size:9pt; font-weight:normal;
                display:none;" >
                <table cellspacing=0 cellpadding=0><tr><td width="<?php if($device == "pc"): ?>500px<?php else: ?>100%<?php endif ?>" style="vertical-align:top; font-size:8pt">
                  <br /><?php echo nl2br(html_entity_decode($event[$link[$i]['id']][$n]['contents'])) ?><br /><br />
                  <?php if($event[$link[$i]['id']][$n]['url']): ?>url: <a style="padding:0px;font-size:10px;display:inline;" 
                    href="<?php echo $event[$link[$i]['id']][$n]['url']?>" target="_blank"><?php echo $event[$link[$i]['id']][$n]['url']?></a><br><?php endif ?>
                  <?php if($event[$link[$i]['id']][$n]['image']): ?><!-- image: <a style="padding:0px;font-size:10px;display:inline;" 
                    href="<?php echo $event[$link[$i]['id']][$n]['image']?>" target="_blank"><?php echo $event[$link[$i]['id']][$n]['image']?></a--><?php endif ?>
                </td><td style="padding-left:40px;padding-bottom:20px">
                  <?php if($event[$link[$i]['id']][$n]['image']):?>
                  <a <?php if($event[$link[$i]['id']][$n]['url']):?>href="<?php echo $event[$link[$i]['id']][$n]['url'] ?>"<?php endif ?> 
                    target="_blank">
                  <img width="200px" src="<?php echo $event[$link[$i]['id']][$n]['image'] ?>" class="tooltip smp-hdn" title="image; <?php echo $event[$link[$i]['id']][$n]['image'] ?>"></a>
                  <?php endif ?>
                </td></tr></table>
              </div>
              <?php endif ?>
              </span><br />
            <?php endfor; ?>
            </td></tr></table>
          </dd>
          <?php endif ?>

        <?php endif ?>
          
          </dl>
          </div></div>
        </div>
      <?php endfor; ?>
      </div></div>
    </div></div>
  </div>
  <!-- /tab1 -->

  <!-- tab2 -->
  <div class="area" id="tab2">
  
  <div style="font-size:12px;color:grey;text-align:center">
    <span class="filter" data-filter="flag_care" style="cursor:pointer">生活介護</span>　
    <span class="filter" data-filter="flag_work" style="cursor:pointer">就労支援</span>　
    <span class="filter" data-filter="flag_school" style="cursor:pointer">学校</span>　
    <span class="filter" data-filter="flag_art" style="cursor:pointer" id="flag_art2">アート</span>　
    <span class="filter" data-filter="flag_food" style="cursor:pointer">フード</span>　
    <span class="filter" data-filter="flag_publication" style="cursor:pointer">出版</span>　
    <span class="filter" data-filter="flag_other" style="cursor:pointer">その他</span>　
    <span class="filter" data-filter="all" style="cursor:pointer">全て</span>　|　
    <?php if($device != "pc"): ?><br /><?php endif ?>
    <span class="sort2" data-sort="data-name" data-order="desc" style="cursor:pointer">名称順</span>　
    <span class="sort2" data-sort="data-area" data-order="desc" style="cursor:pointer">地域順</span>　
    <span class="sort2" data-sort="data-start" data-order="desc" style="cursor:pointer" >創立年順</span>　
    <span class="sort2" data-sort="random"  style="cursor:pointer">ランダム</span>　
  </div>
  
    <div class="ingrid in-halves">
      <div class="unit" style="width:100%;">
        <div style="margin-top:10px"></div>
        <div class="mainbox01"><div class="com-box">
        <dl>
        <?php if($device == "pc"): ?>
          <dt nowrap style="<?php if($device == "pc"): ?>width:300px;<?php else: ?><?php endif ?> font-size:8pt; font-weight:normal;color:#59E295;">&nbsp;名前</dt>
          <dd style="font-size:8pt; font-weight:normal;color:#59E295;">
          <span>創立</span>
          <span style="margin-left:28px;">住所</span>
          </dd>
        <?php else: ?>
        <?php endif ?>

        <div id="Grid2">
          <?php for($i=0; $i<count($link); $i++):  ?>
            <div style="width:900px; border-bottom: 1px dashed #666;"
              class="mix <?php 
                if($link[$i]['flag_care']) echo 'flag_care '; 
                if($link[$i]['flag_work']) echo 'flag_work '; 
                if($link[$i]['flag_art']) echo 'flag_art ';
                if($link[$i]['flag_school']) echo 'flag_school '; 
                if($link[$i]['flag_publication']) echo 'flag_publication '; 
                if($link[$i]['flag_food']) echo 'flag_food ';
                if($link[$i]['flag_other']) echo 'flag_other '; 
              ?>" 
              data-name="<?php echo $link[$i]['name'] ?>" 
              data-area="<?php echo $link[$i]['prefectureid'] ?>"
              data-start="<?php echo $link[$i]['start_from'] ?>"
            >          
              <dt nowrap style="<?php if($device == "pc"): ?>width:300px;<?php else: ?>width:220px;<?php endif ?> font-size:9pt; font-weight:normal">
              <a  style="cursor:pointer" onmouseover="javascript:map_click(<?php echo $link[$i]['id'] ?>)"><?php echo $link[$i]['name'] ?></a></dt>
              <?php if($device == "pc"): ?>
                <dd style="font-size:9pt; font-weight:normal">
                <span style="vertical-align:top"><?php echo substr($link[$i]['start_from'],0,4) ?>年</span>
                <span style="margin-left:10px; width:500px;display: inline-block;"><?php echo substr($link[$i]['address'], 12) ?></span>
                </dd>
              <?php else: ?>
                <dd style="font-size:9pt; font-weight:normal">　</dd>
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
  
  <!-- tab3 -->
  <div class="area" id="tab3" style="text-align:center">

  <div style="font-size:12px;color:grey;">
    <span class="filter" data-filter="flag_care" style="cursor:pointer">生活介護</span>　
    <span class="filter" data-filter="flag_work" style="cursor:pointer">就労支援</span>　
    <span class="filter" data-filter="flag_school" style="cursor:pointer">学校</span>　
    <span class="filter" data-filter="flag_art" style="cursor:pointer" id="flag_art2">アート</span>　
    <span class="filter" data-filter="flag_food" style="cursor:pointer">フード</span>　
    <span class="filter" data-filter="flag_publication" style="cursor:pointer">出版</span>　
    <span class="filter" data-filter="flag_other" style="cursor:pointer">その他</span>　
    <span class="filter" data-filter="all" style="cursor:pointer">全て</span>　|　
    <?php if($device != "pc"): ?><br /><?php endif ?>
    <span class="sort" data-sort="data-name" data-order="desc" id="sort_name" style="cursor:pointer">名称順</span>　
    <span class="sort" data-sort="data-area" data-order="desc" style="cursor:pointer">地域順</span>　
    <span class="sort" data-sort="data-start" data-order="desc" style="cursor:pointer" id="data_start2">創立年順</span>　
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
          if($link[$i]['flag_school']) echo 'flag_school '; 
          if($link[$i]['flag_publication']) echo 'flag_publication '; 
          if($link[$i]['flag_food']) echo 'flag_food ';
          if($link[$i]['flag_other']) echo 'flag_other '; 
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

<style type="text/css">
#Grid .mix{
  opacity: 0;
  display: none;
}
#Grid2 .mix{
  opacity: 0;
  display: none;
}
</style>

<script type="text/javascript">

$(function(){
  $('#Grid').mixitup();
  $('#Grid2').mixitup({
    targetSelector: '.mix',
    filterSelector: '.filter',
    sortSelector: '.sort2',
  });
});

var map = null;
var infowindow = new google.maps.InfoWindow();
var gmarkers = [];
var contentString = [];
var sort = [];
var i = 0;

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

		$('.area').hide();
		$('.tab li').removeClass('active');
  	$('#tab1_menu').addClass('active');
		$('#tab1').fadeIn();
  	$('#tab1').show();
    flipsnap.moveToPoint(no);
	});
	
	gmarkers[id] = marker;
	i++;
	return marker;
}
function map_click(i) {
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
      mapTypeId: google.maps.MapTypeId.TERRAIN,
      //scrollwheel:false,
      streetViewControl:false,
      disableDefaultUI: true,
      zIndex:100
  };
  map  = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	google.maps.event.addListener(map, "click", function() { infowindow.close(); });
  
  <?php for($i=0; $i<count($link); $i++): if(!$link[$i]['latitude']) continue; ?>
    var Latlng = new google.maps.LatLng(<?php echo $link[$i]['latitude'] ?>, <?php echo $link[$i]['longitude'] ?>);
    contentString[<?php echo $link[$i]['id'] ?>] = "<div style='margin:0px; overflow: hidden;'>";
    contentString[<?php echo $link[$i]['id'] ?>] += "<img src='<?php echo $link[$i]['image'] ?>' width=150px>"
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
  <?php endif ?>
}

$(function() {
	$('.place_image')
	.hover(
		function(){
			$(this).stop().animate({
				'opacity':'0.85'
			}, 200);
		},
		function () {
			$(this).stop().animate({
				'opacity':'1'
			}, 200);
		}
	);
	$('.place_image2')
	.hover(
		function(){
			$(this).stop().animate({
				'opacity':'0.7'
			}, 200);
		},
		function () {
			$(this).stop().animate({
				'opacity':'1'
			}, 200);
		}
	);
});
</script>
