<?php

/**
 * 汎用ユーティリティ
 *
 *
 * @package lib
 */
class commonUtil
{
  //================================================================================================
  // ■一覧
  //================================================================================================

  /**
  * 指定されたモデルとqueryでページャーを返す
  *
  * @param string $model_name
  * @param int $list_num
  * @param int $page
  * @param Criteria $c
  * @return pager
  */
  public static function getPager($model_name, $list_num, $page, $q=null)
  {
    $pager = new sfDoctrinePager($model_name, $list_num);
    $pager->setQuery  ($q);
    $pager->setPage   ($page);
    $pager->init      ();

    return $pager;
  }

  /**
  * ページ情報取得
  *
  * @param sfPropelPager $pager
  * @param int $list_num
  */
  public static function getPagerNumber($pager, $list_num)
  {
    $array = array();
    $array['page_all'] = $pager->getNbResults();
    $array['page_cur'] = $pager->getPage();
    $array['from']     = ($array['page_all']==0) ? 0 : $list_num * ($array['page_cur'] - 1) + 1;
    $array['to']       = ($list_num * $array['page_cur'] > $array['page_all']) ? $array['page_all'] : $list_num * $array['page_cur'];

    return $array;
  }

  /**
  * 一覧絞り込み用クエリ取得
  *
  * @param sfPropelPager $pager
  * @param int $list_num
  */
  public static function getListQuery($class_name, $default_sort, $user, $q=null, $filters_flag=true, $sort_flag=true)
  {
    // 絞込み&ソート初期化
    commonUtil::processFilters  ($class_name);
    commonUtil::processSort     ($class_name);

    // 絞込み&ソート用変数取得
    $filters     = $user->getAttributeHolder()->getAll($class_name.'/filters');
    $sort_column = $user->getAttribute('sort', null, $class_name.'/sort');
    $sort_type   = $user->getAttribute('type', null, $class_name.'/sort');

    // 絞込み&ソート用query取得
    if(!$q)
    {
      $q = Doctrine_Query::create()->from ($class_name);
    }

    if($filters_flag)
    {
      $q = commonUtil::getFiltersQuery ($q, $class_name, $filters);
    }

    if($sort_flag)
    {
      $q = commonUtil::getSortQuery ($q, $class_name, $default_sort, $sort_column, $sort_type);
    }
    
    return $q;
  }

  /**
  * フィルタ用処理
  *
  * @param string $class_name
  */
  public static function processFilters($class_name)
  {
    $context = sfContext::getInstance();

    if($context->getRequest()->hasParameter('filters'))
    {
      $filters = $context->getRequest()->getParameter('filters');

      $context->getUser()->getAttributeHolder()->removeNamespace($class_name.'/filters');
      $context->getUser()->getAttributeHolder()->add($filters, $class_name.'/filters');
    }
  }

  /**
  * ソート用処理
  *
  * @param string $class_name
  */
  public static function processSort($class_name)
  {
    $context = sfContext::getInstance();

    if($context->getRequest()->getParameter('sort'))
    {
      $context->getUser()->setAttribute('sort', $context->getRequest()->getParameter('sort'),        $class_name.'/sort');
      $context->getUser()->setAttribute('type', $context->getRequest()->getParameter('type', 'asc'), $class_name.'/sort');
    }
  }

  /**
  * 絞込み用query取得
  *
  * @param Criteria $c
  * @param string $model_name
  * @param array $filter_array
  * @param array $filters
  * @return Criteria $c
  */
  public static function getFiltersQuery($q, $model_name, $filters)
  {
    foreach($filters as $key => $value)
    {
      //echo $key."=>".$value."<br>";
      
      if($value == '') continue;  
      
      if(is_array($value))
      {
        foreach($value as $key2 => $value2)
        {
          //echo $key2."=>".$value2."<br>";
          
          if($value2 != '')
          {
            $q->addWhere( $key2 .' = ?', $value2);
          }
        }
      }
      else
      {
        // like検索する項目
        $like_array = array(
          'mail','name',
        );
        if(in_array($key, $like_array))
        {
          // 姓名分割対応
          if($model_name=='Member' && $key=='name')
          {
            $str = "%".$value."%";
            $q->addWhere( 'name1 like ? OR name2 like ?', array($str, $str));
          }
          else
          {
            $q->addWhere( $key .' like ?', "%".$value."%");
          }
        }
        else
        {
          if(strpos($key,'_from')!==false && $value != '')
          {
            $q->addWhere( str_replace('_from','',$key) .' >= ?', $value);
          }
          else if(strpos($key,'_to')!==false && $value != '')
          {
            $q->addWhere( str_replace('_to','',$key) .' <= ?', $value . ' 23:59:59');
          }
          else
          {
            $q->addWhere( $key .' = ?', $value);
          }
        }

      }
    }
    //echo $q->getSqlQuery()."\n";exit;

    return $q;
  }

  /**
  * ソート用query取得
  *
  * @param Criteria $c
  * @param string $model_name
  * @param string $default_sort
  * @param string $sort_column
  * @param string $sort_type
  * @return Criteria $c
  */
  public static function getSortQuery($q, $model_name, $default_sort, $sort_column, $sort_type)
  {
    if($sort_column)
    {
      if ($sort_type == 'asc')
      {
        $q->orderBy($sort_column)
          ->orderBy($default_sort);
      }
      else
      {
        $q->orderBy($sort_column . ' desc')
          ->orderBy($default_sort . ' desc');
      }
    }
    else
    {
      $q->orderBy($default_sort . ' desc');
    }

    return $q;
  }
    
  //================================================================================================
  // ■日付関連
  //================================================================================================
  /**
   * 日付表記
   */
  public static function getYmd($date, $format='Y-m-d')
  {
    $format = ($format=='hi') ? 'Y-m-d H:i' : $format;
    return ($date) ? date($format, strtotime($date)) : '';
  }
  
  /**
   * 処理期間取得
   */
  public static function getStartEnd($span_flag, $order_date)
  {
    $ret = array();
    
    // 集計期間(１：日別　２：月別　３：年別)
    switch($span_flag)
    {
      case sfConfig::get('app_span_flag_day'):
        $ret['start']  =  $order_date . ' '.sfConfig::get('app_day_start_time');
        $ret['end']    =  $order_date . ' '.sfConfig::get('app_day_end_time');
        break;
      case sfConfig::get('app_span_flag_month'):
        $ret['start']  =  date("Y-m-01", strtotime($order_date)) . ' '.sfConfig::get('app_day_start_time');
//      $ret['end']    =  date('Y-m-t',  strtotime($order_date)) . ' '.sfConfig::get('app_day_end_time'); // 月末
        $ret['end']    =  $order_date . ' '.sfConfig::get('app_day_end_time');
        break;
      case sfConfig::get('app_span_flag_year'):
        $ret['start']  =  date("Y-01-01",  strtotime($order_date)) . ' '.sfConfig::get('app_day_start_time');
//      $ret['end']    =  date('Y-12-31',  strtotime($order_date)) . ' '.sfConfig::get('app_day_end_time'); // 年末
        $ret['end']    =  $order_date . ' '.sfConfig::get('app_day_end_time');
        break;
      default:
        $ret['start']  =  $order_date . ' '.sfConfig::get('app_day_start_time');
        $ret['end']    =  $order_date . ' '.sfConfig::get('app_day_end_time');
        break;
    }
    
    return $ret;
  }
  
  /**
   * 期間取得(絞り込み用不足情報付加)
   */
  public static function getSpan($span_flag, $target_span, $from, $to)
  {
    $ret = array();

    if($span_flag==sfConfig::get('app_span_flag_day'))
    {
      if(!$from && !$to)
      {
        $ret['from']  =  date("Y-m-01", strtotime($target_span));
        $ret['to']    =  date("Y-m-t",  strtotime($target_span));
      }
      else
      {
        if($from && $to)
        {
          $ret['from'] = date("Y-m-d", strtotime($from));  
          $ret['to']   = date("Y-m-d", strtotime($to));  
        }
        elseif($from)
        {
          $ret['from'] = date("Y-m-d", strtotime($from));  
          $ret['to']   = date("Y-m-d", strtotime("+1 month",  strtotime($from)));
        }
        else
        {
          $ret['from'] = date("Y-m", strtotime("-1 month",  strtotime($to)));
          $ret['to']   = date("Y-m-d", strtotime($to));  
        }
      }
    }
    elseif($span_flag==sfConfig::get('app_span_flag_month'))
    {
      if(!$from && !$to)
      {
        $ret['from']  =  date("Y-m", strtotime("-12 month", strtotime($target_span)));
        $ret['to']    =  date("Y-m", strtotime("-0 month",  strtotime($target_span)));
      }
      else
      {
        if($from && $to)
        {
          $ret['from'] = date('Y-m', strtotime($from));  
          $ret['to']   = date('Y-m', strtotime($to));  
        }
        elseif($from)
        {
          $ret['from'] = date('Y-m', strtotime($from));  
          $ret['to']   = date("Y-m", strtotime("+12 month",  strtotime($from)));
        }
        else
        {
          $ret['from'] = date("Y-m", strtotime("-12 month",  strtotime($to)));
          $ret['to']   = date('Y-m', strtotime($to));  
        }
      }
    }
    else
    {
      if(!$from && !$to)
      {
        $ret['from']  =  date("Y", strtotime("-10 year", strtotime($target_span)));
        $ret['to']    =  date("Y", strtotime("-0 year",  strtotime($target_span)));
      }
      else
      {
        if($from && $to)
        {
          $ret['from'] = date('Y', strtotime($from));  
          $ret['to']   = date('Y', strtotime($to));  
        }
        elseif($from)
        {
          $ret['from'] = date('Y', strtotime($from));  
          $ret['to']   = date("Y", strtotime("+10 year",  strtotime($from)));
        }
        else
        {
          $ret['from'] = date("Y", strtotime("-10 year",  strtotime($to)));
          $ret['to']   = date('Y', strtotime($to));  
        }
      }
    }
    
    return $ret;
  }

  /**
   * 基準日取得
   */
  public static function getSpanDate($span_flag, $order_date)
  {
    // 集計期間(１：日別　２：月別　３：年別)
    switch($span_flag)
    {
      case sfConfig::get('app_span_flag_day'):
        $day  =  date("Y-m-d",  strtotime($order_date));
        break;
      case sfConfig::get('app_span_flag_month'):
        $day  =  date("Y-m",    strtotime($order_date));
        break;      
      case sfConfig::get('app_span_flag_year'):
        $day  =  substr($order_date,"0","4"); // date('Y')だと期待した年が返らない
        break;
      default:
        $day  =  date("Y-m-d",  strtotime($order_date));
        break;
    }
    
    return $day;
  }

  /**
   * 日付配列初期化（売上）
   */
  public static function initSpan($span_flag, $summary_type, $from, $to)
  {
    $data_array = array();

    $price_array        = Doctrine_Core::getTable('Product')->getPriceList();
    $summary_type_array = sfConfig::get('app_summary_type_array');
    $product_type_array = sfConfig::get('app_product_type_array');
//    echo "<pre>"; print_r($price_array); echo "</pre>"; exit;

    if($summary_type==sfConfig::get('app_summary_type_product')||$summary_type==sfConfig::get('app_summary_type_purchase'))
    {
      // 配列初期化（VIEWで配列未定義エラーが出ないようにするため）
      // target_id
      foreach($product_type_array as $target_id => $product_type)
      {
        if(! isset($price_array[$summary_type][$target_id])) continue;
        
        // price
        foreach($price_array[$summary_type][$target_id] as $no => $price)
        {
          // 日付
          if($span_flag==sfConfig::get('app_span_flag_day'))
          {
            for($n = 0; $n < sfConfig::get('app_span_max_day'); $n++)
            {
              // 当月の日付を全て0で埋める
              $date     = date("Y-m-d", strtotime("+".$n." day", strtotime($from)));
              if($date > $to) break;

              // 初期化
              $data_array[$date][$summary_type][$target_id][$price] = '0';
              $data_array[$date][$summary_type][$target_id][sfConfig::get('app_summary_total_price')]  = '0';
              $data_array[$date][$summary_type][sfConfig::get('app_summary_total_product_id')][sfConfig::get('app_summary_total_price')] = '0';
            }
          }
          elseif($span_flag==sfConfig::get('app_span_flag_month'))
          {
            for($n = 0; $n <= sfConfig::get('app_span_max_month'); $n++)
            {
              $date = date("Y-m", strtotime("+".$n." month", strtotime($from)));
              if($date > $to) break;

              $data_array[$date][$summary_type][$target_id][$price] = '0';
              $data_array[$date][$summary_type][$target_id][sfConfig::get('app_summary_total_price')]  = '0';
              $data_array[$date][$summary_type][sfConfig::get('app_summary_total_product_id')][sfConfig::get('app_summary_total_price')] = '0';
            }
          }
          elseif($span_flag==sfConfig::get('app_span_flag_year'))
          {
            for($n = 0; $n <= sfConfig::get('app_span_max_year'); $n++)
            {
              $date = date("Y", strtotime("+".$n." year", strtotime($from.'-01-01')));
              if($date > $to) break;

              $data_array[$date][$summary_type][$target_id][$price] = '0';
              $data_array[$date][$summary_type][$target_id][sfConfig::get('app_summary_total_price')]  = '0';
              $data_array[$date][$summary_type][sfConfig::get('app_summary_total_product_id')][sfConfig::get('app_summary_total_price')] = '0';
            }
          }
        }
      }
    }
    else
    {
      // 日付
      if($span_flag==sfConfig::get('app_span_flag_day'))
      {
        for($n = 0; $n < sfConfig::get('app_span_max_day'); $n++)
        {
          // 当月の日付を全て0で埋める
          $date     = date("Y-m-d", strtotime("+".$n." day", strtotime($from)));
          if($date > $to) break;

          // 初期化
          $data_array[$date][$summary_type]['0'][sfConfig::get('app_summary_total_price')]  = '0';
          $data_array[$date][$summary_type][sfConfig::get('app_summary_total_product_id')][sfConfig::get('app_summary_total_price')] = '0';
        }
      }
      elseif($span_flag==sfConfig::get('app_span_flag_month'))
      {
        for($n = 0; $n <= sfConfig::get('app_span_max_month'); $n++)
        {
          $date = date("Y-m", strtotime("+".$n." month", strtotime($from)));
          if($date > $to) break;

          $data_array[$date][$summary_type]['0'][sfConfig::get('app_summary_total_price')]  = '0';
          $data_array[$date][$summary_type][sfConfig::get('app_summary_total_product_id')][sfConfig::get('app_summary_total_price')] = '0';
        }
      }
      elseif($span_flag==sfConfig::get('app_span_flag_year'))
      {
        for($n = 0; $n <= sfConfig::get('app_span_max_year'); $n++)
        {
          $date = date("Y", strtotime("+".$n." year", strtotime($from.'-01-01')));
          if($date > $to) break;

          $data_array[$date][$summary_type]['0'][sfConfig::get('app_summary_total_price')]  = '0';
          $data_array[$date][$summary_type][sfConfig::get('app_summary_total_product_id')][sfConfig::get('app_summary_total_price')] = '0';
        }
      }
    }

    return $data_array;
  }

  /**
   * 日付配列初期化（ポイント）
   */
  public static function initSpanPoint($span_flag, $from, $to)
  {
    $data_array = array();

    $pointdata_type_array       = sfConfig::get('app_pointdata_type_flag_array');
    $pointdata_target_id_array  = sfConfig::get('app_pointdata_target_id_array');
    
    // 配列初期化（VIEWで配列未定義エラーが出ないようにするため）
    // pointdata_type
    foreach($pointdata_type_array as $type_id => $type)
    {
      // 日付
      if($span_flag==sfConfig::get('app_span_flag_day'))
      {
        for($n = 0; $n < sfConfig::get('app_span_max_day'); $n++)
        {
          $date     = date("Y-m-d", strtotime("+".$n." day", strtotime($from)));
          if($date > $to) break;

          if($type_id==sfConfig::get('app_pointdata_type_flag_issue'))
          {
            foreach($pointdata_target_id_array as $id => $value)
            {
              $data_array[$date][$type_id][$id] = '0';
            }
          }
          else
          {
            $data_array[$date][$type_id][sfConfig::get('app_pointdata_target_id_all')] = '0';
          }
        }
      }
      elseif($span_flag==sfConfig::get('app_span_flag_month'))
      {
        for($n = 0; $n <= sfConfig::get('app_span_max_month'); $n++)
        {
          $date = date("Y-m", strtotime("+".$n." month", strtotime($from)));
          if($date > $to) break;

          if($type_id==sfConfig::get('app_pointdata_type_flag_issue'))
          {
            foreach($pointdata_target_id_array as $id => $value)
            {
              $data_array[$date][$type_id][$id] = '0';
            }
          }
          else
          {
            $data_array[$date][$type_id][sfConfig::get('app_pointdata_target_id_all')] = '0';
          }
        }
      }
      elseif($span_flag==sfConfig::get('app_span_flag_year'))
      {
        for($n = 0; $n <= sfConfig::get('app_span_max_year'); $n++)
        {
          $date = date("Y", strtotime("+".$n." year", strtotime($from.'-01-01')));
          if($date > $to) break;

          if($type_id==sfConfig::get('app_pointdata_type_flag_issue'))
          {
            foreach($pointdata_target_id_array as $id => $value)
            {
              $data_array[$date][$type_id][$id] = '0';
            }
          }
          else
          {
            $data_array[$date][$type_id][sfConfig::get('app_pointdata_target_id_all')] = '0';
          }
        }
      }
    }

    return $data_array;
  }
  
  //================================================================================================
  // ■ランク関連
  //================================================================================================
 /**
  * ランク判定用日付取得
  */
  public static function getRankDate($target_date)
  {
    $ret_array = array();
    
    // 集計開始：3か月前:26日：00:00 ～ 集計終了：今月:25日：23:59
    $ret_array['sum_from_date']  = date('Y-m-26 00:00:00', strtotime("-3 month", strtotime($target_date)));
    $ret_array['sum_to_date']    = date('Y-m-25 23:59:59', strtotime("-0 month", strtotime($target_date)));

    // 適用開始：来月1日0時 ～ 適用終了：来月末23:59
    $ret_array['from_date']  = date('Y-m-01 00:00:00', strtotime("+1 month", strtotime($target_date)));
    $ret_array['to_date']    = date('Y-m-t 23:59:59',  strtotime("+1 month", strtotime($target_date)));
    
    return $ret_array;
  }

 /**
  * ランク判定
  */
  public static function checkRank($orders_total, $orders_type)
  {
    /*
      ■レギュラー
      とくに限定されない
      ■シルバー
      過去3ヶ月で10,000円以上の購入
      ■ゴールド
      過去3ヶ月で30,000円以上の購入　且つ　2券種以上の購入
    */  
    if($orders_total >= sfConfig::get('app_rank_condition_plutinum_amount'))
    {
      if($orders_type >= sfConfig::get('app_rank_condition_plutinum_type'))
      {
        $rank = sfConfig::get('app_rank_plutinum');
      }
      else
      {
        $rank = sfConfig::get('app_rank_gold');
      }
    }
    elseif($orders_total >= sfConfig::get('app_rank_condition_gold_amount'))
    {
      if($orders_type >= sfConfig::get('app_rank_condition_gold_type'))
      {
        $rank = sfConfig::get('app_rank_gold');
      }
      else
      {
        $rank = sfConfig::get('app_rank_silver');
      }
    }
    elseif($orders_total >= sfConfig::get('app_rank_condition_silver_amount'))
    {
      $rank = sfConfig::get('app_rank_silver');
    }
    else
    {
      $rank = sfConfig::get('app_rank_regular');
    }
    
    return $rank;
  }

 /**
  * ランクUP＆ダウン条件
  */
  public static function getRankCondition($rank_date, $new_rank, $cur_rank, $orders_total, $orders_type)
  {
    /*
      例：現在シルバーの会員にゴールドになるための条件表示
      ■12月31日までにあと○○円の購入を行うと1月1日からゴールド会員です！

      例：現在シルバー会員にランクをキープするための条件表示
      ■12月31日までにあと○○円以上の購入が無い場合、1月1日からシルバー会員にランクダウンします。

      ーーーーーーーーーーーーーーーーーーーーーーーーーーーー
      ノーマル会員：シルバーにランクアップするための条件を表示
      シルバー会員で次月もシルバー確定：ゴールド会員になるための条件表示
      シルバー会員で次月のシルバーは確定：シルバー会員をキープするための条件表示
      ゴールド会員で次月のゴールドは未確定：ゴールド会員をキープするための条件表示
      ーーーーーーーーーーーーーーーーーーーーーーーーーーーー
    */
    $to_date    = date("m月d日", strtotime($rank_date['sum_to_date']));
    $from_date  = date("n月j日", strtotime($rank_date['from_date']));
    
    $condition  = array();
    
    switch($cur_rank)
    {
      case sfConfig::get('app_rank_regular'):
        if($new_rank == sfConfig::get('app_rank_regular'))
        {
          $condition['up']   = $to_date.'までにあと'.(sfConfig::get('app_rank_condition_silver_amount') - $orders_total).'円の購入を行うと'.$from_date.'からシルバー会員です！';
          $condition['down'] = ''; // これ以上下がらない
        }
        elseif($new_rank == sfConfig::get('app_rank_silver'))
        {
          $condition['up']   = $to_date.'までにあと'.(sfConfig::get('app_rank_condition_gold_amount') - $orders_total).'円の購入を行うと'.$from_date.'からゴールド会員です！';
          $condition['down'] = ''; // これ以上下がらない
        }
        elseif($new_rank == sfConfig::get('app_rank_gold'))
        {
          $condition['up']   = $to_date.'までにあと'.(sfConfig::get('app_rank_condition_plutinum_amount') - $orders_total).'円の購入を行うと'.$from_date.'からプラチナ会員です！';
          $condition['down'] = ''; // これ以上下がらない
        }
        else
        {
          $condition['up']   = ''; // これ以上なし
          $condition['down'] = ''; // これ以上下がらない
        }
        break;

      case sfConfig::get('app_rank_silver'):
        if($new_rank == sfConfig::get('app_rank_regular'))
        {
          $condition['up']   = ''; // 現状維持が先決
          $condition['down'] = $to_date.'までにあと'.(sfConfig::get('app_rank_condition_silver_amount') - $orders_total).'円以上の購入が無い場合、'.$from_date.'からレギュラー会員にランクダウンします';
        }
        elseif($new_rank == sfConfig::get('app_rank_silver'))
        {
          $condition['up']   = $to_date.'までにあと'.(sfConfig::get('app_rank_condition_gold_amount') - $orders_total).'円の購入を行うと'.$from_date.'からゴールド会員です！';
          $condition['down'] = ''; // 現状維持は確保
        }
        elseif($new_rank == sfConfig::get('app_rank_gold'))
        {
          $condition['up']   = $to_date.'までにあと'.(sfConfig::get('app_rank_condition_plutinum_amount') - $orders_total).'円の購入を行うと'.$from_date.'からプラチナ会員です！';
          $condition['down'] = ''; // 現状維持は確保
        }
        else
        {
          $condition['up']   = ''; // これ以上なし
          $condition['down'] = ''; // 現状維持は確保
        }
        break;
      
      case sfConfig::get('app_rank_gold'):
        if($new_rank == sfConfig::get('app_rank_regular'))
        {
          $condition['up']   = ''; // 現状維持が先決
          $condition['down'] = $to_date.'までにあと'.(sfConfig::get('app_rank_condition_silver_amount') - $orders_total).'円以上の購入が無い場合、'.$from_date.'からレギュラー会員にランクダウンします';
        }
        elseif($new_rank == sfConfig::get('app_rank_silver'))
        {
          $condition['up']   = ''; // 現状維持が先決
          $condition['down'] = $to_date.'までにあと'.(sfConfig::get('app_rank_condition_silver_amount') - $orders_total).'円以上の購入が無い場合、'.$from_date.'からシルバー会員にランクダウンします';
        }
        elseif($new_rank == sfConfig::get('app_rank_gold'))
        {
          $condition['up']   = $to_date.'までにあと'.(sfConfig::get('app_rank_condition_plutinum_amount') - $orders_total).'円の購入を行うと'.$from_date.'からプラチナ会員です！';
          $condition['down'] = ''; // 現状維持は確保
        }
        else
        {
          $condition['up']   = ''; // これ以上なし
          $condition['down'] = ''; // 現状維持は確保
        }
        break;

      case sfConfig::get('app_rank_plutinum'):
        if($new_rank == sfConfig::get('app_rank_regular'))
        {
          $condition['up']   = ''; // 現状維持が先決
          $condition['down'] = $to_date.'までにあと'.(sfConfig::get('app_rank_condition_silver_amount') - $orders_total).'円以上の購入が無い場合、'.$from_date.'からレギュラー会員にランクダウンします';
        }
        elseif($new_rank == sfConfig::get('app_rank_silver'))
        {
          $condition['up']   = ''; // 現状維持が先決
          $condition['down'] = $to_date.'までにあと'.(sfConfig::get('app_rank_condition_gold_amount') - $orders_total).'円以上の購入が無い場合、'.$from_date.'からシルバー会員にランクダウンします';
        }
        elseif($new_rank == sfConfig::get('app_rank_gold'))
        {
          $condition['up']   = ''; // 現状維持が先決
          $condition['down'] = $to_date.'までにあと'.(sfConfig::get('app_rank_condition_plutinum_amount') - $orders_total).'円以上の購入が無い場合、'.$from_date.'からゴールド会員にランクダウンします';
        }
        else
        {
          $condition['up']   = ''; // これ以上なし
          $condition['down'] = ''; // 現状維持は確保
        }
        break;
      }
      
      return $condition;
    }
  
  //================================================================================================
  // ■表示系
  //================================================================================================
  /**
  * 商品カテゴリ名取得（金額以降を削除）Amazonギフト券 10000⇒Amazonギフト券
  */
  public static function getCategoryName($product_name)
  {
    $len = mb_strlen($product_name);
    $pos = mb_strrpos($product_name, " ");
    return mb_substr($product_name, 0, $pos);
  }
  
  /**
  * パス配列取得
  *
  * @param boolean $list_flag リスト⇒詳細リンクの場合、link/2009を取る
  * @return array
  */
  public static function getPathArray($list_flag=false)
  {
    $context = sfContext::getInstance();

    // URL解析
    $path = substr($context->getRequest()->getPathInfo(), 1);  // 先頭の/を取る
    $path = rtrim($path, "/"); // 最後の/を取る（最後に配列が空でできてしまうため）

    // URLを配列に分解
    $path_array = explode('/', $path);

    $list_del_flag = false;

    foreach ($path_array as $key => $value)
    {
      // プレビュー時にお尻に付く？を取る
      $path_array[$key] = str_replace('?','',$value);

      // list/2009とlist/で終わる場合もある
      // ループ中でarray_popしても末尾が削除されない
      if($list_flag && $value=='list' && $key!=(count($path_array)-1))
      {
        //        array_splice($path_array, $key, 1);
        $list_del_flag = true;
      }
    }

    // list/2009を取る＆/tips/addressbook/は取らない
    if($list_del_flag)
    {
      array_pop($path_array);
      array_pop($path_array);
    }

    return $path_array;
  }

  /**
  * パス取得
  *
  * @param boolean $list_flag リスト⇒詳細リンクの場合、link/2009を取る
  * @return array
  */
  public static function getHeaderPath($list_flag=false)
  {
    // URL取得
    $path_array     = commonUtil::getPathArray($list_flag);

    // /association/journal/list/ & /association/journal/1047の場合
    if(end($path_array)=='list' || is_numeric(end($path_array)))
    {
      array_pop($path_array);
    }

    $url = implode('/', $path_array);
    $pos = strpos($url, '/');

    $res = ($pos === false) ? $url : substr($url, 0, $pos);

    // グローバルカテゴリ配列取得
    $global_category_array     = sfConfig::get('app_global_category_array');

    $res = (!in_array($res, $global_category_array)) ? 'other' : $res;

    return $res;
  }

  /**
   * 宮崎県⇒宮崎
   *
   * @param string $str
   * @return string
   */
  public static function strip_todohuken($str)
  {
    $str = str_replace('都','',$str);
    $str = str_replace('府','',$str);
    $str = str_replace('県','',$str);

    return $str;
  }

  //================================================================================================
  // ■メタ情報
  //================================================================================================

  /**
  * メタ情報設定
  *
  * @param string $category_name
  * @return string $category_name
  */
  public static function setMeta($category_name)
  {
    $context = sfContext::getInstance();

    $title = '';

    if($category_name != sfConfig::get('app_general_top_name') && isset($category_name))
    {
      $title = $category_name;
    }

    $title       .= !$title ? '' : sfConfig::get('app_meta_separater');
    $title       .= sfConfig::get('app_meta_title');

    $description  = sfConfig::get('app_meta_description');
    $keywords     = sfConfig::get('app_meta_keywords');

    $description  .= ! $category_name ? null: ', '.$category_name;
    $keywords     .= ! $category_name ? null: ', '.$category_name;

    $context->getResponse()->setTitle($title);
    $context->getResponse()->addMeta('description',  $description);
    $context->getResponse()->addMeta('keywords',     $keywords);
  }

  //================================================================================================
  // ■権限
  //================================================================================================

  /**
  * スーパーユーザ判定(管理画面用)
  *
  * @return bool true:スーパーユーザ
  */
  public static function isSuperUser()
  {
    $context = sfContext::getInstance();

    $credentials_array = $context->getUser()->listCredentials();

    return in_array(sfConfig::get('app_sf_guard_admin'), $credentials_array);
  }

  //================================================================================================
  // ■その他
  //================================================================================================
  /**
   * フォームフレームワークで自動生成されたラジオボタンを横並びに変換
   *
   * @param string $form_str
   * @return string
   */
  public static function strip_li_tag($form_str)
  {
    $form_str = str_replace('<li>','',$form_str);
    $form_str = str_replace('</li>','　',$form_str);
    $form_str = str_replace('<ul class="radio_list">','',$form_str);
    $form_str = str_replace('</ul>','',$form_str);

    return $form_str;
  }

  public static function strip_li_tag2($form_str)
  {
    $form_str = str_replace('<label for="Edit_mail_flag_1">','',$form_str);
    $form_str = str_replace('<label for="Edit_mail_flag_0">','',$form_str);
    $form_str = str_replace('</label>','',$form_str);

    return CommonUtil::strip_li_tag($form_str);
  }
  
  public static function strip_li_tag3($form_str, $for)
  {
    $form_str = str_replace('<label for="'.$for.'_0">','',$form_str);
    $form_str = str_replace('<label for="'.$for.'_1">','',$form_str);
    $form_str = str_replace('<label for="'.$for.'_2">','',$form_str);
    $form_str = str_replace('<label for="'.$for.'_3">','',$form_str);
    $form_str = str_replace('</label>','',$form_str);

    return CommonUtil::strip_li_tag($form_str);
  }
  
  public static function strip_li_tag4($form_str, $for)
  {
    $form_str = str_replace('</label>','<br />',$form_str);
    $form_str = str_replace('&nbsp;', '',$form_str);

    return CommonUtil::strip_li_tag3($form_str, $for);
  }

  public static function replace_li_tag($form_str)
  {
    $form_str = str_replace('<li>','<span>',$form_str);
    $form_str = str_replace('</li>','</span>',$form_str);
    $form_str = str_replace('<ul class="error_list">','',$form_str);
    $form_str = str_replace('</ul>','',$form_str);
  
    if($form_str)  $form_str .= '<br>';
    return $form_str;
  }

  /**
  * 配列内の半角を全角に
  *
  * @param int $length パスワードの長さ
  * @return string 発行されたパスワード
  */
  public static function recursive_mb_convert_kana($param, $option='KV')
  {
    if (is_array($param))
    {
      foreach ($param as $k => $v)
      {
        $param[$k] = commonUtil::recursive_mb_convert_kana($v, $option);
      }
    }
    else
    {
      $param = mb_convert_kana($param, $option, 'utf-8');
    }

    return $param;
  }

  /**
  * 配列内の文字コードを変換
  */
  public static function recursive_mb_convert_encoding($param, $to_encoding, $from_encoding='auto')
  {
    if (is_array($param))
    {
      foreach ($param as $k => $v)
      {
        $param[$k] = commonUtil::recursive_mb_convert_encoding($v, $to_encoding, $from_encoding);
      }
    }
    else
    {
      $param = mb_convert_encoding($param, $to_encoding, $from_encoding);
    }

    return $param;
  }

  /**
  * ランダムパスワード発行
  *
  * @param int $length パスワードの長さ
  * @return string 発行されたパスワード
  */
  public static function getPassword($length)
  {
    // 乱数表のシードを決定
    srand((double)microtime() * 54234853);

    // パスワード文字列の配列を作成
    $pwelemstr = "abcdefghkmnpqrstuvwyzABCDEFGHJKLMNPQRSTUVWXYZ2345679";
    $pwelem = preg_split("//", $pwelemstr, 0, PREG_SPLIT_NO_EMPTY);

    $password = "";

    for($i=0; $i<$length; $i++ )
    {
      // パスワード文字列を生成
      $password .= $pwelem[array_rand($pwelem, 1)];
    }

    return $password;
  }

  /**
  * 数値桁数調整(電話番号で03→3になってしまうため)
  * helperに入れていたが、モデルから呼び出した時に見つけられなかったため
  * こちらに移動
  *
  * @param string $num  数字
  * @param int $count   桁数
  * @return string
  */
  public static function formatNumber($num, $count)
  {
    return !$num ? '' : sprintf('%0'.$count.'d', $num);
  }

  /**
  * 市外局番調整（03, 092, 0829）
  *
  * @param string $sigai
  * @return string
  */
  public static function formatSigaiNumber($sigai)
  {
    $sigai = commonUtil::formatNumber($sigai,4);  // 03   --> 0003
    $sigai = str_replace('000','0',$sigai);       // 0003 -->   03
    $sigai = str_replace('00', '0',$sigai);       // 0092 -->  092
    return $sigai;
  }

  /**
  * 電話番号調整（03-5822-5515, 092-911-0777, 0829-36-5555）
  *
  * @param string $tel
  * @return string
  */
  public static function formatTelNumber($tel)
  {
    $tel = commonUtil::formatNumber($tel,4);                  // 36   --> 0036, 911 --> 0911
    $tel = substr($tel, 0, 2)=='00' ? substr($tel, 2) : $tel; // 0036 -->   36
    $tel = substr($tel, 0, 1)=='0'  ? substr($tel, 1) : $tel; // 0911 -->  911
    return $tel;
  }

  /**
  * 電話番号調整
  *
  * @param string $tel1
  * @param string $tel2
  * @param string $tel3
  * @return string
  */
  public static function formatTelephoneNumber($tel1, $tel2, $tel3)
  {
    $tel1 = commonUtil::formatSigaiNumber($tel1);
    $tel2 = commonUtil::formatTelNumber($tel2);
    $tel3 = commonUtil::formatNumber($tel3, 4);

    return $tel1.'-'.$tel2.'-'.$tel3;
  }

  /**
  * 年齢取得
  * http://itpro.nikkeibp.co.jp/article/Watcher/20070822/280097/
  * (今日の日付-誕生日)/10000の小数点以下切捨て
  *
  * @param SContact
  * @return string
  */
  public static function getAge($obj)
  {
    if(!$obj) return null;

    $birthday = $obj->getBirthday();
    $age      = $obj->getAge();

    // 年齢が登録されていたら、問合せ時点での年齢ということでそちらを返却
    if($age > 0)
    {
      return $age;
    }
    else
    {
      if($birthday)
      {
        // 誕生日から計算
        $birthday = str_replace('-','',$birthday);
        $today    = date('Ymd');

        return (int)(($today - $birthday)/10000);
      }
    }

    return null;
  }
  
  public static function getAgeByBirthday($birthday)
  {
    if(!$birthday) return null;

    // 誕生日から計算
    $birthday = str_replace('-','',$birthday);
    $today    = date('Ymd');

    return (int)(($today - $birthday)/10000);
  }

  /**
  * 拗音、促音を大文字に変換
  *
  * @param string $org
  * @return string
  */
  public static function getLargeChar($org)
  {
    // ァィゥェォャュョッ --> アイウエオヤユヨツ
    $new = mb_ereg_replace('ァ', 'ア', $org);
    $new = mb_ereg_replace('ィ', 'イ', $new);
    $new = mb_ereg_replace('ゥ', 'ウ', $new);
    $new = mb_ereg_replace('ェ', 'エ', $new);
    $new = mb_ereg_replace('ォ', 'オ', $new);
    $new = mb_ereg_replace('ャ', 'ヤ', $new);
    $new = mb_ereg_replace('ュ', 'ユ', $new);
    $new = mb_ereg_replace('ョ', 'ヨ', $new);
    $new = mb_ereg_replace('ッ', 'ツ', $new);

    $new = commonUtil::trimSpace($new);

    return $new;
  }

  /**
  * 前後の全半角スペース削除
  *
  * @param string $string
  * @return string
  */
  public static function trimSpace($string)
  {
    return trim(mb_convert_kana($string, 's', 'utf-8'));
  }

  /**
  * 機種依存文字変換
  *
  * @param string $str
  * @return string
  */
  public static function convertKisyu($str)
  {
    $new = $str;

    $kisyu_array = array(
        '①' => '(1)',
        '②' => '(2)',
        '③' => '(3)',
        '④' => '(4)',
        '⑤' => '(5)',
        '⑥' => '(6)',
        '⑦' => '(7)',
        '⑧' => '(8)',
        '⑨' => '(9)',
        '⑩' => '(10)',
        '⑪' => '(11)',
        '⑫' => '(12)',
        '⑬' => '(13)',
        '⑭' => '(14)',
        '⑮' => '(15)',
        '⑯' => '(16)',
        '⑰' => '(17)',
        '⑱' => '(18)',
        '⑲' => '(19)',
        '⑳' => '(20)',
        'Ⅰ' => '1',
        'Ⅱ' => '2',
        'Ⅲ' => '3',
        'Ⅳ' => '4',
        'Ⅴ' => '5',
        'Ⅵ' => '6',
        'Ⅶ' => '7',
        'Ⅷ' => '8',
        'Ⅸ' => '9',
        'Ⅹ' => '10',
        'ⅰ' => '1',
        'ⅱ' => '2',
        'ⅲ' => '3',
        'ⅳ' => '4',
        'ⅴ' => '5',
        'ⅵ' => '6',
        'ⅶ' => '7',
        'ⅷ' => '8',
        'ⅸ' => '9',
        'ⅹ' => '10',
        '㈱' => '(株)',
        '㈲' => '(有)',
        '㈹' => '(代)',
        '№' => 'No.',
        '㏍' => 'K.K.',
        '℡' => 'TEL',
        '㊤' => '(上)',
        '㊥' => '(中)',
        '㊦' => '(下)',
        '㊧' => '(左)',
        '㊨' => '(右)',
        '㍾' => '明治',
        '㍽' => '大正',
        '㍼' => '昭和',
        '㍻' => '平成',
        '㎜' => 'mm',
        '㎝' => 'cm',
        '㎞' => 'km',
        '㎎' => 'mg',
        '㎏' => 'kg',
        '㏄' => 'cc',
        '㍉' => 'ミリ',
        '㌔' => 'キロ',
        '㌢' => 'センチ',
        '㍍' => 'メートル',
        '㌘' => 'グラム',
        '㌧' => 'トン',
        '㌃' => 'アール',
        '㌶' => 'ヘクタール',
        '㍑' => 'リットル',
        '㍗' => 'ワット',
        '㌍' => 'カロリー',
        '㌦' => 'ドル',
        '㌣' => 'セント',
        '㌫' => 'パーセント',
        '㍊' => 'ミリ',
        '㌻' => 'ページ',
        // 文字実体参照デコード
        // http://www.ne.jp/asahi/minazuki/bakera/html/reference/charref
        '“' => '"',
        '”' => '"',
        '‘' => "'",
        '’' => "'",
        '‚ ' => ',',
    );
    mb_regex_encoding('UTF-8');
    foreach($kisyu_array as $key => $value)
    {
      $new = mb_ereg_replace($key, $value, $new);
    }

    return $new;
  }

  /**
  * ログ出力
  *
  * @param string $msg
  * @return string
  */
  public static function outputLog($msg)
  {
    $today = date('Y/m/d H:i:s');
    $fp = fopen(sfConfig::get('sf_log_dir').'/sendMail.log', 'a+');
    flock($fp, LOCK_EX);
    fwrite($fp, $today.','.$msg."\n");
    flock($fp, LOCK_UN);
    fclose($fp);
  }

  /**
  * 画像(プロジェクト用)パス取得
  *
  * @param string $project_id
  * @return string
  */
  public static function getProjectImg($project_id)
  {
    $project_dir = sfConfig::get('app_dir_home_dir')."web/uploads/project/";
    if(file_exists($project_dir.$project_id.".jpg"))
    {
      return str_replace( sfConfig::get('app_img_url_http'), sfConfig::get('app_img_url_replace'), sfConfig::get('app_url_home') )."/uploads/project/".$project_id.".jpg";
    }
    elseif (file_exists($project_dir.$project_id.".png"))
    {
      return str_replace( sfConfig::get('app_img_url_http'), sfConfig::get('app_img_url_replace'), sfConfig::get('app_url_home') )."/uploads/project/".$project_id.".png";
    }
    elseif (file_exists($project_dir.$project_id.".gif"))
    {
      return str_replace( sfConfig::get('app_img_url_http'), sfConfig::get('app_img_url_replace'), sfConfig::get('app_url_home') )."/uploads/project/".$project_id.".gif";
    }
    else
    {
      return false;
    }
  }
  /**
  * 画像(プロジェクト用サムネイル)パス取得
  *
  * @param string $project_id
  * @return string
  */
  public static function getProjectThum($project_id, $thumbnail_flag = false)
  {
    // S3対応
    if($thumbnail_flag)
    {
      return str_replace( sfConfig::get('app_img_url_http'), sfConfig::get('app_img_url_replace'), sfConfig::get('app_aws_s3_url')).'project/'.$project_id.'_thumb.png';
    }
    else
    {
      return str_replace( sfConfig::get('app_img_url_http'), sfConfig::get('app_img_url_replace'), sfConfig::get('app_aws_s3_url')).'project/'.$project_id.'.png';
    }
  }
  /**
  * 画像(プロフィール用)パス取得
  *
  * @param string $member_id
  * @return string
  */
  public static function getMemberThum($kind=1,$img_url="",$fb_img_url="",$tw_img_url="")
  {
    // profile
    if($kind==1)
    {
      // S3にファイルの存在確認をしない。
      if($img_url=="")
      {
        return str_replace( sfConfig::get('app_img_url_http'), sfConfig::get('app_img_url_replace'), sfConfig::get('app_url_home') )."/images/no_member.png";
      }
      else
      {
        //return str_replace( sfConfig::get('app_img_url_http'), sfConfig::get('app_img_url_replace'), sfConfig::get('app_aws_s3_url')).'member/'.$img_url.'?'.time();
        return str_replace( sfConfig::get('app_img_url_http'), sfConfig::get('app_img_url_replace'), sfConfig::get('app_aws_s3_url')).'member/'.$img_url;
      }

    }
    // facebook
    elseif($kind==2)
    {
      return str_replace( sfConfig::get('app_img_url_http'), sfConfig::get('app_img_url_replace'),$fb_img_url);
    }
    // twitter
    elseif($kind==3)
    {
      return str_replace( sfConfig::get('app_img_url_http'), sfConfig::get('app_img_url_replace'),$tw_img_url);
    }
  }

  /**
   * member_idから画像を取得
   *
   * @param string $member_id
   * @return string
   */
  public static function getMemberidThum($member_id)
  {

    // トークン生成
    $member           = Member::getMemberDetail($member_id);
    if(!isset($member['id']) || !$member['id']){
      return false;
    }
    else
    {
      return commonUtil::getMemberThum($member['icon_status'],$member['img_url'],$member['fb_img_url'],$member['tw_img_url']);
    }

  }

  /**
  * ワンタイムトークンの生成
  *
  * @param string $member_id
  * @return string
  */
  public static function create_token()
  {

    // トークン生成
    $token = md5( uniqid(mt_rand(),true) );

    return $token;

  }

  /**
  * 達成率コメント
  *
  * @param string $prefecture_id 都道府県ID
  * @param string $achieve       達成率
  * @return string
  */
  public static function getAchieveComment($prefecture_id,$achieve=0,$status)
  {
    $achieve_array = sfConfig::get('app_project_achieve_'.$prefecture_id);
    $x=1;
    if (is_array($achieve_array)) {
      foreach($achieve_array as $value)
      {
        $project_achieve_array[$x] = $value;
        $x++;
      }
      if($status==3)
      {
        return $project_achieve_array[1][7];
      }
      elseif($achieve>=100)
      {
        return $project_achieve_array[1][6];
      }
      elseif($achieve>=90)
      {
        return $project_achieve_array[1][5];
      }
      elseif($achieve>=75)
      {
        return $project_achieve_array[1][4];
      }
      elseif($achieve>=50)
      {
        return $project_achieve_array[1][3];
      }
      elseif($achieve>=25)
      {
        return $project_achieve_array[1][2];
      }
      else
      {
        return $project_achieve_array[1][1];
      }
    }
    return false;
  }

  /**
  * 達成率コメント（デフォルト）
  *
  * @param string $prefecture_id 都道府県ID
  * @param string $achieve       達成率
  * @return string
  */
  public static function getAchieveCommentByDefault($achieve=0,$status)
  {
    $achieve_array = sfConfig::get('app_project_achieve_0');
    $x=1;
    if (is_array($achieve_array)) {
      foreach($achieve_array as $value)
      {
        $project_achieve_array[$x] = $value;
        $x++;
      }
      if($status==3)
      {
        return $project_achieve_array[1][7];
      }
      elseif($achieve>=100)
      {
        return $project_achieve_array[1][6];
      }
      elseif($achieve>=90)
      {
        return $project_achieve_array[1][5];
      }
      elseif($achieve>=75)
      {
        return $project_achieve_array[1][4];
      }
      elseif($achieve>=50)
      {
        return $project_achieve_array[1][3];
      }
      elseif($achieve>=25)
      {
        return $project_achieve_array[1][2];
      }
      else
      {
        return $project_achieve_array[1][1];
      }
    }
    return false;
  }

  /**
  * 終了日までのコメント取得
  *
  * @param string $member_id
  * @param string $member_id
  * @param string $member_id
  * @return string
  */
  public static function getgoalComment($limit_date,$goal_date,$status)
  {
    if($limit_date <= 0)
    {
      if($status==2)
      {
        return "このプロジェクトは成立し、".$goal_date."に終了しました。";
      }
      else
      {
        return "このプロジェクトは成立せず".$goal_date."に終了しました。";
      }
    }
    else
    {
      return "終了まで ".$limit_date."日";
    }

  }

  /**
  * 半角英数字チェック
  *
  * @param string $checkstring
  * @return boolean
  */
  public static function checkStringType($checkstring)
  {
    if(!preg_match("/^[a-zA-Z0-9\x20]+$/", $checkstring))
      return false;

    return true;
  }

/**
 * 年月日と加算日からn日後、n日前を求める関数
 * $year 年
 * $month 月
 * $day 日
 * $addDays 加算日。マイナス指定でn日前も設定可能
 */
  public static	function computeDate($year, $month, $day, $addDays)
  {
    $baseSec = mktime(0, 0, 0, $month, $day, $year);//基準日を秒で取得
    $addSec = $addDays * 86400;//日数×１日の秒数
    $targetSec = $baseSec + $addSec;

    $ret = date("Y-m-d H:i:s", $targetSec);

    echo $year.":".$month.":".$day.":".$addDays." ==> ".$ret;exit;

    return $ret;
  }
  
  /**
   * 禁止文字列チェック
   *
   * @param string $str
   * @return string
   */
  public static function forbiddenWords($str)
  {
    // 禁止文字を配列で取得
    $forbidden_words = file(sfConfig::get('app_dir_home_path') . 'data/forbedden_word_list.dat');
    // 禁止文字数取得
    $cnt=count($forbidden_words);
    // 禁止文字数分ループ
    for ($i=0;$cnt>$i;$i++)
    {
      // 禁止文字のチェック
      if(stristr(rtrim($str), rtrim($forbidden_words[$i])) == true)
      {
        return true;
      }
    }

    return false;
  }

  /**
   * 時間引き算
   */
  public static function minusTime($a, $b, $format="H:i:s", $min_flag=false)
  {
    if($min_flag)
    {
      $hour = (int)date("G", strtotime($a) - strtotime($b) - 60*60*9); // G:時。24時間単位。先頭にゼロを付けない。
      $min  = (int)date("i", strtotime($a) - strtotime($b) - 60*60*9); // i:分。先頭にゼロをつける。
      
      return (int) (($hour*60) + $min);
    }
    
    return date($format, strtotime($a) - strtotime($b) - 60*60*9);
  }

  /**
   * 日付の差を求める
   */
  public static function minusDate($a, $b)
  {
    return (int)((strtotime($a)-strtotime($b)) / (60*60*24));
  }

  /**
   * 実行ファイルパスで環境を判断(バッチ用)
   */
  public static function getEnv($pwd)
  {
    if(strpos($pwd, 'tanaka')!== false)  
      $env =  'tanaka'; 
    elseif(strpos($pwd, 'aoi')!== false)     
      $env =  'aoi'; 
    elseif(strpos($pwd, 'stg')!== false)     
      $env =  'stg'; 
    else 
      $env =  'prod';
    
    return $env;
  }

//================================================================================================
// ■ログ
//================================================================================================
  /**
   * エラーログの出力(Notice)
   *
   * @param string $msg
   */
  public static function loggerNotice($msg) {
    $module_name = sfContext::getInstance()->getModuleName();
    $action_name = sfContext::getInstance()->getActionName();
    commonUtil::outputErrLog('[Notice] '.$msg.' '.$module_name.'/'.$action_name, 'Notice');
  }

  /**
   * エラーログの出力(Warn)
   *
   * @param string $msg
   */
  public static function loggerWarn($msg) {
    $module_name = sfContext::getInstance()->getModuleName();
    $action_name = sfContext::getInstance()->getActionName();
    commonUtil::outputErrLog('[Warn] '.$msg.' '.$module_name.'/'.$action_name, 'Warn');
  }

  /**
   * エラーログの出力(Err)
   *
   * @param string $msg
   */
  public static function loggerErr($msg) {
    $module_name = sfContext::getInstance()->getModuleName();
    $action_name = sfContext::getInstance()->getActionName();
    commonUtil::outputErrLog('[Error] '.$msg.' '.$module_name.'/'.$action_name, 'ERR');
  }

  /**
   * ログの出力
   *
   * @param string $msg
   * @param string $status
   */
  public static function outputErrLog($msg, $status, $batch_flag=false)
  {
    $today = date('Y/m/d H:i:s');
    $date  = date('Ymd');
    $path  = sfConfig::get('sf_log_dir').'/errlog.log';
    if($batch_flag) $path  = sfConfig::get('sf_log_dir').'/batch/'.$date.'.csv';

    $fp = fopen($path, 'a+');
    flock($fp, LOCK_EX);
    fwrite($fp, $today.','.$status.','.$msg."\n");
    flock($fp, LOCK_UN);
    fclose($fp);

    if(sfContext::getInstance()->getConfiguration()->getEnvironment()=='dev')
    {
//      echo $today.','.$status.','.$msg."\n";
    }
    
/*  // WEBの決済から書き込まれたエラーがapacheでバッチ実行するとエラーが出るためパーミッション変更
    $user_name = "apache";
    chown($path, $user_name);
    chgrp($path, $user_name);*/
    chmod($path, 0777);

    if($status == sfConfig::get('app_log_level_error'))
    {
      // メール情報
      $mail_setting     = sfConfig::get('app_mail_array');
      $from_name        = $mail_setting['from_name'];
      $from_mail        = $mail_setting['from_mail'];
      $to_name          = $mail_setting['admin_name'];
      $to_mail          = $mail_setting['admin_mail'];
      $subject          = $mail_setting['subject_error'];

      // メール本文
      $body = "下記のエラーが発生しました。ご確認ください。\n\n".$msg;

      $body = str_replace(",", ",\n", $body);
      // メール送信
      commonUtil::sendMail(sfContext::getInstance()->getMailer(), $from_name, $from_mail, $to_name, $to_mail, $subject, $body);
    }
  }
  
  /**
   * 購入ログ
   */
  public static function writeOrdersLog($point_array, $orders, $items, $member)
  {
    $payment_type_array     = sfConfig::get('app_payment_type_array');
    $convenience_type_array = sfConfig::get('app_convenience_type_array');
    $msg = '';
    
    $path   = sfConfig::get('sf_log_dir').'/orders/'.date('Ymd').'.csv';
    if(!file_exists( $path )) $msg = '注文日,注文ID,会員ID,決済方法,支払コンビニ,合計金額,利用ポイント,決済金額,商品,価格,数量'."\n";
    
    $msg .= $orders->getOrderDate() .',';
    $msg .= $orders->getId() .',';
    $msg .= $member->getId() .',';
    $msg .= $payment_type_array     [$orders->getPaymentType()] .',';
    $msg .= $convenience_type_array [$orders->getConvenienceType()] .',';
    $msg .= $orders->getPrice() .',';
    $msg .= $orders->getAmountPoint() .',';
    $msg .= $orders->getAmount() .',';
    
    foreach ($items as $item)
    {
      if($msg2) $msg2 .= "\n,,,,,,,,";
      $msg2 .= $item->getParameter('name') .',';
      $msg2 .= $item->getPrice() .',';
      $msg2 .= $item->getQuantity() .',';
    }
    $msg = $msg . $msg2 . "\n";

    $fp     = fopen($path, 'a+');
    flock   ($fp, LOCK_EX);
    fwrite  ($fp, mb_convert_encoding($msg, "SJIS", "UTF-8"));
    flock   ($fp, LOCK_UN);
    fclose  ($fp);
  }
  
  public static function writeOrdersLog2($point_array, $orders, $items, $member, $data, $shopping_cart)
  {
    $payment_type_array     = sfConfig::get('app_payment_type_array');
    $convenience_type_array = sfConfig::get('app_convenience_type_array');
    $msg = '';
    
    $path   = sfConfig::get('sf_log_dir').'/orders/'.date('Ymd').'.csv';
    if(!file_exists( $path )) $msg = '注文日,注文ID,会員ID,決済方法,支払コンビニ,合計金額,利用ポイント,決済金額,商品,価格,数量'."\n";

    $msg .= date('Y-m-d H:i:s') .',';
    $msg .= '(決済前),';
    $msg .= $member->getId() .',';
    $msg .= $payment_type_array     [$data['payment_type']] .',';
    $msg .= $convenience_type_array [$data['convenience_type']] .',';
    $msg .= $shopping_cart->getTotal() .',';
    $msg .= $point_array['use_point'] .',';
    $msg .= ($shopping_cart->getTotal() - $point_array['use_point']) .',';
    
    foreach ($items as $item)
    {
      if($msg2) $msg2 .= "\n,,,,,,,,";
      $msg2 .= $item->getParameter('name') .',';
      $msg2 .= $item->getPrice() .',';
      $msg2 .= $item->getQuantity() .',';
    }
    $msg = $msg . $msg2 . "\n";

    $fp     = fopen($path, 'a+');
    flock   ($fp, LOCK_EX);
    fwrite  ($fp, mb_convert_encoding($msg, "SJIS", "UTF-8"));
    flock   ($fp, LOCK_UN);
    fclose  ($fp);
  }

  /**
   * GMO APIログ
   */
  public static function writeGmoApiLog($api_name, $input, $output, $exe)
  {
    $msg  = date('Y/m/d H:i:s').",".$api_name.",";

    $msg .= "input,";

    $tmp = print_r($input, true);
    $pos = strpos($tmp, "[cardNo]");
    $msg .= substr($tmp, 0, $pos+15); 
    $msg .= "**********";
    $msg .= substr($tmp, $pos+26); 
    
    $msg .= ",output,";
    $msg .= print_r($output, true);
    $msg .= ",exe,";
    $msg .= print_r($exe, true);
    $msg .= "\n";
      
    $path   = sfConfig::get('sf_log_dir').'/gmo/'.date('Ymd').'.csv';
    $fp     = fopen($path, 'a+');
    flock   ($fp, LOCK_EX);
    fwrite  ($fp, $msg);
    flock   ($fp, LOCK_UN);
    fclose  ($fp);

    // バッチとWEBから書き込まれエラーになるため
    @chmod($path, 0777);
  }

  /**
   * ペイジェントAPIログ
   */
  public static function writeApiLog($api_name, $p, $ret_array)
  {
    $key_array = array();
    
    $key_array['saveCreditCardInfo'] = array(
      "merchant_id", 
      "telegram_kind",
      "telegram_version",
      "trading_id", 
      "customer_id", 
      "card_number", 
      "card_valid_term",
      "cardholder_name",
    );

    $key_array['deleteCreditCardInfo'] = array(
      "customer_id",
      "customer_card_id",
    );

    $key_array['referCreditCardInfo'] = array(
      "customer_id", 
    );
    
    $key_array['paymentByCreditCard'] = array(
      "payment_amount", 
      "card_number",  // ★デバッグ完了したら消す！
      "card_valid_term",
      "card_conf_number",
      "payment_class", 
      "split_count", 
      "3dsecure_ryaku",
      "3dsecure_use_type",
      "http_accept", 
      "http_user_agent", 
      "term_url", 
      "ref_trading_id", 
      "stock_card_mode", 
      "customer_id", 
      "customer_card_id", 
      "site_id", 
    );
    
    $key_array['paymentByNetBanking'] = array(
      "amount",
      "claim_kana",
      "claim_kanji",
      "customer_family_name",
      "customer_name",
      "receipt_name_kana",
      "receipt_name", 
      "return_url", 
      "merchant_name",
      "banner_url", 
      "free_memo", 
      "asp_payment_term", 
      "stop_return_url", 
      "copy_right", 
      "site_id", 
    );
    
    $key_array['paymentByConvenience'] = array(
      "payment_amount",
      "cvs_type", 
      "customer_family_name", 
      "customer_name", 
      "customer_tel", 
      "payment_limit_date",
      "sales_type", 
      "site_id", 
    );

    $key_array['referConvenienceStatus'] = array(
      "trading_id", 
    );

    $key_array['referNetBankingStatus'] = array(
      "trading_id", 
    );
      
    $msg  = date('Y/m/d H:i:s').",".$api_name.",";
    
    if($p)
    {  
      $msg .= "Request,";
      
      foreach($key_array[$api_name] as $no => $key)
      {
        $value =  $p->reqGet($key);
        if($value)
        {
          $ret = (is_array($value)) ? implode(" / ", $value) : $value;
          $msg .= $key."=<".$ret.">,";
        }
      }
    }
    else
    {
      $msg .= "Response,";

      foreach($ret_array as $key => $value)
      {
        if($key == "out_acs_html") continue;

        $msg .= $key."=<".$value.">,";
        
        $msg = mb_convert_encoding($msg, "SJIS", "UTF-8");
      }
    }
    $msg .= "\n";
      
    $path   = sfConfig::get('sf_log_dir').'/paygent/'.date('Ymd').'.csv';
    $fp     = fopen($path, 'a+');
    flock   ($fp, LOCK_EX);
    fwrite  ($fp, $msg);
    flock   ($fp, LOCK_UN);
    fclose  ($fp);

    // バッチとWEBから書き込まれエラーになるため
    @chmod($path, 0777);
  }

  /**
   * ペイジェントクレジット決済API戻りログ
   */
  public static function writeCreditReturnLog($request)
  {
    $msg  = date('Y/m/d H:i:s').",".$api_name.",";
    
    $msg .= "Response,executeCreditcard,";
    
    // https://precamo.com/creditcard/279459717459652?trading_id=279459717459652&result=0&payment_id=1530168
    $msg .= "order_no=<". $request->getParameter('order_no').">,";
    $msg .= "trading_id=<". $request->getParameter('trading_id').">,";
    $msg .= "result=<". $request->getParameter('result').">,";
    $msg .= "payment_id=<". $request->getParameter('payment_id').">,";
    $msg .= "response_code=<". $request->getParameter('response_code').">,";
    $msg .= "response_detail=<". $request->getParameter('response_detail').">,";
    $msg .= "\n";
     
    $msg = mb_convert_encoding($msg, "SJIS", "UTF-8");
      
    $path   = sfConfig::get('sf_log_dir').'/paygent/'.date('Ymd').'.csv';
    $fp     = fopen($path, 'a+');
    flock   ($fp, LOCK_EX);
    fwrite  ($fp, $msg);
    flock   ($fp, LOCK_UN);
    fclose  ($fp);

    @chmod($path, 0777);
  }
  
  /**
   * GMOクレジット決済API戻りログ
   */
  public static function writeGmoCreditReturnLog($request)
  {
    $msg  = date('Y/m/d H:i:s').",".$api_name.",";
    
    $msg .= "Response,executeCreditcard,";
    
    // https://precamo.com/creditcard/279459717459652?trading_id=279459717459652&result=0&payment_id=1530168
    $msg .= "MD=<". $request->getParameter('MD').">,";
    $msg .= "PaRes=<". $request->getParameter('PaRes').">,";
    $msg .= "sid=<". $request->getParameter('sid').">,";
    $msg .= "\n";
     
    $msg = mb_convert_encoding($msg, "SJIS", "UTF-8");
      
    $path   = sfConfig::get('sf_log_dir').'/gmo/'.date('Ymd').'.csv';
    $fp     = fopen($path, 'a+');
    flock   ($fp, LOCK_EX);
    fwrite  ($fp, $msg);
    flock   ($fp, LOCK_UN);
    fclose  ($fp);

    @chmod($path, 0777);
  }

  /**
   * GMO決済API戻りログ
   */
  public static function writeGmoReturnLog($request, $prod_flag=true)
  {
    $msg  = date('Y/m/d H:i:s').",".$api_name.",";
    
    $msg .= "Response,executeReceiveGmoPaymentStatus,";
    
    // https://precamo.com/creditcard/279459717459652?trading_id=279459717459652&result=0&payment_id=1530168
      $msg .= "Response,";
//    $msg .= print_r($request, true);

    $msg .= "ShopID=<".$request->getParameter('ShopID').">, ";
    $msg .= "ShopPass=<".$request->getParameter('ShopPass').">, ";
    $msg .= "AccessID=<".$request->getParameter('AccessID').">, ";
    $msg .= "OrderID=<".$request->getParameter('OrderID').">, ";
    $msg .= "Status=<".$request->getParameter('Status').">, ";
    $msg .= "Amount=<".$request->getParameter('Amount').">, ";
    $msg .= "TranID=<".$request->getParameter('TranID').">, ";
    $msg .= "PayType=<".$request->getParameter('PayType').">, ";
    $msg .= "CvsCode=<".$request->getParameter('CvsCode').">, ";
    $msg .= "CvsConfNo=<".$request->getParameter('CvsConfNo').">, ";
    $msg .= "CvsReceiptNo=<".$request->getParameter('CvsReceiptNo').">, ";
    $msg .= "ReceiptDate=<".$request->getParameter('ReceiptDate').">, ";
    
    $msg .= "CustID=<".$request->getParameter('CustID').">, ";
    $msg .= "BkCode=<".$request->getParameter('BkCode').">, ";
    $msg .= "ConfNo=<".$request->getParameter('ConfNo').">, ";
    $msg .= "EncryptReceiptNo=<".$request->getParameter('EncryptReceiptNo').">, ";

    $msg .= "SERVER_NAME=<".$_SERVER['SERVER_NAME'].">";
    
    $msg .= "\n";
     
    $msg = mb_convert_encoding($msg, "SJIS", "UTF-8");
    
    $path   = sfConfig::get('sf_log_dir').'/gmo/';
    
    if($prod_flag)  
    {
      $path .= date('Ymd').'.csv';
    }
    else
    {
      $path .= date('Ymd').'.dev.csv';
    }
    
    $fp     = fopen($path, 'a+');
    flock   ($fp, LOCK_EX);
    fwrite  ($fp, $msg);
    flock   ($fp, LOCK_UN);
    fclose  ($fp);

    @chmod($path, 0777);
  }

  /**
   * バリューAPIログ
   */
  public static function writeValueLog($api_name, $soap_param, $ret_array)
  {
    $msg  = date('Y/m/d H:i:s').",".$api_name.",";
    
    if($soap_param)
    {  
      $msg .= "Request,";
      
      foreach($soap_param as $key => $value)
      {
        $ret  = (is_array($value))? implode("/",$value):$value;
        $msg .= $key."=<".$ret.">,";
      }
    }
    else
    {
      $msg .= "Response,";

      foreach($ret_array as $key => $value)
      {
        $ret  = (is_array($value))? implode("/",$value):$value;
        $ret  = str_replace("\n", "", $ret); // 改行が入っている
        $msg .= $key."=<".$ret.">,";
      }
    }
    $msg .= "\n";
    
    $msg  = mb_convert_encoding($msg, "SJIS", "UTF-8");
  
    $path   = sfConfig::get('sf_log_dir').'/value/'.date('Ymd').'.csv';
    $fp     = fopen($path, 'a+');
    flock   ($fp, LOCK_EX);
    fwrite  ($fp, $msg);
    flock   ($fp, LOCK_UN);
    fclose  ($fp);
  }

  /**
   * 配列⇒文字列
   */
  public static function implodeArray($ret_array)
  {
    foreach($ret_array as $key => $value)
    {
      $ret .= $key."=<". (is_array($value)) ? implode("",$value) : $value.">,";
    }
    return $ret;
  }

//================================================================================================
// ■メール
//================================================================================================
  /**
  * メール送信
  */
  public static function sendMail($mailer, $from_name, $from_address, $to_name, $to_address, $subject, $mail_body, $cc=null, $no_cc_flag=false)
  {
    /**
     *  @前ドットメールアドレス対応 http://skilldev.info/redmine/issues/1148
     *  @ の前を "" で囲むことで回避
     *  http://pcclick.seesaa.net/article/70537856.html
     * http://www.h-fj.com/blog/archives/2009/03/01-100125.php
     */
    $str = substr ( $to_address, strpos($to_address, '@')-1, 1 );
    if($str=="." || $str=="_" || $str=="-")
    {
      $to_address = '"' . substr ( $to_address, 0, strpos($to_address, '@') ) . '"' . substr ( $to_address, strpos($to_address, '@') );
    }
     
    $message = $mailer->compose(
      $tmp1 = array($from_address => $from_name),
      $tmp2 = array($to_address => $to_name),
      $subject,
      $mail_body
    );

    $ret = $mailer->send($message);

    commonUtil::outputErrLog('sendMail():'.$ret.':'.$to_address, 'Notice');
    
    unset($message);
    unset($tmp1);
    unset($tmp2);
    unset($str);

    // お問合せ時は別文面でメールを送信している為二重に送信しない/メルマガもno_cc_flagで指定
    $mail_setting = sfConfig::get('app_mail_array');
    
    if( ! $no_cc_flag && ($subject != $mail_setting['subject_contact'] && $subject != $mail_setting['subject_contact_support'] ) )
    {
      // 送信者にも配信（CC/BCCオプションがない為別メールで送信） 
      $message = $mailer->compose(
        array($from_address => $from_name),
        array($from_address => $from_name),
        $subject,
        $mail_body
      );

      $mailer->send($message);
      unset($message);

      // 運用チームにも配信 
      $message = $mailer->compose(
        array($from_address => $from_name),
        array($mail_setting['mainte_mail'] => $mail_setting['mainte_name']),
        $subject,
        $mail_body
      );

      $mailer->send($message);
      unset($message);
    }

    // メモリ開放
    unset($mailer);
    unset($mail_body);
    unset($mail_setting);
    unset($subject);
  }

//================================================================================================
// ■ 排他制御
//================================================================================================
  /** 
   * バッチ排他制御：ロック状況チェック
   */
  public static function checkLockfile($lockfile, $method_name)
  {
    // ロックディレクトリ作成(ファイルより安全)
    // http://q.hatena.ne.jp/1231851001
    $ret = mkdir($lockfile);
    
    // 作成成功＝ロックされていない＝処理続行OK
    if($ret)
    {
      return true;
    }
    
    $filetime   = date('Y-m-d H:i:s', filemtime($lockfile));
    $diff       = commonUtil::minusTime(date('Y-m-d H:i:s'), $filetime, "G"); // G:時。24時間単位。先頭にゼロを付けない。
    $diff2      = commonUtil::minusTime(date('Y-m-d H:i:s'), $filetime);

    // 一定時間を過ぎていたらアラートメール送信
    if($diff > sfConfig::get('app_batch_alert_span'))
    {
      commonUtil::outputErrLog($method_name.": lock エラー 経過時間：".$diff2, 'Error', true);
      return false;
    }

    commonUtil::outputErrLog($method_name.": lock スキップ 経過時間：".$diff2, 'INFO', true);

    return true;
  }

//================================================================================================
// ■クレジットカード会社
//================================================================================================
  /**
   * 有効期限切れ判断
   */
  public static function checkCardLimit($yymm)
  {
    $y = '20'. substr($yymm,0,2);
    $m = substr($yymm,2);
    
    $now_y = date('Y');
    $now_m = date('m');
    
    if($y > $now_y)
    {
      return true;
    }
    elseif($y < $now_y)
    {
      return false;
    }
    else // 年が同じ場合は月で判断
    {
      if( ((int)$m) >= ((int)$now_m) )  // 同じ月もOKとみなす
      {
        return true;
      }
      else
      {
        return false;
      }
    }
  }
  
  /**
   * クレジットカード会社判定 http://kwski.net/jquery/1036/
   */
  public static function getCardCompany($card_no)
  {
    /*
      クレジットカード会社	規則
      Visa(ビザ)	4ではじまる。現在は、16桁の数字(古いやつは13桁)
      正規表現 : ^4[0-9]{12}(?:[0-9]{3})?$

      MasterCard
      (マスターカード)	はじめの2桁が「51~55」。全部で16桁
      正規表現 : ^5[1-5][0-9]{14}$

      JCB
      (ジェー・シー・ビー)	2131もしくは1800ではじまる15桁。35ではじまる16桁。
      正規表現 : ^(?:2131|1800|35\d{3})\d{11}$

      American Express
      (アメックス)	先頭2桁が"34"もしくは"37"ではじまる全部で15桁
      正規表現 : ^3[47][0-9]{13}$

      Diners Club
      (ダイナース)	先頭3桁が"300"~"305"、36もしくは38ではじまる。14桁。
      *5ではじまる16桁のカードもある。こちらは、ダイナースとマスターのジョイントベンチャーで、マスターとして扱われる。
      正規表現 : ^3(?:0[0-5]|[68][0-9])[0-9]{11}$
    */  
    if( preg_match('/^4[0-9*]{12}(?:[0-9]{3})?$/', $card_no) )
    {
      return 'visa';
    }    
    elseif( preg_match('/^5[1-5][0-9*]{14}$/', $card_no) )
    {
      return 'master';
    }    
    elseif( preg_match('/^(?:2131|1800|35[0-9*]{3})[0-9*]{11}$/', $card_no) )
    {
      return 'jcb';
    }    
    elseif( preg_match('/^3[47][0-9*]{13}$/', $card_no) )
    {
      return 'amex';
    }    
    elseif( preg_match('/^3(?:0[0-5]|[68][0-9])[0-9*]{11}$/', $card_no) )
    {
      return 'diners';
    }
    else
    {
      // 例外処理
      // ログ出力（管理者メール送信）
      $context    = sfContext::getInstance();
      $member_id  = commonUtil::decrypt($context->getUser()->getAttribute('member_id', null, sfConfig::get('app_session_name_member')));
      $tmp2  = substr($card_no,0,4);
      for($i=0; $i<strlen($card_no)-8; $i++) $tmp2 .= "*";
      $tmp2 .= substr($card_no, strlen($card_no)-4);
      
      $tmp  = 'session_id: '   . session_id();
      $tmp .= ',member_id: '   . $member_id;
      $tmp .= ',server_addr: ' . $_SERVER['SERVER_ADDR'];
      $tmp .= ',server_name: ' . $_SERVER['SERVER_NAME'];
      $tmp .= ',remote_addr: ' . $_SERVER['HTTP_X_FORWARDED_FOR'];
      $tmp .= ',request_uri: ' . $_SERVER['REQUEST_URI'];
      $tmp .= ',http_referer: '. $_SERVER['HTTP_REFERER'];
      $tmp .= ',date: '        . date('Y-m-d H:i:s');
      $tmp .= ',action: '      . 'getCardCompany';
      $tmp .= ',line: '        . __LINE__;
      $tmp .= ',msg: '         . '対象外のカード番号が入力されました：'.$tmp2;
      commonUtil::outputErrLog($tmp, sfConfig::get('app_log_level_error'));
    }
    
    return '';
  }
  
//================================================================================================
// ■暗号化
//================================================================================================
  /**
   * 暗号化
   */
  public static function encrypt($str)
  {
    if(strlen(trim($str))==0) return null;
    
    $crypt    = new Crypt_Blowfish( sfConfig::get('app_pin_crypt_key') ); 

    $encrypt  = bin2hex( $crypt->encrypt( $str ) );
    
    return $encrypt;
  }

  /**
   * 復号化
   */
  public static function decrypt($str)
  {
    if(strlen(trim($str))==0) return null;

    $crypt    = new Crypt_Blowfish( sfConfig::get('app_pin_crypt_key') ); 

    $decrypt  = rtrim($crypt->decrypt( pack( "H*", $str ) ) );  
    
    return $decrypt;
  }
  
//================================================================================================
// ■バリデーション
//================================================================================================
  /**
   * パスワード確認用チェック
   *
   * @param $validator
   * @param $values
   */
  public static function checkPassword($validator, $values, $must_flag=true)
  {
    $pass_min = sfConfig::get('app_length_pass_min');
    $pass_max = sfConfig::get('app_length_pass_max');

    // 登録情報編集では、PW入力なければチェックしない
    if($must_flag==false && (!$values['password']&&!$values['password2']))
    {
      return $values;
    }
    
    if(!$values['password'])
    {
      $error = new sfValidatorError($validator, 'パスワードを入力してください。');
      throw new sfValidatorErrorSchema($validator, array('password' => $error));
    }

    if(strlen($values['password']) < $pass_min)
    {
      $error = new sfValidatorError($validator, 'パスワードは半角英数字'.$pass_min.'文字以上で入力してください。');
      throw new sfValidatorErrorSchema($validator, array('password' => $error));
    }

    if(strlen($values['password']) > $pass_max)
    {
      $error = new sfValidatorError($validator, 'パスワードは半角英数字'.$pass_max.'文字以内で入力してください。');
      throw new sfValidatorErrorSchema($validator, array('password' => $error));
    }

    if(!$values['password2'])
    {
      $error = new sfValidatorError($validator, 'パスワード確認用を入力してください。');
      throw new sfValidatorErrorSchema($validator, array('password' => $error));
    }

    // 名前＝パスワードはNG
    if ($values['password'] == $values['name1']||$values['password'] == $values['name2'])
    {
      $error = new sfValidatorError($validator, '名前と同じパスワードは使用できません。');
      throw new sfValidatorErrorSchema($validator, array('password' => $error));
    }

    // 文字種別チェック
    if(!commonUtil::checkStringType($values['password']))
    {
      $error = new sfValidatorError($validator, 'パスワードは半角英数字で入力してください。');
      throw new sfValidatorErrorSchema($validator, array('password' => $error));
    }

    // 英数字混在チェック
    if( !preg_match("/([0-9].*[a-zA-Z]|[a-zA-Z].*[0-9])/", $values['password'])  )
    {
      $error = new sfValidatorError($validator, 'パスワードは英数混合で設定してください。');
      throw new sfValidatorErrorSchema($validator, array('password' => $error));
    }

    if ($values['password'] != $values['password2'])
    {
      $error = new sfValidatorError($validator, 'パスワードが確認用と違います。');
      throw new sfValidatorErrorSchema($validator, array('password' => $error));
    }
    
    // return the clean values
    return $values;
  }

  //================================================================================================
  // ■クッキー
  //================================================================================================

  /**
  * クッキー読み込み
  *
  * @param string $key
  * @param boolean $encode
  * @return string
  */
  public static function getCookie($key, $encode=false)
  {
    if($key==='')
    {
      return null;
    }

    if($encode)
    {
      // base64デコード
      $value = unserialize(base64_decode($this->getRequest()->getCookie($key)));
    }
    else
    {
      $value = sfContext::getInstance()->getRequest()->getCookie($key);
    }

    return $value;
  }

  /**
  * クッキー書き込み
  *
  * @param string $key
  * @param string $value
  * @param int $days
  * @param string $path
  * @param boolean $encode
  * @return boolean
  */
  public static function setCookie($key, $value, $days, $path, $encode=false, $min_flag=false)
  {
    if($key==='' || $days==='')
    {
      $msg = "setCookie:パラメータ不正";
      commonUtil::outputErrLog($msg, sfConfig::get('app_log_level_error'));
      return false;
    }

    if($encode)
    {
      // base64エンコード
      $encode_value = base64_encode(serialize($value));
    }
    else
    {
      $encode_value = $value;
    }

    // 有効期限
    if(!$days)
    {
      $limit_date = '0';
    }
    elseif(!$min_flag)
    {
      // 日ｘ24時間ｘ60分ｘ60秒
      $limit_date = time() + (60 * 60 * 24 * $days);
    }
    else
    {
      // $min_flag=true の場合はdaysに分が入っている：分ｘ60秒
      $limit_date = time() + (60 * $days);
    }

    // symfonyの関数だと書かれていない？
    //sfContext::getInstance()->getResponse()->setCookie($key, $encode_value, $limit_date, $path);

    // phpの関数使用
    $ret = setcookie($key, $encode_value, $limit_date, $path, 'precamo.com', $secure = true, $httponly = true);
    
    $msg = "setcookie() days:".$days." key:".$key." value:". $encode_value." limit_date:".date("Y-m-d H:i:s", $limit_date)." min_flag:".$min_flag." ret:".$ret;  //exit;
    if(sfContext::getInstance()->getConfiguration()->getEnvironment()=='dev')
    {
      commonUtil::outputErrLog($msg, sfConfig::get('app_log_level_info'));
    }

    return true;
  }

//================================================================================================
// ■セッション
//================================================================================================
  /**
   * ログインセッション設定
   */
  public static function setLoginSession($user, $member)
  {
    $user->setAuthenticated(true);
    $user->addCredential('member');

    setcookie(sfConfig::get('app_cookie_login_isAuthenticated'), '1', '0', '/', 'precamo.com', $secure = false, $httponly = false);
    
    $member_id  = commonUtil::encrypt($member['id']);
    
    $user->setAttribute('member_id',  $member_id,             sfConfig::get('app_session_name_member'));
    $user->setAttribute('name',       $member['name'],        sfConfig::get('app_session_name_member'));
    $user->setAttribute('point',      $member['point'],       sfConfig::get('app_session_name_member'));
    $user->setAttribute('last_login', $member['last_login'],  sfConfig::get('app_session_name_member'));
    $user->setAttribute('rank',       $member['rank'],        sfConfig::get('app_session_name_member'));
  }

  /**
   * ログインセッション破棄
   */
  public static function clearLoginSession($user, $session_flag = true)
  {
    $user->setAuthenticated(false);

    setcookie(sfConfig::get('app_cookie_login_isAuthenticated'), '0', '0', '/', 'precamo.com', $secure = false, $httponly = false);
    
    $user->setAttribute('member_id',  null,  sfConfig::get('app_session_name_member'));
    $user->setAttribute('name',       null,  sfConfig::get('app_session_name_member'));
    $user->setAttribute('point',      null,  sfConfig::get('app_session_name_member'));
    $user->setAttribute('last_login', null,  sfConfig::get('app_session_name_member'));
    $user->setAttribute('rank',       null,  sfConfig::get('app_session_name_member'));
    $user->setAttribute('referer',    null,  sfConfig::get('app_session_name_member'));

    // 自動ログインクッキー削除
    commonUtil::setCookie(sfConfig::get('app_cookie_login_memory'), '', time()-3600, '/');
    commonUtil::setCookie(sfConfig::get('app_cookie_browser_open'), '', time()-3600, '/');

    // セッションを明示的に破棄
    // http://d.hatena.ne.jp/tadasy/20110310/1299722197
    if($session_flag) // 強制退会時はセッション自体を残す
    {
      session_destroy();
    }
  }

  /**
   * ログインクッキー設定
   */
  public static function setLoginCookie($member)
  {
    $member_id  = commonUtil::encrypt($member['id']);
    $point      = number_format($member['point']);
    
    // expire:クッキーの有効期限。0 を設定したり省略したりした場合は、クッキーはセッションの最後 (つまりブラウザを閉じるとき) が有効期限
//  $limit_date = time() + (60 * 60 * sfConfig::get('app_cookie_login_memory_hour'));
    $limit_date = '0';

    // 別環境でテストするとクッキーが誤認識される為、全環境で固定する
    $server_name = 'precamo.com'; // $_SERVER['SERVER_NAME']
    
    $ret = setcookie(sfConfig::get('app_cookie_login_isAuthenticated'), '1',                        $limit_date, '/', $server_name, $secure = false, $httponly = false);
    $ret = setcookie(sfConfig::get('app_cookie_login_member_id'),       $member_id,                 $limit_date, '/', $server_name, $secure = false, $httponly = false);
    $ret = setcookie(sfConfig::get('app_cookie_login_name'),            $member['name'],            $limit_date, '/', $server_name, $secure = false, $httponly = false);
    $ret = setcookie(sfConfig::get('app_cookie_login_point'),           $point,                     $limit_date, '/', $server_name, $secure = false, $httponly = false);
    $ret = setcookie(sfConfig::get('app_cookie_login_last_login'),      $member['last_login'],      $limit_date, '/', $server_name, $secure = false, $httponly = false);
    $ret = setcookie(sfConfig::get('app_cookie_login_rank'),            $member['rank'],            $limit_date, '/', $server_name, $secure = false, $httponly = false);
  }

  /**
   * ログインクッキー破棄
   */
  public static function clearLoginCookie($cart_flag=true)
  {
    $limit_date = time() - 3600;
    $server_name = 'precamo.com'; // $_SERVER['SERVER_NAME']
    
    $ret = setcookie(sfConfig::get('app_cookie_login_isAuthenticated'), '0',       $limit_date, '/', $server_name, $secure = false, $httponly = false);
    $ret = setcookie(sfConfig::get('app_cookie_login_member_id'),       null,      $limit_date, '/', $server_name, $secure = false, $httponly = false);
    $ret = setcookie(sfConfig::get('app_cookie_login_name'),            null,      $limit_date, '/', $server_name, $secure = false, $httponly = false);
    $ret = setcookie(sfConfig::get('app_cookie_login_point'),           null,      $limit_date, '/', $server_name, $secure = false, $httponly = false);
    $ret = setcookie(sfConfig::get('app_cookie_login_last_login'),      null,      $limit_date, '/', $server_name, $secure = false, $httponly = false);
    $ret = setcookie(sfConfig::get('app_cookie_login_rank'),            null,      $limit_date, '/', $server_name, $secure = false, $httponly = false);

    // 最近購入点数初期化
    $ret = setcookie(sfConfig::get('app_cookie_recent_item'),           null,      $limit_date, '/', $server_name, $secure = false, $httponly = false);

    // ログアウト中にカートに入っている点数は初期化しない
    if($cart_flag)
    {
      // ショッピングカート点数も初期化
      $ret = setcookie(sfConfig::get('app_cookie_cart_item_count'),       '0',       $limit_date, '/', $server_name, $secure = false, $httponly = false);
    }
  }

  /**
   * 画像タイプ
   */
  public static function getImageExt($device)
  {
    if($device=="smp"||$device=="mob") 
      return "_s";
    
    return "";
  }

}
