<?php echo $name ?> 様

お問合せ、ありがとうございました。
以下の内容でお問合せを承りました。

ご回答まで、少々お待ちください。

氏名： <?php echo $name ?>

メール： <?php echo $mail ?>

お問合せ内容：
<?php echo $comment ?>


<?php include_partial('global/signature', array()) ?>

<?php if(!$user_flag): ?>
■ご利用環境：
<?php echo $_server['HTTP_USER_AGENT']?> 
IP:<?php echo $_server['REMOTE_ADDR']?> 
<?php endif ?>
