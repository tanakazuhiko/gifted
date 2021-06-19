
<?php if($detail['name']=="あとりえすずかけ"): ?>

  <div style="width:100%; text-align:center; margin:50px 0px; color:red; font-size:9pt">詳細情報はございません。</div>
   
<?php else: ?>
 
  <div class="item_link">
    <div style="margin-top:10px"></div>
    <div class="mainbox01"><div class="com-box2">
            <dl>
            <dt></dt>
            <dd>
            <table><tr><td>
            <a  href="<?php echo $detail['url'] ?>" target="_blank" onmouseover="javascript:map_click(<?php echo $detail['id'] ?>)" style="cursor:pointer;color:#59E295; font-size:12pt">
            <?php echo $detail['name'] ?></a> <?php if($detail['delete_flag']){ echo "（未公開）"; } ?>
            </td></tr></table>
            </dd>
            <dt></dt><dd><table><tr><td><span style="font-size:8pt"><?php echo nl2br(htmlspecialchars_decode($detail['copy'])) ?></span></td></tr></table></dd>
            <?php if($detail['start_from']): ?><dt></dt><dd><span style="font-size:9pt"><?php echo $detail['start_from'] ?> 創立</span></dd><?php endif ?>
            <?php if($detail['address']): ?>
            <dt></dt><dd><table><tr><td><?php echo nl2br(substr($detail['address'], 12)) ?></td></tr></table></dd>
            <?php endif ?>
            <?php if($detail['tel']): ?>
            <!--
            <dt>TEL</dt><dd><a href="tel:<?php echo $detail['tel'] ?>"><?php echo $detail['tel'] ?></a>
              <?php if($detail['fax']): ?>
              <span style="margin-left:180px">FAX</span><span style="margin-left:30px"><?php echo $detail['fax'] ?></span>
              <?php endif ?>
            </dd>
            -->
            <?php endif ?>
            <?php if($detail['mail']): ?>
            <!--dt>メール</dt><dd><a href="mailto:<?php echo $detail['mail'] ?>"><?php echo $detail['mail'] ?></a></dd-->
            <?php endif ?>
            <dt></dt><dd><table cellspacing=0 cellpadding=0><tr><td><a href="<?php echo $detail['url'] ?>" target="_blank"><?php echo $detail['url'] ?></a></td></tr></table></dd>
            
            <!--
            <?php if($detail['facebook']): ?>
            <dt></dt><dd style="font-size:8pt"><table><tr><td>fb: <a href="https://www.facebook.com/<?php echo $detail['facebook'] ?>" target="_blank">https://www.facebook.com/<?php echo $detail['facebook'] ?></a></td></tr></table></dd>
            <?php endif ?>
            <?php if($detail['twitter']): ?>
            <dt></dt><dd style="font-size:8pt"><table><tr><td>tw: <a href="https://twitter.com/<?php echo $detail['twitter'] ?>" target="_blank">https://twitter.com/<?php echo $detail['twitter'] ?></a></td></tr></table></dd>
            <?php endif ?>
            -->
            
            <dt></dt>
            <dd>
              <table style="width:<?php if($device == "pc"): ?>95%<?php else: ?>90%<?php endif ?>">
              <tr><td style="font-size:9pt" id="detail_memo"><?php echo nl2br(htmlspecialchars_decode($detail['memo'])) ?>
              <?php if($detail['logo']): ?>
                <br><br><div style="width:100%; text-align:center">
                <a href="<?php echo $detail['url'] ?>" target="_blank">
                <img width="200px" class="place_image" src="<?php echo $detail['logo'] ?>"></a></div>
              <?php endif ?>
              </td></tr></table>
            </dd>
            
          <?php //if($device == "pc"): ?>
          
            <?php if(isset($image[$detail['id']]) && count($image[$detail['id']])): ?>
            <div style="color:#59E295;font-size:10pt; margin:10px 0px 0px 20px; ">images</div>
            <dt></dt>
            <dd style="margin-top:0px">
            <style type="text/css">
            .flipsnap_link_<?php echo $detail['id'] ?> {
              width: <?php echo (210 * count($image[$detail['id']])) ?>px;
            }
            </style>
            <script type="text/javascript">
            $(document).ready(function() {
              Flipsnap('.flipsnap_link_<?php echo $detail["id"] ?>', {
                distance: 210,
              });	
            });
            </script>
              <div class="viewport_link" style="margin-top:0px">
              <div class="flipsnap_link_<?php echo $detail['id'] ?>">
                <?php for($n=0; $n<count($image[$detail['id']]); $n++): ?>
                  <div class="item_link2">
                  <?php if($image[$detail['id']][$n]['url']): ?>
                  <a href="<?php echo $image[$detail['id']][$n]['url'] ?>" target="_blank">
                  <img src="<?php echo $image[$detail['id']][$n]['src'] ?>" width="200px" class="tooltip place_image" 
                    title="image; <?php echo $image[$detail['id']][$n]['url'] ?>"></a>
                  <?php else: ?>
                  <img src="<?php echo $image[$detail['id']][$n]['src'] ?>" width="200px" class="tooltip place_image" 
                    title="copyright <?php echo $detail['name'] ?>">
                  <?php endif ?>
                  </div>
                <?php endfor; ?>
              </div></div>      
            </dd>
            <?php endif ?>

          <?php //endif ?>

          <?php //if($device == "pc"): ?>
            
            <?php if( isset($event) && count($event) ): ?>
            <div style="color:#59E295;font-size:10pt; margin:10px 0px 0px 20px; ">news</div>
            <dt></dt>
            <dd>
              <table ><tr><td style="font-size:9pt;<?php if($device != "pc"): ?>width:95%;<?php endif ?>">
              <?php for($n=0; $n<count($event); $n++):  if($n>=5) break;?>
                <span id="event_<?php echo $event[$n]['id'] ?>" style="margin-bottom:10px">
                <span style="font-size:9pt; margin-bottom:10px">
                  <?php echo ($event[$n]['year']) ? $event[$n]['year'].'　　&nbsp;&nbsp;' : date('Y.m.d',strtotime($event[$n]['startdate'])) ?></span>&nbsp;&nbsp;
                <?php if($device != "pc"): ?><br /><?php endif ?>
                <a id="news_title_<?php echo $event[$n]['id'] ?>" name="<?php echo $event[$n]['id'] ?>"
                  onclick="news_open(<?php echo $event[$n]['id'] ?>); return false" 
                  <?php if($device == "pc"): ?>
                    onMouseOver="imagePreview()" 
                    onMouseOut="color_news(<?php echo $event[$n]['id'] ?>)"
                    <?php if($event[$n]['image']): ?>
                      href="<?php echo $event[$n]['image'] ?>" title="<?php echo $event[$n]['image'] ?>" class="preview"
                    <?php endif ?>
                  <?php endif ?>
                  style="cursor:pointer;<?php if(!$event[$n]['contents']&&!$event[$n]['image']): ?>color:white<?php endif ?>">
                  <?php echo $event[$n]['name'] ?> <?php //echo ($place=$event[$n]['place']) ? '（'.$place.'）' : ''; ?>
                </a>
                <?php if($event[$n]['contents']||$event[$n]['image']): ?>  
                <div id="news_detail_<?php echo $event[$n]['id'] ?>" 
                  style="margin-bottom:20px; font-size:9pt; font-weight:normal;
                  display:none;" >
                  <table cellspacing=0 cellpadding=0><tr><td width="<?php if($device == "pc"): ?>500px<?php else: ?>100%<?php endif ?>" style="vertical-align:top; font-size:8pt">
                    <br />
                    <?php echo nl2br(html_entity_decode($event[$n]['contents'])) ?>
                    <br /><?php if($device != "pc"): ?><br /><?php endif ?>
                    <?php if($event[$n]['url'] && $device == "pc"): ?>url: <a style="padding:0px;font-size:10px;display:inline;" 
                      href="<?php echo $event[$n]['url']?>" target="_blank"><?php echo $event[$n]['url']?></a><br><?php endif ?>
                    <?php if($event[$n]['image']): ?><!-- image: <a style="padding:0px;font-size:10px;display:inline;" 
                      href="<?php echo $event[$n]['image']?>" target="_blank"><?php echo $event[$n]['image']?></a--><?php endif ?>
                  </td><td style="padding-left:40px;padding-bottom:20px">
                    <?php if($event[$n]['image']):?>
                      <a <?php if($event[$n]['url']):?>href="<?php echo $event[$n]['url'] ?>"<?php endif ?> 
                        target="_blank">
                      <img width="200px" src="<?php echo $event[$n]['image'] ?>" class="tooltip smp-hdn" title="image; <?php echo $event[$n]['image'] ?>"></a>
                      <?php if($event[$n]['id']=='587' || $event[$n]['id']=='588'): ?>
                        <div style="font-size:7pt; margin-top:-15px">イメージ写真：手話ツアー風景<br />撮影：御厨慎一郎</div>
                      <?php elseif($event[$n]['id']=='589'): ?>
                        <div style="font-size:7pt; margin-top:-15px">イメージ写真：耳と手でみるアート風景<br />撮影：御厨慎一郎</div>
                      <?php endif ?>
                    <?php endif ?>
                  </td></tr></table>
                </div>
                <?php endif ?>
                </span><br />
              <?php endfor; ?>
              </td></tr></table>
            </dd>
            <?php endif ?>

          <?php //endif ?>

      <div class="ingrid in-halves">
       
      <?php if($detail['twitter_widget_id']): ?>
        <div class="unit" id="twitter_box" style="/*width:48%; margin:10px 10px*/">
          <div style="color:#59E295;font-size:10pt; margin:10px 0px 10px 20px; ">twitter</div>

          <iframe id="frame_tw" src="/tw/<?php echo $detail['id'] ?>/height/600" 
            style="<?php if($device == "pc"): ?>width:98%; height:610px;<?php else: ?>width:260px; height:410px;<?php endif ?> border:none; overflow:hidden; background-color:white;"
            scrolling="no" frameborder="0" allowTransparency="true"></iframe>

        </div>
      <?php endif ?>
                
      <?php if($detail['facebook']): ?>
        <div class="unit" style="/*width:48%; margin:10px 10px*/">
          <div style="color:#59E295;font-size:10pt; margin:10px 0px 10px 20px; ">facebook</div>

          <iframe id="frame_fb" scrolling="no" frameborder="0" 
            src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2F<?php echo urlencode($detail['facebook']) ?>&amp;width&amp;height=600&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=true&amp;show_border=false&amp;appId=565651966841855" 
            style="<?php if($device == "pc"): ?>width:98%; height:610px;<?php else: ?>width:260px; height:410px;<?php endif ?> border:none; overflow:hidden; background-color:white;" allowTransparency="true"></iframe>

        </div>
      <?php endif ?>

      </div>

    </dl>
    </div></div>
  </div>
      
<?php endif ?>
