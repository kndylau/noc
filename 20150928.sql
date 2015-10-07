CREATE TABLE `userpref` (
  `user` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(200) NOT NULL,
  PRIMARY KEY  (`user`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
