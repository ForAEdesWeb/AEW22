CREATE TABLE IF NOT EXISTS `#__quickcontent_lists` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `menutype` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `delete_existing` int(3) NOT NULL,
  `category_menutype` varchar(255) NOT NULL,
  `list` text NOT NULL,
  `blog` text NOT NULL,
  `article` text NOT NULL,
  `generated` tinyint NOT NULL DEFAULT '0',
  `restore` text NOT NULL,
  `alias` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `version` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `publish_up` datetime NOT NULL,
  `publish_down` datetime NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_alias` (`alias`),
  KEY `idx_checkout` (`checked_out`),
  KEY `cat_index` (`published`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;
