SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `___activity` (
  `rid` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid` bigint(19) UNSIGNED NOT NULL DEFAULT '0',
  `aid` tinyint(3) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  `data` varchar(255) NOT NULL DEFAULT '',
  `st` tinyint(1) NOT NULL DEFAULT '0',
  `ts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `___usr` (
  `x` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id` bigint(19) UNSIGNED NOT NULL DEFAULT '0',
  `key` varchar(32) NOT NULL DEFAULT '0',
  `val` varchar(255) NOT NULL DEFAULT '',
  `prm` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `prv` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `grp` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `st` tinyint(3) NOT NULL DEFAULT '0',
  `ts` bigint(19) UNSIGNED NOT NULL DEFAULT '0',
  `exp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`x`)
) ENGINE=InnoDB AUTO_INCREMENT=112015 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `___ac` (
  `x` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id` bigint(19) UNSIGNED NOT NULL DEFAULT '0',
  `key` varchar(128) NOT NULL DEFAULT '0',
  `val` varchar(255) NOT NULL DEFAULT '',
  `prm` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `prv` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `grp` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `st` tinyint(3) NOT NULL DEFAULT '0',
  `ts` bigint(19) UNSIGNED NOT NULL DEFAULT '0',
  `exp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`x`)
) ENGINE=InnoDB AUTO_INCREMENT=112015 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `___devices` (
  `rid` bigint(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `devid` varchar(255) NOT NULL DEFAULT '',
  `sid` varchar(255) NOT NULL DEFAULT '',
  `uid` bigint(19) UNSIGNED NOT NULL DEFAULT '0',
  `st` tinyint(3) NOT NULL DEFAULT '0',
  `ts` bigint(19) UNSIGNED NOT NULL DEFAULT '0',
  `exp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`),
  UNIQUE KEY `rid` (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=1155 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `___office` (
  `cid` bigint(19) UNSIGNED NOT NULL DEFAULT '0',
  `uid` bigint(19) UNSIGNED NOT NULL DEFAULT '0',
  `crud` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `gl` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `st` tinyint(3) NOT NULL DEFAULT '0',
  `ts` bigint(19) UNSIGNED NOT NULL DEFAULT '0',
  `exp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `___options` (
  `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `option_group` varchar(64) NOT NULL,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `type` varchar(12) NOT NULL DEFAULT 'text',
  `size` tinyint(3) NOT NULL DEFAULT '1',
  `autoload` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_x` (`option_id`,`option_group`,`option_name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO `___options` (`option_id`, `option_group`, `option_name`, `option_value`, `type`, `size`, `autoload`) VALUES
(10, 'main', 'signup', 'on', 'check', 1, 1),
(20, 'main', 'crc', 'usd', 'text', 1, 1),
(30, 'main', 'about', 'Complete User Registration and Management. Secure, Fast, Small and Light.', 'text', 1, 1),
(40, 'main', 'copyright', 'AMPAE', 'text', 1, 1),
(50, 'home', 'form_under', 'Text under the Forms, change me in the Admin Options', 'text', 1, 1),
(60, 'email', 'tmpl_otp', '{\r\n&#34;subject&#34; : &#34;{{ct_name}} - OTP for {{ct_org}}&#34;,&#34;body&#34; : &#34; Dear {{ct_name}},\r\n{{ct_br}} {{ct_br}} Here is your One Time Password or Access Code for {{ct_org_url}} Please log in by clicking on this link or copying and pasting it into your browser: {{ct_br}} {{ct_br}} {{ct_signin_url}} {{ct_br}} {{ct_br}} Your OTP: {{ct_opass}} {{ct_br}} {{ct_br}} {{ct_org}} Support Team {{ct_br}}&#34;\r\n}', 'text', 1, 1),
(110, 'email', 'smtp', '', 'check', 1, 1),
(120, 'email', 'SMTP_HOST', 'smtp.example.com', 'text', 1, 1),
(130, 'email', 'SMTP_SEC', 'tls', 'text', 1, 1),
(140, 'email', 'SMTP_PORT', '587', 'text', 1, 1),
(150, 'email', 'SMTP_NAME', 'noreply@yourdomain.tld', 'text', 1, 1),
(160, 'email', 'SMTP_PASS', '*****', 'text', 1, 1),
(200, 'home', 'welcome', 'Check your eMail and Login', 'text', 1, 1),
(250, 'home', 'aside_right', 'Add any text in Admin Options. You can also add HTML directly to aside-right.php template.', 'text', 1, 1);
