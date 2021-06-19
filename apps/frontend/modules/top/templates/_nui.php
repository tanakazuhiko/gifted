
<?php for($i=0; $i<count($product); $i++): ?>
  <div class="item2">
    <?php if($product[$i]['url']):?><a href="<?php echo $product[$i]['url'] ?>" target="_blank"><?php endif ?>
    <img class="nui_image cur_pt opac90" src="<?php echo $product[$i]['thumbnail'] ?>">
    <?php if($product[$i]['url']):?></a><?php endif ?>
    <div class="menu_comment4" <?php if($type==sfConfig::get('app_product_type_products')): ?>style="height:80px"<?php endif ?>>
      <?php echo nl2br(html_entity_decode($product[$i]['detail'])) ?>
    </div>
  </div>
<?php endfor; ?>
