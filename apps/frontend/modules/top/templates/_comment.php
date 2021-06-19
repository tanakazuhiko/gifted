
  <?php for($i=0; $i<count($comment); $i++): ?>
  <div style="width:80%;float:<?php if($i%2==0): ?>left<?php else: ?>right<?php endif ?>;"><div class="arrow_box<?php if($i%2!=0): ?>2<?php endif ?>">
    <?php echo nl2br($comment[$i]['comment']) ?> 
  </div></div>
  <div class="clearfix"></div>
  <div style="padding:10px;margin-top:10px; font-size:8pt;float:<?php if($i%2==0): ?>left<?php else: ?>right<?php endif ?>;">
    <?php echo $comment[$i]['name'] ?>&nbsp;&nbsp;<?php echo date('Y.n.j H:i',strtotime($comment[$i]['created_at'])) ?><br><br></div>
  <div class="clearfix" ></div>
  <?php endfor; ?>
