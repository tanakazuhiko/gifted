
<span class="loading2"></span>

<?php for($i=0; $i<count($event); $i++): ?>
 <div class="grid2_div mix 
  <?php 
    if($event[$i]['flag_art'])    echo 'flag_art ';
    if($event[$i]['flag_product'])    echo 'flag_product ';
    if($event[$i]['flag_music'])  echo 'flag_music ';
    if($event[$i]['flag_dance'])  echo 'flag_dance ';
    if($event[$i]['flag_food'])   echo 'flag_food ';
    if($event[$i]['flag_talk'])   echo 'flag_talk ';
    if($event[$i]['flag_other'])  echo 'flag_other ';
    if($event[$i]['startdate'] > date('Y-m-d')){
      echo 'flag_future ';
    }else{
      if($event[$i]['startdate'] == date('Y-m-d') || $event[$i]['enddate'] >= date('Y-m-d') )
        echo 'flag_current ';
      else
        echo 'flag_past ';
    }
    echo $event[$i]['tags'].' ';
    echo $pref_id_array[$event[$i]['prefectureid']].' ';
    if($event[$i]['prefectureid']==1) echo '北海道 ';
    elseif( 2<=$event[$i]['prefectureid'] && $event[$i]['prefectureid']<=7) echo '東北 ';
    elseif( 8<=$event[$i]['prefectureid'] && $event[$i]['prefectureid']<=14) echo '関東 ';
    elseif(15<=$event[$i]['prefectureid'] && $event[$i]['prefectureid']<=23) echo '中部 ';
    elseif(24<=$event[$i]['prefectureid'] && $event[$i]['prefectureid']<=30) echo '近畿 ';
    elseif(31<=$event[$i]['prefectureid'] && $event[$i]['prefectureid']<=35) echo '中国 ';
    elseif(36<=$event[$i]['prefectureid'] && $event[$i]['prefectureid']<=39) echo '四国 ';
    elseif(40<=$event[$i]['prefectureid'] && $event[$i]['prefectureid']<=47) echo '九州・沖縄 ';
    echo substr($event[$i]['startdate'], 0, 4).' ';
  ?> "
  data-name="<?php echo $event[$i]['name'] ?>"
  data-date="<?php echo $event[$i]['startdate'] ?>"
  data-area="<?php echo $event[$i]['prefectureid'] ?>"
 >
<dt class="grid2_dt" style="<?php if($device == "pc"): ?>width:370px;<?php else: ?>width:100%;padding-bottom:0px;<?php endif ?> font-size:9pt; font-weight:normal;">

 <a onclick = "event_detail('<?php echo $event[$i]['id'] ?>'); return false;" style="width:100%;"
<?php if($device == "pc"): ?> 
 <?php if($event[$i]['place_id']>0): ?> onmouseover = "imagePreview(); spot('<?php echo $event[$i]['place_id'] ?>','<?php echo $link[$event[$i]['place_id']]['latitude'] ?>','<?php echo $link[$event[$i]['place_id']]['longitude'] ?>','<?php echo $link[$event[$i]['place_id']]['name'] ?>','<?php echo $link[$event[$i]['place_id']]['image'] ?>');"
 <?php else: ?> onmouseover = "spot_null();"
 <?php endif ?>
 <?php if($event[$i]['image']): ?> href="<?php echo $event[$i]['image'] ?>" title="<?php echo $event[$i]['image'] ?>" class="preview" <?php endif ?>
<?php else: ?> onclick = "map_click(<?php echo $event[$i]['id'] ?>);" 
<?php endif ?> >
<?php if($event[$i]['startdate']==date('Y-m-d')||($event[$i]['startdate']<=date('Y-m-d')&&$event[$i]['enddate'] >= date('Y-m-d'))): ?><img src="/img/icon_now.png">
<?php elseif($event[$i]['startdate'] > date('Y-m-d')): ?><img src="/img/icon_next.png">
<?php elseif($event[$i]['startdate'] < date('Y-m-d') && $event[$i]['enddate'] < date('Y-m-d') ): ?>
<?php endif ?>
<?php if($event[$i]['updated_at'] >= date("Y-m-d", strtotime("-7 day"))): ?><span class="new_icon">new</span><?php endif ?>
<?php echo $event[$i]['name'] ?></a>
</dt>
<dd class="grid2_dd" style="border-bottom:none; font-size:9pt;<?php if($device != "pc"): ?>padding-left:10px;<?php endif ?>">
 <span class="grid2_span" 
<?php if($event[$i]['startdate']==date('Y-m-d')||($event[$i]['startdate']<=date('Y-m-d')&&$event[$i]['enddate'] >= date('Y-m-d'))): ?>style="color:#FF69A3"
<?php elseif($event[$i]['startdate'] > date('Y-m-d')): ?>style="color:#30F9B2"
<?php elseif($event[$i]['startdate'] < date('Y-m-d') && $event[$i]['enddate'] < date('Y-m-d') ): ?>style="/*color:#c0c0c0*/"
<?php endif ?> >
  <span class="vam"><?php echo $event[$i]['startdate'] ?></span>
  <?php if($event[$i]['enddate']): ?>～ <?php endif ?><span class="vam" style="width:220px;"><?php echo $event[$i]['enddate'] ?></span>
  <?php if(!$event[$i]['startdate']): ?><span class="vam"><?php echo $event[$i]['year'] ?></span>　<?php endif ?>
 </span>
 <?php if($device != "pc"): ?><br /><?php endif ?>
 <span class="grid2_span2" style="<?php if($device != "pc"): ?>padding-left:0px;margin-left:0px;width:auto;<?php endif ?>"><?php if(isset($pref_id_array[$event[$i]['prefectureid']])): ?><?php echo $pref_id_array[$event[$i]['prefectureid']] ?><?php endif ?></span>
 <?php if(in_array($event[$i]['place'], $sf_data->getRaw('tags_array'))): ?><span class="filter noactive  cw" data-filter="<?php echo $event[$i]['place'] ?>" style="font-weight:normal; color:white;"
   onmouseover="spot('<?php echo $event[$i]['place_id'] ?>','<?php echo $link[$event[$i]['place_id']]['latitude'] ?>','<?php echo $link[$event[$i]['place_id']]['longitude'] ?>','<?php echo $link[$event[$i]['place_id']]['name'] ?>','<?php echo $link[$event[$i]['place_id']]['image'] ?>')"
 ><?php echo $event[$i]['place'] ?></span>
 <?php else: ?><span class="<?php if($device == "pc"): ?>pd5<?php endif ?>" style="color:white"><?php echo $event[$i]['place'] ?></span>
 <?php endif ?>
</dd>
<div id="event_detail_<?php echo $event[$i]['id'] ?>" class="event_detail dn"><span id="loading"></span></div>
</div>
<?php endfor; ?>
