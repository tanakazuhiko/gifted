<div id="topic-path" class=""><div class="pathArea">
<?php if($current!='ホーム'): ?>
<a >ホーム</a><span>&gt;</span><!--
<?php foreach($parent as $link => $name): ?>
--><a href="/<?php echo $link ?>"><?php echo $name ?><?php echo (strpos($link, 'list')!==false) ? '一覧':''?></a><span>&gt;</span><!--
<?php endforeach ?>
<?php else: ?>
<!--
<?php endif ?>
--><em><?php echo $current ?></em>
</div></div>