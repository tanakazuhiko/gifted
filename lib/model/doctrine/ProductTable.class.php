<?php

/**
 * ProductTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ProductTable extends Doctrine_Table
{
  const CLASS_NAME = 'Product';

  public static function getInstance()
  {
    return Doctrine_Core::getTable(self::CLASS_NAME);
  }
  
//================================================================================================
// ■1. 参照系
//================================================================================================
  /**
   * 一覧取得
   */
  public function getList($placeId, $productType='', $limit='0', $offset='0')
  {
    $q = Doctrine::getTable(self::CLASS_NAME)->addActiveQuery();
    $q->andWhere('place_id = ?',      $placeId);
    
    if($productType)
    {
      $q->andWhere('product_type = ?',  $productType);
    }

    if($limit)
    {
      $q->limit($limit);
    }
    
    if($offset)
    {
      $q->offset($offset);
    }
    
    $q->addOrderBy('order_no ASC, id ASC'); 

    $ret = $q->fetchArray();
    
    $ret_array = array();
    
    foreach($ret as $key => $value)
    {
      $ret_array[$value['product_type']][] = $value;
    }
    //echo $q->getSqlQuery()."\n"; echo "<pre>"; print_r($ret_array); echo "</pre>";exit;
   
    return $ret_array;
  }

  /**
   * 件数取得
   */
  public function getCount($placeId, $productType='')
  {
    $q = Doctrine::getTable(self::CLASS_NAME)->addActiveQuery();
    $q->andWhere('place_id = ?',      $placeId);
    
    if($productType)
    {
      $q->andWhere('product_type = ?',  $productType);
    }

    $ret = $q->execute();
    return count($ret);
  }

//================================================================================================
// ■クエリ
//================================================================================================
  /**
   * 有効データ抽出クエリ
   */
  public function addActiveQuery(Doctrine_Query $q = null)
  {
    if (is_null($q))
    {
      $q = Doctrine_Query::create()
        ->from(self::CLASS_NAME);
    }
 
    $q->andWhere('delete_flag = ?',    sfConfig::get('app_delete_flag_active'));
 
    return $q;
  }

  
  
}