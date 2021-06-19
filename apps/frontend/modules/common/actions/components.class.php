<?php

class commonComponents extends sfComponents
{
  /**
  * メンバー情報取得
  *
  */
  public function executeMemberinfo()
  {
    // 会員ID
    $member_id = $this->getUser()->getAttribute('member_id');

    // 会員情報取得
    $ret = Member::getMember($member_id);
    //print_r($ret);

    // ニックネーム
    $this->name = $ret['name'];
  }

  /**
  * お問合せメール本文取得
  *
  */
  public function executeCreateContactMailBody($request)
  {
  }

  public function executeCreateCommentMailBody($request)
  {
  }

  /**
  * プロジェクト投稿管理者用本文取得
  *
  */
  public function executeCreateProjectRequestAdminMailBody($request)
  {
    // 都道府県一覧取得
    $prefectureList = Prefecture::getPrefectureList();
    // 配列にする
    $prefecture_array[''] = '選択して下さい。';
    foreach ($prefectureList as $prefecture) {
      $prefecture_array[$prefecture['id']] = $prefecture['prefecture'];
    }

    $this->prefecture_array = $prefecture_array;

  }

  /**
  * プロジェクト投稿会員用本文取得
  *
  */
  public function executeCreateProjectRequestMemberMailBody($request)
  {
    // 都道府県一覧取得
    $prefectureList = Prefecture::getPrefectureList();
    // 配列にする
    $prefecture_array[''] = '選択して下さい。';
    foreach ($prefectureList as $prefecture) {
      $prefecture_array[$prefecture['id']] = $prefecture['prefecture'];
    }

    $this->prefecture_array = $prefecture_array;

  }

  /**
  * メッセージメール本文取得
  *
  */
  public function executeCreateMessageMailBody($request)
  {
    // ここで本文を作成するのに必要なロジックをコーディングする
  }

  /**
  * メールアドレス変更本文取得
  *
  */
  public function executeCreateMailEditMailBody($request)
  {
    // ここで本文を作成するのに必要なロジックをコーディングする
  }

  /**
  * 成立結果メール本文取得
  *
  */
  public function executeCreateProjectSuccessMailBody($request){}
  public function executeCreateProjectFailureMailBody($request){}

  /**
  * パスワードリマインダー本文取得
  *
  */
  public function executeCreatePwMailBody($request)
  {
    // ここで本文を作成するのに必要なロジックをコーディングする
  }

  /**
  * 応援者への応援完了メール本文取得
  *
  */
  public function executeCreateSupportMailBody($request){}


  /**
  * 投稿者への応援完了メール本文取得
  *
  */
  public function executeCreateSupportOwnerMailBody($request){}

  /**
  * 退会完了メール本文取得
  *
  */
  public function executeCreateLeaveMailBody($request)
  {
    $reasons = MLeaveReason::getLeaveReasonList();
    $reason_array = array();
    foreach ($reasons as $reason) {
      $reason_array[$reason['id']] = $reason['reason'];
    }

    $this->reason_array = $reason_array;
  }

  /**
  * 会員登録完了メール本文取得
  *
  */
  public function executeCreateRegisteredMailBody($request)
  {
    // ここで本文を作成するのに必要なロジックをコーディングする
  }

}
