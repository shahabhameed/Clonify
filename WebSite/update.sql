
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
