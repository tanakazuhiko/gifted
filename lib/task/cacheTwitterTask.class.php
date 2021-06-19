<?php

/*
 * cacheTwitterTask
* php symfony batch:cacheTwitter
*
*/
class cacheTwitterTask extends sfBaseTask
{
  protected function configure()
  {
    $this->env          = 'prod';
    $this->application  = 'frontend';
    $this->connection   = 'doctrine';

    $this->addOptions(array(
      new sfCommandOption('application',  null, sfCommandOption::PARAMETER_REQUIRED, 'The application name',  $this->application),
      new sfCommandOption('env',          null, sfCommandOption::PARAMETER_REQUIRED, 'The environment',       $this->env),
      new sfCommandOption('connection',   null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name',   $this->connection),
      // add your own options here
    ));

    $this->namespace        = 'batch';
    $this->name             = 'cacheTwitter';
    $this->briefDescription = 'Twitterキャッシュバッチ';
    $this->detailedDescription = <<<EOF
The [cacheTwitter|INFO] task does things.
Call it with:

  [php symfony cacheTwitter|INFO]
EOF;

    $this->addArguments(array(
        new sfCommandArgument('target_date', sfCommandArgument::OPTIONAL, '処理対象日'),
    ));
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // エラーメール送信の際インスタンスが必要 
    // http://devsperch.wordpress.com/2010/04/22/symfony%E3%81%AE%E3%82%BF%E3%82%B9%E3%82%AF%E3%81%A7%E3%83%90%E3%83%83%E3%83%81%E5%87%A6%E7%90%86%E3%81%A8%E3%81%8B/
    // http://gomojp.blog77.fc2.com/blog-entry-59.html
    sfContext::createInstance($this->configuration);

    // バッチ処理実行
    commonUtil::outputErrLog('------------------------- start ---------------------------', 'Notice', true);
    commonUtil::outputErrLog('処理対象日：'.$order_date, 'Notice', true);

    require_once('/home/gifted/'.$this->env.'/lib/util/simple_html_dom.php');
    mb_language('Japanese');
        
    // データ取得
    $link     = Doctrine_Core::getTable('Place')->getLinkList($key='prefectureId', $dir='asc');

    for($i=0; $i<count($link); $i++)
    {
      if($link[$i]['twitter_widget_id'])
      {
        echo $link[$i]['twitter_widget_id'] .":".$link[$i]['name']."\n";

        $url = 'https://twitter.com/'.$link[$i]['twitter'];
        $contents = file_get_contents($url);
        $content = mb_convert_encoding($contents, 'UTF-8', 'auto');
        $html = str_get_html($content);
        
        if(!isset($html))
        {
          echo 'html error'."\n";
          continue;
        }

        //echo $html;
        //echo $html->find('.Guest dl.FstTitle', 0)->outertext;

        $tw = '
<html>
<head>
<base href="https://twitter.com/">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link type="text/css" rel="stylesheet" href="http://platform.twitter.com/embed/timeline.037a0cac0aa5abbe2c1b5c5cd368d398.default.css">
<style type="text/css">body{display:none}</style>
<base target="_blank">
<style type="text/css">
.tweet { padding: 10px 10px 10px 10px; border-width: 0 0 1px; }
.js-timeline-title,.stream-footer,.stream-fail-container,.modal-container,.tweet-actions,.dropdown-link,.flag-container,.hidden,.cards-media-container { display:none; }
img { margin-top: 0px !important; }
</style>
</head><body>';

        foreach($html->find('#timeline') as $list) 
        {
          $tw .= $list->outertext;
          break;
        }
        
        $tw .= '
<div style="margin:10px; text-align:center;"><a href="https://twitter.com/' . $link[$i]['twitter'] . '" target="_blank">more</a></div>
</body></html>';
        //echo $tw;
        
        $html->clear();
        unset($html);

        $path = '/home/gifted/'.$this->env.'/web/twitter/'.$link[$i]['id'].'.html';
        $fp     = fopen($path, 'w');
        flock   ($fp, LOCK_EX);
        fwrite  ($fp, $tw);
        flock   ($fp, LOCK_UN);
        fclose  ($fp);
        @chmod($path, 0777);
        //exit;        
      }
    }
    
    // end
    commonUtil::outputErrLog('-------------------------  end  ---------------------------', 'Notice', true);
  }
  
}
