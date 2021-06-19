
<?php $description = sfConfig::get('app_meta_description_'.$sf_context->getActionName()); slot('description', $description) ?>
<?php $title = sfConfig::get('app_title_'.$sf_context->getModuleName()); slot('title', $title[$sf_context->getActionName()])?>
<?php include_partial('global/header', array('isAuthenticated' => $isAuthenticated, 'place'=>$work_type, 'no_top'=>true)) ?>
<?php
$str = ""; 
foreach($data_array as $key => $data):
  foreach($data as $key2 => $data2): 
    $str .= ",".$data2["title"];
  endforeach;
endforeach;
slot('keyword', $str)
?>

<script type="text/javascript" src="/js/jquery.smoothScroll.js"></script>
<script type="text/javascript" src="/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="/js/jquery.easie.js"></script>
<script type="text/javascript" src="/js/scrollReveal.js" ></script>
<link rel="stylesheet" type="text/css" href="/css/work.css" media="all" />

<nav id="progress-nav3" class="placeholder on" style="position: fixed;">
<img src="/img/prev2.png" style="opacity:0.5" class="move_btn prev prev_btn2" >
<img src="/img/next2.png" style="opacity:0.5" class="move_btn next next_btn2" >
</nav>

<nav id="progress-nav" class="placeholder on" style="opacity: 1;position: fixed;">
<ul id="progress-nav-ul">
<?php foreach($data_array as $place_id => $data):?>
<li><a href="#id<?php echo $data[0]["place_id"] ?>" id="link_id<?php echo $data[0]["place_id"] ?>" class="progress-nav-trigger"><span class="dot dot2"></span><span class="hover-text hover-text2" id="menu_id<?php echo $data[0]["place_id"] ?>"><?php echo $data[0]["Place"]["name"] ?></span></a></li>
<?php endforeach ?>
</ul>
</nav>

<?php foreach($data_array as $place_id => $data):?>
<section id="id<?php echo $data[0]["place_id"] ?>" class="plain box section-box box1" style="background-image: url(/img/work/<?php echo $data[0]["img"] ?>);">
<div class="box scroll box2" data-device="pc" data-scrollreveal="enter top move 40px, after 0.9s"><div class="block block2" style="margin-top:120px; margin-left:10px;">
<nav id="progress-nav2" class="placeholder on placeholder2" >
<ul id="progress-nav2-ul_<?php echo $data[0]["place_id"] ?>" style="margin: auto; width: 300px;">
<?php foreach($data as $key => $value):?>
 <li><a class="progress-nav2-trigger sub-nav2 sub-nav2_<?php echo $data[0]["place_id"] ?>" id="sub-nav2_<?php echo $data[0]["place_id"] ?>_<?php echo $key ?>" data-id="<?php echo $data[0]["place_id"] ?>" data-no="<?php echo $value["img_no"] ?>" data-url="/img/work/<?php echo $value["img"] ?>" data-name="<?php echo $value["title"] ?>"><span class="dot"></span></a></li>
<?php endforeach ?>
</ul></nav><br />
<header class="plate"><h1 class="panel-title" style="line-height: 1; padding: 0px 0px 10px; opacity: 1;">
<p style=""><a href="<?php echo $data[0]["Place"]["url"] ?>" target="_blank">
<span id="place_<?php echo $data[0]["place_id"] ?>" class="link_url font_min  font_color_<?php echo $data[0]["class"] ?> font_shadow_<?php echo $data[0]["class"] ?>" style="font-size:14px;"><?php echo $data[0]["Place"]["name"] ?></span></a></p>
<p style="margin-top:10px"><span style="font-size:38px;" class="font_min font_color_<?php echo $data[0]["class"] ?> font_shadow_<?php echo $data[0]["class"] ?> hover_white" id="title_<?php echo $data[0]["place_id"] ?>"><?php echo $data[0]["title"] ?></span></p></h1>
<div class="panel-description" style="line-height: 2; opacity: 1;">
<p><span class=" font_color_<?php echo $data[0]["class"] ?> font_shadow_<?php echo $data[0]["class"] ?>" style="font-size:12px;" id="detail_<?php echo $data[0]["place_id"] ?>">
<?php echo html_entity_decode($data[0]["contents"]) ?></span></p>
<p id="maker_<?php echo $data[0]["place_id"] ?>" class="font_color_<?php echo $data[0]["class"] ?> font_shadow_<?php echo $data[0]["class"] ?>" style="font-size:11px;">画像出典：<?php echo html_entity_decode($data[0]["maker"]) ?></p>
<p><a href="<?php echo $data[0]["url"] ?>" target="_blank" id="url2_<?php echo $data[0]["place_id"] ?>" class="hover_white">
<span class="link_url  font_go  font_color_<?php echo $data[0]["class"] ?> font_shadow_<?php echo $data[0]["class"] ?>" style="font-size:10px;" id="url_<?php echo $data[0]["place_id"] ?>"><?php echo $data[0]["url"] ?></span></a></p>
</div></header></div>

</div>
</section>
<?php endforeach ?>

<footer id="footer" style="margin-top: 0px;">
  <?php include_partial('global/pankuzu', array('current' => $title[$sf_context->getActionName()], 'parent'=>array())) ?>
  <?php include_partial('global/footer', array()) ?>
</footer>

<script type="text/javascript">
// tab
$(document).ready(function() {

  var pos     = 0;
  var base    = 20;
  var pos_no  = 0;
  var i = 0;
  var bases   = new Array;
<?php foreach($data_array as $place_id => $data):?>
  bases[i] = <?php echo $data[0]["place_id"] ?>;
  i++
<?php endforeach ?>
  var default_menu = 'menu_id'+bases[0]; 

  var scrolly = 0;
  var speed   = 800;
  var images  = new Array;
  var datas   = new Array;
  var urls    = new Array;
  var imgs    = new Array;
  var names   = new Array;
  var makers  = new Array;
  var keys    = new Array;
  var classes = new Array;
  var keyno   = new Array;
  var posno   = new Array;
  var n = 0;
  var m = 0;

  var config = {
    viewportFactor: 1,
    reset: true
  };
  window.scrollReveal = new scrollReveal( config );
      
<?php foreach($data_array as $key => $data):?>
  keyno["#<?php echo 'id'.$key ?>"] = m; m++;
  keys["<?php echo 'id'.$key ?>"] = new Array; n = 0;
  posno["#<?php echo 'id'.$key ?>"] = 0;
<?php foreach($data as $key2 => $data2): ?>
  keys["<?php echo 'id'.$key ?>"][n] = "<?php echo $data2['img_no'] ?>"; n++;
  datas["<?php echo 'id'.$key ?>_<?php echo $data2['img_no'] ?>"]   = '<?php echo html_entity_decode($data2["contents"]) ?>';
  makers["<?php echo 'id'.$key ?>_<?php echo $data2['img_no'] ?>"]  = '画像出典：<?php echo html_entity_decode($data2["maker"]) ?>';
  urls["<?php echo 'id'.$key ?>_<?php echo $data2['img_no'] ?>"]    = '<?php echo $data2["url"] ?>';
  imgs["<?php echo 'id'.$key ?>_<?php echo $data2['img_no'] ?>"]    = '<?php echo $data2["img"] ?>';
  names["<?php echo 'id'.$key ?>_<?php echo $data2['img_no'] ?>"]   = '<?php echo $data2["title"] ?>';
  classes["<?php echo 'id'.$key ?>_<?php echo $data2['img_no'] ?>"] = '<?php echo $data2["class"] ?>';
  $("<img>").attr("src", '/img/work/<?php echo $data2["img"] ?>');
<?php endforeach ?>
<?php endforeach ?>
  console.log(keyno);
  
  $('#progress-nav-ul li:first').children().addClass('active');
  $('#'+default_menu).css('opacity', '0.9');

/*  var hashes = window.location.href.slice(window.location.href.indexOf('#') + 1); 
  console.log('hashes:'+hashes);
  if(hashes){
    pos = keyno['#'+hashes];
    $('.progress-nav-trigger').removeClass('active');
    $('#link_'+hashes).addClass('active');
    $('.hover-text').css('opacity', '0');
    $('#menu_id'+ bases[pos] ).css('opacity', '0.9');
    console.log(pos+" "+base+" "+'#menu_id'+ bases[pos]);
  }
*/
  $.each(bases, function(i, value) {
    $('#progress-nav2-ul_'+value+' li:first').children().addClass('active');
  });

  $('.progress-nav-trigger').click(function() {
    $('.progress-nav-trigger').removeClass('active');
    $(this).addClass('active');
    $('.hover-text').css('opacity', '0');
    var id = $(this).attr("href");
    $('#menu_'+id.slice(1)).css('opacity', '0.9');
    //pos = id.slice(-1) - 1;
    pos = keyno[id];
    //console.log('pos:'+pos+' id:'+id);
  });

  $('.progress-nav2-trigger').click(function() {
    var id   = $(this).attr("data-id");
    $('.sub-nav2_'+id).removeClass('active');
    $(this).addClass('active');
  });

  $(".hover-text").hover(function(){
      $(this).css('opacity', '0.9');
    },function(){
    if(!$(this).parent().hasClass('active'))
      $(this).css('opacity', '0');
  });
  
  // サブメニュー
  $('.sub-nav2').click( 
    function () {
      var id   = $(this).attr("data-id");
      var no   = $(this).attr("data-no");
      var url  = $(this).attr("data-url");
      var name = $(this).attr("data-name");
      $('#id'+id).animate({
        opacity: 0
      }, 'fast', function () {
        $('#id'+id).css({'background-image': 'url('+url+')'}).animate({ opacity: 1 }, { duration: 1500, easing: 'swing', });
        $('#title_'+id).text(name);
        $('#detail_'+id).html(datas['id'+id+'_'+no]);
        $('#url_'+id).html(urls['id'+id+'_'+no]);
        $('#url2_'+id).attr("href", urls['id'+id+'_'+no]);
        $('#maker_'+id).html(makers['id'+id+'_'+no]);

        $('#place_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');
        $('#title_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');
        $('#detail_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');
        $('#maker_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');
        $('#url_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');

        $('#place_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
        $('#title_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
        $('#detail_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
        $('#maker_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
        $('#url_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
      });
    }
  );

  $('section').each(function(){
    images[images.length]   = $(this);
  });
 	
  $('html').mousewheel(function(event, mov) {
    if (mov > 0){ 
      scrolly =  $('body').scrollTop() - speed; 
      pos--;
    }else if (mov < 0){ 
      scrolly =  $('body').scrollTop() + speed; 
      pos++;
    }
    if(pos <= 0) pos = 0;
    else if(pos >= images.length-1) pos = images.length-1;
    //console.log('mousewheel pos:'+pos);

    $('.progress-nav-trigger').removeClass('active');
    $('#link_id'+(pos + base)).addClass('active');
    $('.hover-text').css('opacity', '0');
    $('#menu_id'+ bases[pos] ).css('opacity', '0.9');
    var position = images[pos].offset().top;
    $('html,body')
      .stop()
      .animate({scrollTop: position}, 'slow', $.easie(0,0,0,1));
    return false;
  });
  
  var $next = $('.next').click(function() { 
    $('#id'+bases[pos]).animate({
      opacity: 0
    }, 'fast', function () {
      posno['#id'+bases[pos]]++;
      if(posno['#id'+bases[pos]] >= keys['id'+bases[pos]].length) posno['#id'+bases[pos]] = 0;
      pos_no = posno['#id'+bases[pos]];
      var no = keys["id"+bases[pos]][pos_no];
      id = bases[pos];
      console.log('pos:'+pos+' id:'+id+' pos_no:'+pos_no);
      $('#id'+bases[pos]).css({'background-image': 'url(/img/work/'+ imgs['id'+bases[pos]+'_'+no] +')'}).animate({ opacity: 1 }, { duration: 1500, easing: 'swing', });
      $('#title_'+bases[pos]).text(names['id'+bases[pos]+'_'+no]);
      $('#detail_'+bases[pos]).html(datas['id'+bases[pos]+'_'+no]);
      $('#url_'+bases[pos]).html(urls['id'+bases[pos]+'_'+no]);
      $('#url2_'+bases[pos]).attr("href", urls['id'+bases[pos]+'_'+no]);
      $('#maker_'+bases[pos]).html(makers['id'+bases[pos]+'_'+no]);
      
      $('.sub-nav2_'+id).removeClass('active');
      $('#sub-nav2_'+id+'_'+pos_no).addClass('active');
      
      $('#place_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');
      $('#title_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');
      $('#detail_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');
      $('#maker_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');
      $('#url_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');

      $('#place_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
      $('#title_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
      $('#detail_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
      $('#maker_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
      $('#url_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
    });
  });
  var $prev = $('.prev').click(function() {
    $('#id'+bases[pos]).animate({
      opacity: 0
    }, 'fast', function () {
      posno['#id'+bases[pos]]--;
      if(posno['#id'+bases[pos]] < 0) posno['#id'+bases[pos]] = keys['id'+bases[pos]].length-1;
      pos_no = posno['#id'+bases[pos]];
      var no = keys["id"+bases[pos]][pos_no];
      id = bases[pos];
      $('#id'+bases[pos]).css({'background-image': 'url(/img/work/'+ imgs['id'+bases[pos]+'_'+no] +')'}).animate({ opacity: 1 }, { duration: 1500, easing: 'swing', });
      $('#title_'+bases[pos]).text(names['id'+bases[pos]+'_'+no]);
      $('#detail_'+bases[pos]).html(datas['id'+bases[pos]+'_'+no]);
      $('#url_'+bases[pos]).html(urls['id'+bases[pos]+'_'+no]);
      $('#url2_'+bases[pos]).attr("href", urls['id'+bases[pos]+'_'+no]);
      $('#maker_'+bases[pos]).html(makers['id'+bases[pos]+'_'+no]);

      $('.sub-nav2_'+id).removeClass('active');
      $('#sub-nav2_'+id+'_'+pos_no).addClass('active');
      
      $('#place_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');
      $('#title_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');
      $('#detail_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');
      $('#maker_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');
      $('#url_'+id).removeClass('font_color_w font_color_b font_shadow_w font_shadow_b');

      $('#place_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
      $('#title_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
      $('#detail_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
      $('#maker_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
      $('#url_'+id).addClass('font_color_'+classes['id'+id+'_'+no]+' font_shadow_'+classes['id'+id+'_'+no]);
    });
  });

  $(function() {
    $('.prev_btn2, .next_btn2')
    .hover(
      function(){
        $(this).stop().animate({
          'opacity':'0.9'
        }, 200);
      },
      function () {
        $(this).stop().animate({
          'opacity':'0.5'
        }, 200);
      }
    );
  });
});

function htmlEncode(value){
  return $('<div/>').text(value).html();
}
function htmlDecode(value){
  return $('<div/>').html(value).text();
}
</script>
