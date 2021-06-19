会員様が退会しました。

ID　：<?php echo $id ?>　
名前：<?php echo $name ?>　
退会理由：
<?php for ($i=0;count($reasons)>$i;$i++):?>
<?php echo $reason_array[$reasons[$i]] ?>

<?php endfor;?>
コメント：<?php echo $comment ?>
