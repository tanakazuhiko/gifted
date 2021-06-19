地元応援クラウドファンディングサービス FAAVOをご利用いただきありがとうございます。
下記内容でプロジェクトへの支援を受けました。

■プロジェクト
---------------------------------------------------------------------------------------------------------
プロジェクト名：<?php echo $project['title'] ?>　
<?php echo sfConfig::get('app_url_home_url'); ?>/<?php echo $prefecture ?>/project/<?php echo $project['id'] ?>　
---------------------------------------------------------------------------------------------------------

■応援者
---------------------------------------------------------------------------------------------------------
名前：<?php echo $member['name'] ?>　
<?php echo sfConfig::get('app_url_home_url'); ?>/supporter/<?php echo $member['id'] ?>　
支援した金額：<?php echo number_format($data['amount']) ?>円　
---------------------------------------------------------------------------------------------------------


<?php include_partial('global/signature', array()) ?>