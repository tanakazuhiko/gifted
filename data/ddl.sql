
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主キー',
  `place_id` int(11) NOT NULL COMMENT '施設ID',
  `member_id` int(11) DEFAULT NULL COMMENT '会員ID',
  `name` varchar(100) NOT NULL COMMENT '氏名',
  `mail` varchar(255) NULL COMMENT 'メールアドレス',
  `comment` text COMMENT '本文',
  `delete_flag` tinyint(1) DEFAULT '0' COMMENT '削除フラグ　（※未使用）',
  `created_at` datetime DEFAULT NULL COMMENT '登録日時',
  `updated_at` datetime DEFAULT NULL COMMENT '最終更新日',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
