
<?php $title=sfConfig::get('app_title_'.$sf_context->getModuleName()); slot('title', $title[$sf_context->getActionName()])?>
<?php include_partial('global/header', array('isAuthenticated' => $isAuthenticated, 'place'=>'timeline')) ?>

<!-- page -->
<div id="page">

<div style="margin-bottom:200px"></div>

</div><!-- end id="page"> -->

<!-- footer -->
<footer id="footer">
  <?php include_partial('global/pankuzu', array('current' => $title[$sf_context->getActionName()], 'parent'=>array())) ?>
  <?php include_partial('global/footer', array()) ?>
</footer>

<!-- style -->
<style type="text/css">
</style>

<!-- script -->
<script type="text/javascript">
</script>
