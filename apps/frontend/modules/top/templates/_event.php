
  <?php for($i=0; $i<count($event); $i++): ?>
    <?php 
      $open_flag = false; 
      if( strtotime($event[$i]['startdate']) > strtotime(date('Y-m-d H:i:s')))  $open_flag = true; 
      if( isset($event[$i]['enddate']) && strtotime($event[$i]['enddate']) > strtotime(date('Y-m-d H:i:s')) ) $open_flag = true;
    ?>
    <li id="event_<?php echo $event[$i]['id'] ?>">
    <span style="font-size:10pt">
      <?php echo ($event[$i]['year']) ? $event[$i]['year'].'　　&nbsp;&nbsp;' : date('Y.m.d',strtotime($event[$i]['startdate'])) ?></span>
    <a id="news_title_<?php echo $event[$i]['id'] ?>" name="<?php echo $event[$i]['id'] ?>"
      onclick="news_open(<?php echo $event[$i]['id'] ?>); return false" 
      <?php if($device == "pc"): ?>
        onMouseOver="imagePreview()" 
        onMouseOut="color_news(<?php echo $event[$i]['id'] ?>)"
        <?php if($event[$i]['image']): ?>
          href="<?php echo $event[$i]['image'] ?>" title="<?php echo $event[$i]['image'] ?>" class="preview"
        <?php endif ?>
      <?php endif ?>
      style="cursor:pointer;<?php if(!$event[$i]['contents']&&!$event[$i]['image']): ?>color:white<?php endif ?>
        <?php if($open_flag):?>color:#59E295<?php endif?>">
      <?php echo $event[$i]['name'] ?> <?php echo ($place=$event[$i]['place']) ? '（'.$place.'）' : ''; ?>
    </a>
    <?php if($event[$i]['contents']||$event[$i]['image']): ?>  
    <div id="news_detail_<?php echo $event[$i]['id'] ?>" 
      style="margin-bottom:20px; font-size:9pt; font-weight:normal;
      display:<?php if($open_flag):?>block<?php else:?>none<?php endif?>;" >
      <table cellspacing=0 cellpadding=0><tr><td width="500px" style="vertical-align:top; font-size:8pt">
        
        <?php echo nl2br(html_entity_decode($event[$i]['contents'])) ?><br /><br />
        
        <?php if($event[$i]['url']): ?>
          url: <a style="padding:0px;font-size:10px;display:inline;" href="<?php echo $event[$i]['url']?>" target="_blank"><?php echo $event[$i]['url']?></a><br>
        <?php endif ?>
        
        <?php if($event[$i]['image']): ?>
          <!--image: <a style="padding:0px;font-size:10px;display:inline;" href="<?php echo $event[$i]['image']?>" target="_blank"><?php echo $event[$i]['image']?></a-->
        <?php endif ?>
      
      </td><td style="padding-left:40px;padding-bottom:20px">
        <?php if($event[$i]['image']):?>
        <a <?php if($event[$i]['url']):?>href="<?php echo $event[$i]['url'] ?>"<?php endif ?> 
          target="_blank">
        <img width="200px" src="<?php echo $event[$i]['image'] ?>" class="tooltip smp-hdn" title="image; <?php echo $event[$i]['image'] ?>"></a>
          <?php if($event[$i]['id']=='700' || $event[$i]['id']=='760'): ?>
            <div style="font-size:7pt; margin-left:20px">野間口桂介(しょうぶ学園) 無題 2005 年 <br>©Shobu Gakuen</div>
          <?php endif ?>
        <?php endif ?>
      </td></tr></table>
    </div>
    <?php endif ?>
    </li>
  <?php endfor; ?>
