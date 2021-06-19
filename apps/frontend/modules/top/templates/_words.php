
<?php for($i=0; $i<count($words); $i++): ?>
  <div style="width:80%; float:<?php if($words[$i]['no']%2==0):?>right<?php else: ?>left<?php endif ?>;">
  <div class="arrow_box<?php if($words[$i]['no']%2==0) echo "2" ?> over_box"
    onMouseOver="comment_hover()" onMouseOut="comment_hover()">
    <?php echo nl2br(html_entity_decode($words[$i]['comment'])) ?>
  </div></div>
  <div class="clearfix"></div>
  <div style="padding:10px 0px;margin:10px 0px; font-size:8pt; float:<?php if($words[$i]['no']%2==0):?>right<?php else: ?>left<?php endif ?>;">
    <?php if($words[$i]['url']): ?>
    <a id="words_title_<?php echo $words[$i]['id'] ?>"  name="<?php echo $words[$i]['id'] ?>" 
      href="<?php echo $words[$i]['url'] ?>" target="_blank" class="screenshot" rel="<?php echo $words[$i]['thumbnail'] ?>"
      onMouseOver="screenshotPreview()" onMouseOut="color_words(<?php echo $words[$i]['id'] ?>)">
    <?php endif ?>
        <?php echo $words[$i]['name'] ?> / <?php echo $words[$i]['title'] ?> (<?php echo $words[$i]['posted_at'] ?>)</a>
  </div>
  <div class="clearfix"></div>
<?php endfor; ?>
