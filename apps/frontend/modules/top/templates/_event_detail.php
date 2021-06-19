
              <div id="news_detail_<?php echo $event['id'] ?>" 
                style="margin-bottom:20px; margin-left:10px; font-size:9pt; font-weight:normal; /*display:none;*/ line-height:160%; vertical-align:top; color:white; text-align:left;" >
                <table cellspacing=0 cellpadding=0 style="width:100%">
                <tr>
                <td width="<?php if($device == "pc"): ?>550px<?php else: ?>100%<?php endif ?>" style="vertical-align:top; font-size:8pt">
                  <?php echo nl2br(html_entity_decode($event['contents'])) ?><br /><br />
                  <?php $tmp_array = explode(" ",$event['tags']); if($event['tags']): ?>
                    <span style="color:#d8d8d8">タグ: <?php echo $event['tags'] ?></span><br /><br />
                  <?php endif ?>
                  <?php if($event['url']): ?>
                    url: <a style="padding:0px;font-size:10px;display:inline;" href="<?php echo $event['url']?>" target="_blank"><?php echo $event['url']?></a><br>
                  <?php endif ?>
                  <?php if($event['image']): ?>
                    <!-- image: <a style="padding:0px;font-size:10px;display:inline;" href="<?php echo $event['image']?>" target="_blank"><?php echo $event['image']?></a-->
                  <?php endif ?>
                </td>
                <td style="padding-left:40px;padding-bottom:20px">
                  <?php if($event['image']):?>
                    <a <?php if($event['url']):?>href="<?php echo $event['url'] ?>"<?php endif ?> 
                      target="_blank">
                    <?php $width = ($event['place_id']=='210') ? '170px':'250px' ?>
                    <img width="<?php echo $width ?>" src="<?php echo $event['image'] ?>" class="tooltip smp-hdn" title="image; <?php echo $event['image'] ?>"></a>
                    <?php if($event['id']=='587' || $event['id']=='588'): ?>
                      <div style="font-size:7pt; margin-top:-15px">イメージ写真：手話ツアー風景<br />撮影：御厨慎一郎</div>
                    <?php elseif($event['id']=='589'): ?>
                      <div style="font-size:7pt; margin-top:-15px">イメージ写真：耳と手でみるアート風景<br />撮影：御厨慎一郎</div>
                    <?php elseif($event['id']=='815'||$event['id']=='887'): ?>
                      <div style="font-size:7pt; margin-top:-15px">イメージ写真：耳と手でみるアート風景<br />（「六本木クロッシング2013展」2013年）<br />撮影：田山達之</div>
                    <?php elseif($event['id']=='816'||$event['id']=='885'||$event['id']=='886'): ?>
                      <div style="font-size:7pt; margin-top:-15px">イメージ写真：手話ツアー風景<br />（「六本木クロッシング2013展」2013年）<br />撮影：田山達之</div>
                    <?php elseif($event['id']=='817'): ?>
                      <div style="font-size:7pt; margin-top:-15px">イメージ写真：キュレータートーク風景<br />（「LOVE展」2013年）<br />撮影：御厨慎一郎</div>
                    <?php elseif($event['id']=='700'||$event['id']=='760'): ?>
                      <div style="font-size:7pt; margin-top:-15px">野間口桂介(しょうぶ学園) 無題 2005 年 <br>©Shobu Gakuen</div>
                    <?php elseif($event['id']=='761'): ?>
                      <div style="font-size:7pt; margin-top:-15px">冬木陽(アトリエ・エレマン・プレザン)《あか》2012 年 <br>©Atelier Elément Présent</div>
                    <?php endif ?>
                  <?php endif ?>
                </td>
                </tr>
                <tr>
                <td colspan="2">
<!--iframe width="90%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
  src="https://maps.google.co.jp/maps?f=q&amp;source=s_q&amp;hl=ja&amp;geocode=&amp;q=%E6%9D%B1%E4%BA%AC%E5%9B%BD%E9%9A%9B%E3%83%95%E3%82%A9%E3%83%BC%E3%83%A9%E3%83%A0&amp;aq=&amp;sll=35.427962,139.658385&amp;sspn=0.100712,0.161877&amp;brcurrent=3,0x60188c0c0b13f54d:0xb630953beee48188,0&amp;ie=UTF8&amp;hq=%E6%9D%B1%E4%BA%AC%E5%9B%BD%E9%9A%9B%E3%83%95%E3%82%A9%E3%83%BC%E3%83%A9%E3%83%A0&amp;hnear=&amp;radius=15000&amp;t=m&amp;ll=35.676657,139.7643&amp;spn=0.071946,0.071946&amp;output=embed"></iframe><br /><small><a href="https://maps.google.co.jp/maps?f=q&amp;source=embed&amp;hl=ja&amp;geocode=&amp;q=%E6%9D%B1%E4%BA%AC%E5%9B%BD%E9%9A%9B%E3%83%95%E3%82%A9%E3%83%BC%E3%83%A9%E3%83%A0&amp;aq=&amp;sll=35.427962,139.658385&amp;sspn=0.100712,0.161877&amp;brcurrent=3,0x60188c0c0b13f54d:0xb630953beee48188,0&amp;ie=UTF8&amp;hq=%E6%9D%B1%E4%BA%AC%E5%9B%BD%E9%9A%9B%E3%83%95%E3%82%A9%E3%83%BC%E3%83%A9%E3%83%A0&amp;hnear=&amp;radius=15000&amp;t=m&amp;ll=35.676657,139.7643&amp;spn=0.071946,0.071946" style="color:#0000FF;text-align:left">大きな地図で見る</a></small-->
                </td>
                </tr>
                </table>
              </div>
