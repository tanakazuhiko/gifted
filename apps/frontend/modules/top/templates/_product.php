
<?php for($i=0; $i<count($product); $i++): ?>
	<div class="item2">
	  <a href="<?php echo $product[$i]['site_url'] ?>" target="_blank" style="color: #666;">
	  <img class="product_image opac100" src="<?php echo $product[$i]['thumbnail'] ?>" ></a>
    <div class="menu_comment2">
      <?php echo $product[$i]['name'] ?><br>
      <?php echo nl2br(html_entity_decode($product[$i]['detail'])) ?>
      order：<a href="<?php echo $product[$i]['site_url'] ?>" target="_blank" style="color: #666;"><?php echo $product[$i]['site_name'] ?></a>
    </div>
	</div>
<?php endfor; ?>
