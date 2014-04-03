
-- ADD ON 2014-02-20, ADDED BY Hafeez
ALTER TABLE users ADD COLUMN role_id int(11);
ALTER TABLE invocation_parameters ADD COLUMN language_id int(11);

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `role` (`id`, `role_name`) VALUES
(1, 'Admin');


-- ADDED ON 2014-02-21, BY Shahram

CREATE TABLE IF NOT EXISTS `scc_invocation` (
  `scc_id` int(11) NOT NULL,
  `invocation_id` int(11) NOT NULL,
  KEY `scc_id` (`scc_id`),
  KEY `invocation_id` (`invocation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scscrossfile_file`
--

CREATE TABLE IF NOT EXISTS `scscrossfile_file` (
  `scs_crossfile_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `tc` double NOT NULL,
  `pc` double NOT NULL,
  `invocation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scscrossfile_scc`
--

CREATE TABLE IF NOT EXISTS `scscrossfile_scc` (
  `scc_id` int(11) NOT NULL,
  `scs_crossfile_id` int(11) NOT NULL,
  `invocation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scsinfile_file`
--

CREATE TABLE IF NOT EXISTS `scsinfile_file` (
  `scs_infile_id` int(11) NOT NULL,
  `invocation_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `members` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scsinfile_fragments`
--

CREATE TABLE IF NOT EXISTS `scsinfile_fragments` (
  `scs_infile_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `scc_id` int(11) NOT NULL,
  `scsinfile_instance_id` int(11) NOT NULL,
  `scc_instance_id` int(11) NOT NULL,
  `invocation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scsinfile_scc`
--

CREATE TABLE IF NOT EXISTS `scsinfile_scc` (
  `scc_id` int(11) NOT NULL,
  `scs_infile_id` int(11) NOT NULL,
  `invocation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scs_crossfile`
--

CREATE TABLE IF NOT EXISTS `scs_crossfile` (
  `scs_crossfile_id` int(11) NOT NULL,
  `invocation_id` int(11) NOT NULL,
  `atc` double NOT NULL,
  `apc` double NOT NULL,
  `members` int(11) NOT NULL,
  PRIMARY KEY (`scs_crossfile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ADDED ON 2014-02-24 0, BY Hafeez
ALTER TABLE invocation_files ADD COLUMN group_id int(11) NOT NULL;
ALTER TABLE user_invocations ADD COLUMN language_id int(11) NOT NULL;
ALTER TABLE user_invocations ADD COLUMN invocation_name varchar(250) NOT NULL;
ALTER TABLE user_invocations ADD COLUMN comments varchar(1024) NOT NULL;

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ADDED ON 2014-02-27 0, BY HAFEEZ
ALTER TABLE scc_instance ADD COLUMN invocation_id int(11);

CREATE TABLE IF NOT EXISTS `clones_by_file` (
  `invocation_id` int(11) NOT NULL,
  `line_num` int(11) NOT NULL,
  `value` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `clones_by_file_normal` (
  `invocation_id` int(11) NOT NULL,
  `line_num` int(11) NOT NULL,
  `value` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `clones_by_method` (
  `invocation_id` int(11) NOT NULL,
  `line_num` int(11) NOT NULL,
  `value` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `clones_by_method_normal` (
  `invocation_id` int(11) NOT NULL,
  `line_num` int(11) NOT NULL,
  `value` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ADDED ON 2014-02-27 1, BY HAFEEZ

CREATE TABLE IF NOT EXISTS `clones_rnr` (
  `invocation_id` int(11) NOT NULL,
  `line_num` int(11) NOT NULL,
  `value` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 06 Mar 2014
ALTER TABLE  `invocation_parameters` ADD  `min_similarity_MCC_tokens` INT NULL ,
ADD  `min_similarity_MCC_percentage` INT NULL ;

-- 11 Mar 2014
-- MCC Tables Added
-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2014 at 01:11 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `mcc_instance`
--

CREATE TABLE IF NOT EXISTS `mcc_instance` (
  `mcc_instance_id` int(11) NOT NULL,
  `mcc_id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `tc` double NOT NULL,
  `pc` double NOT NULL,
  `fid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `gid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `mcc_scc` (
  `mcc_id` int(11) NOT NULL,
  `scc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `mcc` (
  `mcc_id` int(11) NOT NULL,
  `atc` double NOT NULL,
  `apc` double NOT NULL,
  PRIMARY KEY (`mcc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE  `mcc` ADD  `invocation_id` INT( 11 ) NOT NULL ;

-- ADDED ON 2014-03-11 0, BY HAFEEZ
ALTER TABLE scs_crossfile DROP PRIMARY KEY;
ALTER TABLE mcc DROP PRIMARY KEY;

CREATE TABLE IF NOT EXISTS `method_file` (
  `mid` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `startline` int(11) NOT NULL,
  `endline` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `method` (
  `mid` int(11) NOT NULL,
  `mname` varchar(100) NOT NULL,
  `tokens` int(11) NOT NULL,
  `startline` int(11) NOT NULL,
  `endline` int(11) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- ADDED ON 2014-03-18 0
ALTER TABLE  `mcc` ADD `members` INT( 11 ) NOT NULL ;

-- ADDED ON 2014-03-21 0 Directory ID related
ALTER TABLE invocation_files ADD cmdirectory_id int(11);

-- ADDED ON 2014-03-22 0 By Hafeez

CREATE TABLE IF NOT EXISTS `mcscrossfile_methods` (
  `mcs_crossfile_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `mcc_id` int(11) NOT NULL,
  `mid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `scscrossmethod_scc` (
  `scs_crossmethod_id` int(11) NOT NULL,
  `scc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `scs_crossmethod` (
  `scs_crossmethod_id` int(11) NOT NULL,
  `atc` double NOT NULL,
  `apc` double NOT NULL,
  `members` int(11) NOT NULL,
  PRIMARY KEY (`scs_crossmethod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `scscrossmethod_method` (
  `scs_crossmethod_id` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `tc` double NOT NULL,
  `pc` double NOT NULL,
  `fid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `gid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `mcc_file` (
  `mcc_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `mcscrossfile_file` (
  `mcs_crossfile_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `gid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `mcscrossfile_mcc` (
  `mcs_crossfile_id` int(11) NOT NULL,
  `mcc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE mcc_instance ADD COLUMN invocation_id int(11);

CREATE TABLE IF NOT EXISTS `mcs_crossfile` (
  `mcs_crossfile_id` int(11) NOT NULL,
  `members` int(11) NOT NULL,
  PRIMARY KEY (`mcs_crossfile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE mcs_crossfile DROP PRIMARY KEY;

-- ADDED ON 2014-03-23 0 By Hafeez
ALTER TABLE mcscrossfile_methods ADD COLUMN invocation_id int(11);
ALTER TABLE scscrossmethod_scc ADD COLUMN invocation_id int(11);
ALTER TABLE scs_crossmethod ADD COLUMN invocation_id int(11);
ALTER TABLE scscrossmethod_method ADD COLUMN invocation_id int(11);
ALTER TABLE mcc_file ADD COLUMN invocation_id int(11);
ALTER TABLE mcscrossfile_file ADD COLUMN invocation_id int(11);
ALTER TABLE mcscrossfile_mcc ADD COLUMN invocation_id int(11);
ALTER TABLE mcs_crossfile ADD COLUMN invocation_id int(11);
ALTER TABLE method ADD COLUMN invocation_id int(11);
ALTER TABLE mcc_scc ADD COLUMN invocation_id int(11);
ALTER TABLE method_file ADD COLUMN invocation_id int(11);

-- 
ALTER TABLE mcc DROP PRIMARY KEY;
ALTER TABLE scs_crossmethod DROP PRIMARY KEY;
ALTER TABLE method DROP PRIMARY KEY;



-- ADDED ON 2014-03-23

-- --------------------------------------------------------

--
-- Table structure for table `fcs_crossdir_fcc`
--

CREATE TABLE IF NOT EXISTS `fcc_instance` (
  `invocation_id` int(11) NOT NULL,
  `fcc_instance_id` int(11) NOT NULL,
  `fcc_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  `tc` double NOT NULL,
  `pc` double NOT NULL,
  `did` int(11) NOT NULL,
  `gid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `fcs_crossdir`
--

CREATE TABLE IF NOT EXISTS `fcs_crossdir` (
  `invocation_id` int(11) NOT NULL,
  `fcs_crossdir_id` int(11) NOT NULL,
  `members` int(11) NOT NULL,
  `directory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fcs_crossdir_fcc`
--

CREATE TABLE IF NOT EXISTS `fcs_crossdir_fcc` (
  `invocation_id` int(11) NOT NULL,
  `fcs_crossdir_id` int(11) NOT NULL,
  `fcc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fcs_crossdir_files`
--

CREATE TABLE IF NOT EXISTS `fcs_crossdir_files` (
  `invocation_id` int(11) NOT NULL,
  `fcs_crossdir_id` int(11) NOT NULL,
  `fcc_id` int(11) NOT NULL,
  `directory_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fcs_crossgroup`
--

CREATE TABLE IF NOT EXISTS `fcs_crossgroup` (
  `invocation_id` int(11) NOT NULL,
  `fcs_crossgroup_id` int(11) NOT NULL,
  `members` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fcs_crossgroup_fcc`
--

CREATE TABLE IF NOT EXISTS `fcs_crossgroup_fcc` (
  `invocation_id` int(11) NOT NULL,
  `fcs_crossgroup_id` int(11) NOT NULL,
  `fcc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fcs_crossgroup_files`
--

CREATE TABLE IF NOT EXISTS `fcs_crossgroup_files` (
  `invocation_id` int(11) NOT NULL,
  `fcs_crossgroup_id` int(11) NOT NULL,
  `fcc_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fcs_withindir`
--

CREATE TABLE IF NOT EXISTS `fcs_withindir` (
  `invocation_id` int(11) NOT NULL,
  `fcs_indir_id` int(11) NOT NULL,
  `members` int(11) NOT NULL,
  `directory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fcs_withindir_fcc`
--

CREATE TABLE IF NOT EXISTS `fcs_withindir_fcc` (
  `invocation_id` int(11) NOT NULL,
  `fcs_indir_id` int(11) NOT NULL,
  `fcc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fcs_withindir_files`
--

CREATE TABLE IF NOT EXISTS `fcs_withindir_files` (
  `invocation_id` int(11) NOT NULL,
  `fcs_indir_id` int(11) NOT NULL,
  `fcc_id` int(11) NOT NULL,
  `fcsindir_instance_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fcs_withingroup`
--

CREATE TABLE IF NOT EXISTS `fcs_withingroup` (
  `invocation_id` int(11) NOT NULL,
  `fcs_ingroup_id` int(11) NOT NULL,
  `members` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `fcs_withingroup_fcc`
--

CREATE TABLE IF NOT EXISTS `fcs_withingroup_fcc` (
  `invocation_id` int(11) NOT NULL,
  `fcs_ingroup_id` int(11) NOT NULL,
  `fcc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `fcs_withingroup_files`
--

CREATE TABLE IF NOT EXISTS `fcs_withingroup_files` (
  `invocation_id` int(11) NOT NULL,
  `fcs_ingroup_id` int(11) NOT NULL,
  `fcc_id` int(11) NOT NULL,
  `fcsingroup_instance_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 2014-03-25 0 By HAFEEZ

CREATE TABLE IF NOT EXISTS `scc_method` (
  `scc_id` int(11) NOT NULL,
  `mid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 2014-03-25 0 By UMER
ALTER TABLE  `scc_method` ADD  `invocation_id` INT NOT NULL ;

-- 2014-03-30 BY Shahram


CREATE TABLE IF NOT EXISTS `fcc` (
  `invocation_id` int(11) NOT NULL,
	`fcc_id` int(11) NOT NULL,
  `atc` double NOT NULL,
  `apc` double NOT NULL,
  `members` int(11) NOT NULL  
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `fcc_instance` (
  `invocation_id` int(11) NOT NULL,
	`fcc_instance_id` int(11) NOT NULL,
  `fcc_id` int(11) NOT NULL,  
  `tc` double NOT NULL,
  `pc` double NOT NULL,
	`file_id` int(11) NOT NULL,
  `directory_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `fcc_scc` (
  `invocation_id` int(11) NOT NULL,
	`scc_id` int(11) NOT NULL,
  `fcc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `fcc_by_directory` (
  `invocation_id` int(11) NOT NULL,
	`fcc_id` int(11) NOT NULL,
  `directory_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `fcc_by_group` (
  `invocation_id` int(11) NOT NULL,
	`fcc_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2014-03-27 0 By UMER
ALTER TABLE  `user_invocations` ADD  `repository_version` INT NOT NULL AFTER  `invocation_name` ;

-- 2014-03-27 0 By ABDULLAH
ALTER TABLE  `user_repository` ADD  `version` INT NOT NULL ;

-- 2014-03-29 9 By Hafeez
CREATE TABLE IF NOT EXISTS `language_extensions` (
  `language_id` int(11) NOT NULL,
  `extension` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `language_extensions` (`language_id`, `extension`) VALUES
(1, 'JAVA'),
(2, 'CPP'),
(2, 'H'),
(2, 'C');


-- 2014-04-03 0 By ABDULLAH
ALTER TABLE  `repository_directory` ADD  `parent_id` INT NULL ;