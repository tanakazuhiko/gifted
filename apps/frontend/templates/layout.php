<!doctype html>
<html lang="ja" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta charset="UTF-8">
<meta name="keywords"           content="<?php echo sfConfig::get('app_meta_keywords') ?><?php include_slot('keyword') ?>">
<meta name="description"        content="<?php include_slot('description') ?>">
<meta name="format-detection"   content="telephone=no">
<meta name="viewport"           content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<meta property="og:site_name"   content="gifted; 神さまの贈りもの" />
<meta property="og:title"       content="gifted; <?php include_slot('title') ?>" />
<meta property="og:url"         content="http://gftd.me<?php echo urldecode($_SERVER['REQUEST_URI']) ?>" />
<meta property="og:image"       content="http://gftd.me/img/link/shobu.png" />
<meta property="og:description" content="<?php include_slot('description') ?>" />
<meta property="og:type"        content="website" />
<meta property="og:locale"      content="ja_JP" />
<meta property="fb:app_id"      content="565651966841855" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta http-equiv="X-UA-Compatible" content="chrome=1" />
<link rel="stylesheet" type="text/css" href="/css/grid.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="/css/gmapv3.css"  />
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.css"  />
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC3WwmjJqe_bSGPdVFcQ7MoGfQxSETEjss&sensor=true"></script>
<script type="text/javascript" src="/js/jquery1.9.1.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery.xdomainajax.js"></script>
<script type="text/javascript" src="/js/jquery.preview.js"></script>
<script type="text/javascript" src="/js/jquery.mixitup.min.js"></script>
<script type="text/javascript" src="/js/flipsnap.js"></script>
<script type="text/javascript" src="/js/function.js"></script>
<title>gifted; <?php include_slot('title') ?></title>
</head>
<body>
<?php echo $sf_content ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44492700-1', 'gftd.me');
  ga('send', 'pageview');
</script>
</body>
</html>
