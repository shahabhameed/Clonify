-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2014 at 01:49 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dssd`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `invocation_files`
--

CREATE TABLE IF NOT EXISTS `invocation_files` (
  `invocation_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `cmfile_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invocation_files`
--

INSERT INTO `invocation_files` (`invocation_id`, `file_id`, `length`, `cmfile_id`) VALUES
(2, 10, 0, 0),
(2, 12, 0, 1),
(2, 15, 0, 2),
(2, 17, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `invocation_parameters`
--

CREATE TABLE IF NOT EXISTS `invocation_parameters` (
  `min_similatiry_SCC_tokens` int(10) NOT NULL,
  `grouping_choice` int(2) NOT NULL,
  `method_analysis` tinyint(1) NOT NULL,
  `suppressed_tokens` varchar(100) DEFAULT NULL,
  `equal_tokens` varchar(500) DEFAULT NULL,
  `invocation_id` int(11) NOT NULL,
  KEY `invocation_id` (`invocation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invocation_parameters`
--

INSERT INTO `invocation_parameters` (`min_similatiry_SCC_tokens`, `grouping_choice`, `method_analysis`, `suppressed_tokens`, `equal_tokens`, `invocation_id`) VALUES
(30, 0, 0, '10,100,103,104', '100=10=10|103=103|107=106=106=105=105=104=104', 2);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL,
  `language` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language`) VALUES
(1, 'JAVA'),
(2, 'C++'),
(3, 'VB.NET'),
(4, 'CSharp'),
(5, 'Ruby'),
(6, 'PHP'),
(7, 'Plain Text');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=53 ;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(47, '203.135.63.151', 'testuser', '2014-02-10 10:11:33'),
(48, '203.135.63.151', 'h@h.com', '2014-02-10 10:15:00'),
(49, '203.135.63.151', 'h@h.com', '2014-02-10 10:16:04'),
(50, '10.103.98.54', 'shahramjaved75', '2014-02-10 11:00:41'),
(51, '10.103.6.36', 'motz.0143@gmail.com', '2014-02-10 11:04:19'),
(52, '10.103.6.36', 'motz.0143@gmail.com', '2014-02-10 11:04:52');

-- --------------------------------------------------------

--
-- Table structure for table `repository_directory`
--

CREATE TABLE IF NOT EXISTS `repository_directory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `directory_name` varchar(100) NOT NULL,
  `repository_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `repository_id` (`repository_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `repository_directory`
--

INSERT INTO `repository_directory` (`id`, `directory_name`, `repository_id`) VALUES
(2, 'java/', 3);

-- --------------------------------------------------------

--
-- Table structure for table `repository_file`
--

CREATE TABLE IF NOT EXISTS `repository_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(100) NOT NULL,
  `directory_id` int(11) NOT NULL,
  `last_modified_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `directory_id` (`directory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `repository_file`
--

INSERT INTO `repository_file` (`id`, `file_name`, `directory_id`, `last_modified_time`) VALUES
(10, 'Cocos2dxAccelerometer.java', 2, '2014-02-10 16:18:45'),
(11, 'Cocos2dxActivity.java', 2, '2014-02-10 16:18:45'),
(12, 'Cocos2dxBitmap.java', 2, '2014-02-10 16:18:45'),
(13, 'Cocos2dxGLSurfaceView.java', 2, '2014-02-10 16:18:45'),
(14, 'Cocos2dxMusic.java', 2, '2014-02-10 16:18:45'),
(15, 'Cocos2dxRenderer.java', 2, '2014-02-10 16:18:45'),
(16, 'Cocos2dxSound.java', 2, '2014-02-10 16:18:45'),
(17, 'SCICopy.java', 2, '2014-02-10 16:18:45'),
(18, 'SCSInFileInstance.java', 2, '2014-02-10 16:18:45');

-- --------------------------------------------------------

--
-- Table structure for table `scc`
--

CREATE TABLE IF NOT EXISTS `scc` (
  `scc_id` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `members` int(11) NOT NULL,
  `invocation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scc_instance`
--

CREATE TABLE IF NOT EXISTS `scc_instance` (
  `scc_instance_id` int(11) NOT NULL,
  `scc_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `startline` int(11) NOT NULL,
  `startcol` int(11) NOT NULL,
  `endline` int(11) NOT NULL,
  `endcol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scc_invocation`
--

CREATE TABLE IF NOT EXISTS `scc_invocation` (
  `scc_id` int(11) NOT NULL,
  `invocation_id` int(11) NOT NULL,
  KEY `scc_id` (`scc_id`),
  KEY `invocation_id` (`invocation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE IF NOT EXISTS `tokens` (
  `language_id` int(11) NOT NULL,
  `token_id` int(11) NOT NULL,
  `token_name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tokens`
--

INSERT INTO `tokens` (`language_id`, `token_id`, `token_name`) VALUES
(1, 4, 'float'),
(1, 5, 'package'),
(1, 6, 'final'),
(1, 7, 'abstract'),
(1, 8, 'strictfp'),
(1, 9, 'byte'),
(1, 10, 'public'),
(1, 11, 'case'),
(1, 12, 'short'),
(1, 13, 'break'),
(1, 14, 'while'),
(1, 15, 'new'),
(1, 16, 'instanceof'),
(1, 17, 'implements'),
(1, 18, 'synchronize'),
(1, 19, 'return'),
(1, 20, 'throw'),
(1, 21, 'null'),
(1, 22, 'threadsafe'),
(1, 23, 'protected'),
(1, 24, 'class'),
(1, 25, 'throws'),
(1, 26, 'do'),
(1, 27, 'super'),
(1, 28, 'transient'),
(1, 29, 'native'),
(1, 30, 'interface'),
(1, 31, 'if'),
(1, 32, 'double'),
(1, 33, 'volatile'),
(1, 34, 'catch'),
(1, 35, 'try'),
(1, 36, 'int'),
(1, 37, 'for'),
(1, 38, 'extends'),
(1, 39, 'boolean'),
(1, 40, 'char'),
(1, 41, 'private'),
(1, 42, 'default'),
(1, 43, 'false'),
(1, 44, 'this'),
(1, 45, 'static'),
(1, 46, 'continue'),
(1, 47, 'finally'),
(1, 48, 'else'),
(1, 49, 'import'),
(1, 50, 'void'),
(1, 51, 'switch'),
(1, 52, 'true'),
(1, 53, 'long'),
(1, 54, '.'),
(1, 55, 'LONG NUMBER'),
(1, 56, 'FLOAT NUMBE'),
(1, 57, 'DOUBLE NUMB'),
(1, 58, '?'),
(1, 59, '('),
(1, 60, ')'),
(1, 61, '['),
(1, 62, ']'),
(1, 63, '{'),
(1, 64, '}'),
(1, 65, ':'),
(1, 66, ''),
(1, 67, '='),
(1, 68, '=='),
(1, 69, '!'),
(1, 70, '~'),
(1, 71, '!='),
(1, 72, '/'),
(1, 73, '/='),
(1, 74, '+'),
(1, 75, '+='),
(1, 76, '++'),
(1, 77, '-'),
(1, 78, '-='),
(1, 79, '--'),
(1, 80, '*'),
(1, 81, '*='),
(1, 82, '%'),
(1, 83, '%='),
(1, 84, '>>'),
(1, 85, '>>='),
(1, 86, '>>>'),
(1, 87, '>>>='),
(1, 88, '>='),
(1, 89, '>'),
(1, 90, '<<'),
(1, 91, '<<='),
(1, 92, '<='),
(1, 93, '<'),
(1, 94, '^'),
(1, 95, '^='),
(1, 96, '|'),
(1, 97, '|='),
(1, 98, '||'),
(1, 99, '&'),
(1, 100, '&='),
(1, 101, '&&'),
(1, 102, ';'),
(1, 103, 'WHITE SPACE'),
(1, 104, 'SINGLE-LINE'),
(1, 105, 'MULTI-LINE '),
(1, 106, 'CHARACTER L'),
(1, 107, 'STRING LITE'),
(1, 108, 'ESCAPE'),
(1, 109, 'HEX DIGIT'),
(1, 110, 'VOCABULARY'),
(1, 111, 'IDENTIFIER'),
(1, 112, 'INTEGER NUM'),
(1, 113, 'EXPONENT'),
(1, 114, 'FLOAT SUFFI'),
(2, 4, 'asm'),
(2, 5, 'and'),
(2, 6, 'and_eq'),
(2, 7, 'auto'),
(2, 8, 'bitand'),
(2, 9, 'bitor'),
(2, 10, 'bool'),
(2, 11, 'break'),
(2, 12, 'case'),
(2, 13, 'catch'),
(2, 14, 'char'),
(2, 15, 'class'),
(2, 16, 'compl'),
(2, 17, 'const'),
(2, 18, 'const_cast'),
(2, 19, 'continue'),
(2, 20, 'cout'),
(2, 21, 'cin'),
(2, 22, 'default'),
(2, 23, 'define'),
(2, 24, 'delete'),
(2, 25, 'do'),
(2, 26, 'double'),
(2, 27, 'dynamic_cas'),
(2, 28, 'else'),
(2, 29, 'elif'),
(2, 30, 'endif'),
(2, 31, 'endl'),
(2, 32, 'enum'),
(2, 33, 'error'),
(2, 34, 'exit'),
(2, 35, 'explicit'),
(2, 36, 'extern'),
(2, 37, 'false'),
(2, 38, 'float'),
(2, 39, 'for'),
(2, 40, 'friend'),
(2, 41, 'goto'),
(2, 42, 'if'),
(2, 43, 'ifdef'),
(2, 44, 'ifndef'),
(2, 45, 'include'),
(2, 46, 'inline'),
(2, 47, 'int'),
(2, 48, 'long'),
(2, 49, 'line'),
(2, 50, 'mutable'),
(2, 51, 'namespace'),
(2, 52, 'new'),
(2, 53, 'not'),
(2, 54, 'not_eq'),
(2, 55, 'operator'),
(2, 56, 'or'),
(2, 57, 'or_eq'),
(2, 58, 'pragma'),
(2, 59, 'private'),
(2, 60, 'protected'),
(2, 61, 'public'),
(2, 62, 'register'),
(2, 63, 'reinterpret'),
(2, 64, 'return'),
(2, 65, 'short'),
(2, 66, 'signed'),
(2, 67, 'sizeof'),
(2, 68, 'static'),
(2, 69, 'static_cast'),
(2, 70, 'struct'),
(2, 71, 'string'),
(2, 72, 'switch'),
(2, 73, 'template'),
(2, 74, 'this'),
(2, 75, 'throw'),
(2, 76, 'true'),
(2, 77, 'try'),
(2, 78, 'typedef'),
(2, 79, 'typename'),
(2, 80, 'undef'),
(2, 81, 'union'),
(2, 82, 'unsigned'),
(2, 83, 'using'),
(2, 84, 'virtual'),
(2, 85, 'void'),
(2, 86, 'volatile'),
(2, 87, 'warning'),
(2, 88, 'wchar_t'),
(2, 89, 'while'),
(2, 90, 'xor'),
(2, 91, 'xor_eq'),
(2, 92, '?'),
(2, 93, '('),
(2, 94, ')'),
(2, 95, '['),
(2, 96, ']'),
(2, 97, '{'),
(2, 98, '}'),
(2, 99, ':'),
(2, 100, ''),
(2, 101, '='),
(2, 102, '=='),
(2, 103, '!'),
(2, 104, '~'),
(2, 105, '!='),
(2, 106, '/'),
(2, 107, '/='),
(2, 108, '#'),
(2, 109, '+'),
(2, 110, '+='),
(2, 111, '++'),
(2, 112, '-'),
(2, 113, '-='),
(2, 114, '--'),
(2, 115, '*'),
(2, 116, '*='),
(2, 117, '%'),
(2, 118, '%='),
(2, 119, '>>'),
(2, 120, '>>='),
(2, 121, '>='),
(2, 122, '>'),
(2, 123, '<<'),
(2, 124, '<<='),
(2, 125, '<='),
(2, 126, '<'),
(2, 127, '^'),
(2, 128, '^='),
(2, 129, '|'),
(2, 130, '|='),
(2, 131, '||'),
(2, 132, '&'),
(2, 133, '&='),
(2, 134, '&&'),
(2, 135, ';'),
(2, 136, '->'),
(2, 137, '->*'),
(2, 138, '.*'),
(2, 139, '::'),
(2, 140, 'WHITE SPACE'),
(2, 141, 'COMMENT'),
(2, 142, 'CPP COMMENT'),
(2, 143, 'CHARACTER L'),
(2, 144, 'STRING LITE'),
(2, 145, 'ESCAPE'),
(2, 146, 'VOCABULARY'),
(2, 147, 'IDENTIFIER'),
(2, 148, 'INTEGER NUM'),
(2, 149, 'EXPONENT'),
(2, 150, 'FLOAT SUFFI'),
(2, 151, 'LONG SUFFIX'),
(2, 152, 'UNSIGNED SU');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `first_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=54 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`) VALUES
(18, 'test271246239', '$2a$08$qpKuBSowhqVBJvC12dH15.lbmo5GTk7KggLLmF88gFly4q48tJg3K', 'test271246239@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '2014-02-10 15:39:45', '2014-01-29 15:57:31', '2014-02-10 10:39:45'),
(19, 'test2281661538', '$2a$08$rfRk4MR1sTBEKXM9CbSD3Owgmrb5992u9eqg46LSP4oifsjmoTJgS', 'test2281661538@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '10.103.3.144', '0000-00-00 00:00:00', '2014-01-29 15:57:31', '2014-01-29 10:57:31'),
(20, 'test6360856038', '$2a$08$K//LyAFVu65FLKzox4O99OdgKDqB3kTxlAVtnS0Jh9R5RUDsrq7mK', 'test6360856038@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '10.102.0.85', '2014-01-29 16:02:14', '2014-01-29 15:58:47', '2014-01-29 11:02:14'),
(21, 'test863955385', '$2a$08$HcfT8d5KLKTdYcX4WcCtxOZc5UId.BSYcxooAxibzBs6xYkYJ7KfO', 'test863955385@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '10.102.0.85', '0000-00-00 00:00:00', '2014-01-29 15:58:47', '2014-01-29 10:58:48'),
(22, 'test5832113654', '$2a$08$j/KV3/okQiVifRgjactkQu8/eO5Ar2/OHtNEt7q0HXqAPlW4tw3iW', 'test5832113654@gmail.com', 'Test', 'Test', 1, 0, NULL, 'ce26aaaed0b0fbc313de8824fceae595', '2014-01-29 16:17:18', NULL, NULL, '10.103.3.144', '2014-01-29 16:17:18', '2014-01-29 16:17:17', '2014-01-29 11:17:18'),
(23, 'test3315789830', '$2a$08$7UpMGSTdG.M/CQ1cgKm9M.k3WrHHozfH2dC6hWYZ0hkpDiua4MqtC', 'test3315789830@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '10.103.3.144', '0000-00-00 00:00:00', '2014-01-29 16:17:17', '2014-01-29 11:17:17'),
(24, 'testuser', '$2a$08$JWSZGOMCfMJiqslpC6Ep7OXroYtVqoK767XbA9V2FVBuU9Y77eBZu', 'mohsinn88@gmail.com', 'test', 'user', 1, 0, NULL, NULL, NULL, NULL, 'b9a2b56660ec2dc0a433770804462328', '10.103.4.4', '2014-01-31 17:17:12', '2014-01-29 17:19:16', '2014-01-31 12:17:12'),
(25, 'Hhhh', '$2a$08$cSaeO0X8b1UMUlEu3iM0.u5lloTxqzPj0mQ2bMgqyD9tWNmFAN/US', 'h@h.com', 'H', 'H', 1, 0, NULL, NULL, NULL, NULL, '71e5728833c6421b2a8008db38a35db6', '10.103.1.68', '2014-01-31 15:43:03', '2014-01-29 17:22:01', '2014-01-31 10:43:03'),
(27, 'test9201671202', '$2a$08$Lcj49OYRHXwY4B7UNurJkONsWpTTzNI7Q/ivwxKo4736D6LonNHDe', 'test9201671202@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '0000-00-00 00:00:00', '2014-01-29 17:47:30', '2014-01-29 12:47:30'),
(28, 'test2207211673', '$2a$08$EkuqbmBWUvqorRn4F1GrJ.6x5HgwGzxCSTRcQ9RiXzAQrXk.0pvna', 'test2207211673@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '2014-02-10 00:00:00', '2014-01-29 17:47:30', '2014-02-10 10:14:03'),
(29, 'test6762971339', '$2a$08$qLEpCB5JNUzDndXpmByPX.IF8DxTNYuIyC9OVB.YsAt6/DCOZ8Lh.', 'test6762971339@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '2014-01-29 17:49:37', '2014-01-29 17:47:58', '2014-01-29 12:49:37'),
(30, 'test616604468', '$2a$08$1ETHC2tV9B43xgf15/MfuOjTeP3eGQPHOZCw8qnBKTPNmLwCzvUOe', 'test616604468@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '0000-00-00 00:00:00', '2014-01-29 17:47:58', '2014-01-29 12:47:58'),
(31, 'test7684590958', '$2a$08$PAU3wNLGQhHy/Hgpp8XvIeyY/ygoAL8JXBCTZlJkro/kMwIDFYlVq', 'test7684590958@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '0000-00-00 00:00:00', '2014-01-29 17:49:37', '2014-01-29 12:49:37'),
(32, 'test2836473184', '$2a$08$.pFjU.EdiEg9TRlrQC5XBOGgr.UKEOcvN1LIgaILMcsArJiJBw8bC', 'test2836473184@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '0000-00-00 00:00:00', '2014-01-29 17:49:37', '2014-01-29 12:49:37'),
(33, 'test2227977976', '$2a$08$5I9f6xApjOpHdWwH8nWMl.zysfoBkXTD9We6GYNEYZa.EMUEEdI7m', 'test2227977976@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '0000-00-00 00:00:00', '2014-01-29 17:49:52', '2014-01-29 12:49:52'),
(34, 'test2321226691', '$2a$08$KJjUT6t.G8X3QOSsVYUuk.O/Ok7Zsq4NXEmgbmKKCX83hWALMugOG', 'test2321226691@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '0000-00-00 00:00:00', '2014-01-29 17:49:52', '2014-01-29 12:49:52'),
(35, 'test2215465913', '$2a$08$G8j.pP/Aem3LikeTRD7cLOiU6USnS8DRBRn5SlOpKp1P9rWdRn36G', 'test2215465913@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '0000-00-00 00:00:00', '2014-01-29 17:52:21', '2014-01-29 12:52:21'),
(36, 'test535667431', '$2a$08$4g0SOhYyfIVkWOnL3sjbzO3cdVO4NXBVOPxaHCU3eyRzlmN1hqKkO', 'test535667431@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '0000-00-00 00:00:00', '2014-01-29 17:52:22', '2014-01-29 12:52:22'),
(37, 'test9593764611', '$2a$08$V2VBD65Yv1.FUSg6.GgZ0.V00pktvYiDyq12zdu5y7Q8MnyEJWUIm', 'test9593764611@gmail.com', 'Test', 'Test', 1, 0, NULL, '6443c10bbc84da9dd0bc70bfa3b36815', '2014-01-29 17:53:15', NULL, NULL, '203.135.63.151', '2014-01-29 17:53:15', '2014-01-29 17:52:55', '2014-01-29 12:53:15'),
(38, 'test711520349', '$2a$08$l0ixsqjd3l30l0UuqVxQ/eUQSF2U21fFjh5wacAcONlC/unrizvma', 'test711520349@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '0000-00-00 00:00:00', '2014-01-29 17:52:55', '2014-01-29 12:52:55'),
(39, 'test8998565294', '$2a$08$mpoJfbpIlIOr.ae6tNzZl.H6zawrH55UI6cVC.YSK7wNRWbQv/Tcy', 'test8998565294@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '2014-01-31 15:09:08', '2014-01-31 15:07:23', '2014-01-31 10:09:08'),
(40, 'test4877315569', '$2a$08$tGYFyc5xufn5QZjAMxSfb..Dtdis7tUsr3AV6.v6MJ6/duhqHmo76', 'test4877315569@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '0000-00-00 00:00:00', '2014-01-31 15:07:23', '2014-01-31 10:07:23'),
(41, 'test3451716386', '$2a$08$pNI3QLsnuC1YYdbHnx5Bt.QxZJjs5rbFBrZ0ORbfYA1PBNjyaFXRi', 'test3451716386@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '2014-01-31 15:28:21', '2014-01-31 15:15:54', '2014-01-31 10:28:21'),
(42, 'test9988870708', '$2a$08$1O.cAKlDn.YB/ocwq5dNMuJkjrqtbB5Rwk5/LmDVS2j.8mtK9V1VW', 'test9988870708@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '0000-00-00 00:00:00', '2014-01-31 15:15:54', '2014-01-31 10:15:54'),
(44, 'test2224965288', '$2a$08$SxUw5JEfVFahIJlQKyDCre3mwRwVT.iQmYhv.rmwEwyF2CwoElUM6', 'test2224965288@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '2014-01-31 16:56:45', '2014-01-31 16:27:45', '2014-01-31 11:56:45'),
(45, 'test3591378050', '$2a$08$jkpqJhTTTH0rrg.B5ko86OqsUkVA24jNlHl4dM/QpG6kQoDB9SqXe', 'test3591378050@gmail.com', 'Test', 'Test', 1, 0, NULL, NULL, NULL, NULL, NULL, '203.135.63.151', '0000-00-00 00:00:00', '2014-01-31 16:27:45', '2014-01-31 11:27:45'),
(46, 'abdullah', '$2a$08$8IlEUM2dEQBHNJgun90fT.0miJoQfvtsskcTw1xWZxEPG1Y/1d7hy', 'abdullahroshan17@gmail.com', 'Abdullah', 'Hamid', 1, 0, NULL, NULL, NULL, NULL, NULL, '10.103.3.233', '2014-01-31 17:24:06', '2014-01-31 17:18:35', '2014-01-31 12:46:23'),
(47, 'malik@123', '$2a$08$3MVatDH9TPYk.QpkP71YzevaBs37L3vHty3Ws7s5Y44jRKnmfp.Xe', 'zurmalik@gmail.com', 'Hafeez', 'Malik', 1, 0, NULL, NULL, NULL, NULL, NULL, '10.103.98.48', '2014-01-31 17:47:08', '2014-01-31 17:19:36', '2014-01-31 12:47:08'),
(48, 'apaa', '$2a$08$DPoDaLgnWveBb/volQNqHu4zavm.mb7eumVQoP5AqtYKlBtzMUXjC', 'info.cloneanalyzer@gmail.com', 'Zubaida', 'Apa', 1, 0, NULL, NULL, NULL, NULL, NULL, '10.103.0.243', '2014-01-31 17:46:33', '2014-01-31 17:23:57', '2014-01-31 12:46:33'),
(52, 'shahabhameed', '$2a$08$O4HeTts7z91EnmhpL15uC.hKIjRDoJ0Aj2LbDG3yv36M6nzOc9TXm', 'shahabhameed@gmail.com', 'Shahab', 'Hameed', 1, 0, NULL, NULL, NULL, NULL, NULL, '10.103.7.41', '2014-02-10 16:46:44', '2014-02-10 15:41:32', '2014-02-10 11:46:44'),
(53, 'umerhayat', '$2a$08$gapKloVEVS3pS2ASKvBaa.CBzmuENhnQfwWTi7D/kdNw2CdHHN9IS', 'umerhayat1@gmail.com', 'umer', 'hayat', 1, 0, NULL, NULL, NULL, NULL, NULL, '10.103.6.199', '2014-02-10 16:14:40', '2014-02-10 16:12:56', '2014-02-10 11:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_autologin`
--

INSERT INTO `user_autologin` (`key_id`, `user_id`, `user_agent`, `last_ip`, `last_login`) VALUES
('07c690bb48888fff312b5c6df6d5a27b', 25, 'Mozilla/5.0 (Windows NT 6.2; rv:26.0) Gecko/20100101 Firefox/26.0', '10.103.1.68', '2014-01-29 12:32:02'),
('3752c9623fd687bfd61de427fcfa4e65', 52, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36', '203.135.63.151', '2014-02-10 10:47:12'),
('66a6bb351fe712c511c0041e54747224', 37, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.102 Safari/537.36', '203.135.63.151', '2014-01-29 12:53:15'),
('73860baa23d760e15c498090dff5c88d', 22, 'Mozilla/5.0 (Windows NT 6.1; rv:26.0) Gecko/20100101 Firefox/26.0', '10.103.3.144', '2014-01-29 11:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_invocations`
--

CREATE TABLE IF NOT EXISTS `user_invocations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` int(2) NOT NULL,
  `invoked_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_invocations`
--

INSERT INTO `user_invocations` (`id`, `user_id`, `status`, `invoked_time`) VALUES
(2, 53, 2, '2014-02-10 16:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=46 ;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `country`, `website`, `modified`) VALUES
(1, 1, NULL, NULL, '2014-01-25 23:30:35'),
(16, 17, NULL, NULL, '2014-01-27 04:52:21'),
(17, 18, NULL, NULL, '2014-01-29 10:57:31'),
(18, 19, NULL, NULL, '2014-01-29 10:57:31'),
(19, 20, NULL, NULL, '2014-01-29 10:58:47'),
(20, 21, NULL, NULL, '2014-01-29 10:58:48'),
(21, 22, NULL, NULL, '2014-01-29 11:17:17'),
(22, 23, NULL, NULL, '2014-01-29 11:17:17'),
(23, 27, NULL, NULL, '2014-01-29 12:47:30'),
(24, 28, NULL, NULL, '2014-01-29 12:47:30'),
(25, 29, NULL, NULL, '2014-01-29 12:47:58'),
(26, 30, NULL, NULL, '2014-01-29 12:47:58'),
(27, 31, NULL, NULL, '2014-01-29 12:49:37'),
(28, 32, NULL, NULL, '2014-01-29 12:49:37'),
(29, 33, NULL, NULL, '2014-01-29 12:49:52'),
(30, 34, NULL, NULL, '2014-01-29 12:49:53'),
(31, 35, NULL, NULL, '2014-01-29 12:52:21'),
(32, 36, NULL, NULL, '2014-01-29 12:52:22'),
(33, 37, NULL, NULL, '2014-01-29 12:52:55'),
(34, 38, NULL, NULL, '2014-01-29 12:52:55'),
(35, 39, NULL, NULL, '2014-01-31 10:07:23'),
(36, 40, NULL, NULL, '2014-01-31 10:07:23'),
(37, 41, NULL, NULL, '2014-01-31 10:15:54'),
(38, 42, NULL, NULL, '2014-01-31 10:15:54'),
(39, 44, NULL, NULL, '2014-01-31 11:27:45'),
(40, 45, NULL, NULL, '2014-01-31 11:27:45'),
(41, 46, NULL, NULL, '2014-01-31 12:18:45'),
(42, 48, NULL, NULL, '2014-01-31 12:24:22'),
(43, 47, NULL, NULL, '2014-01-31 12:28:43'),
(44, 52, NULL, NULL, '2014-02-10 10:42:03'),
(45, 53, NULL, NULL, '2014-02-10 11:14:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_repository`
--

CREATE TABLE IF NOT EXISTS `user_repository` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `repository_name` varchar(100) NOT NULL,
  `creation_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_repository`
--

INSERT INTO `user_repository` (`id`, `user_id`, `repository_name`, `creation_time`) VALUES
(2, 52, 'C:/xampp/htdocs/Team2/Clonify3/files/shahabhameed/', '2014-02-10 15:42:03'),
(3, 53, 'C:/xampp/htdocs/Team2/Clonify3/files/umerhayat/', '2014-02-10 16:14:20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
