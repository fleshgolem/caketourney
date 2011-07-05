-- phpMyAdmin SQL Dump
-- version 2.11.9.6
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Erstellungszeit: 03. Juli 2011 um 18:31
-- Server Version: 5.0.51
-- PHP-Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `caketourney`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL auto_increment,
  `match_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `date_posted` datetime NOT NULL,
  `edit_reason` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=409 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `invitations`
--

CREATE TABLE IF NOT EXISTS `invitations` (
  `id` int(11) NOT NULL auto_increment,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
  `id` int(11) NOT NULL auto_increment,
  `round_id` int(11) NOT NULL,
  `player1_id` int(11) default NULL,
  `player2_id` int(11) default NULL,
  `games` int(11) default NULL,
  `player1_score` int(11) default NULL,
  `player2_score` int(11) default NULL,
  `open` tinyint(1) NOT NULL,
  `number_in_round` int(11) NOT NULL,
  `date` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=346 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL auto_increment,
  `recipient_id` int(11) NOT NULL,
  `sender_id` int(11) default NULL,
  `title` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `read` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  `reply` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=183 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `date_posted` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `edit_reason` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `date_posted` datetime NOT NULL,
  `body` text NOT NULL,
  `edit_reason` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=196 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rankings`
--

CREATE TABLE IF NOT EXISTS `rankings` (
  `id` int(11) NOT NULL auto_increment,
  `tournament_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `match_points` int(11) NOT NULL,
  `elo` int(11) default NULL,
  `bye` tinyint(1) NOT NULL,
  `wins` int(11) NOT NULL,
  `draws` int(11) NOT NULL,
  `defeats` int(11) NOT NULL,
  `away` tinyint(1) NOT NULL,
  `oppscore` int(11) default NULL,
  `oppoppscore` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=239 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `replays`
--

CREATE TABLE IF NOT EXISTS `replays` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `size` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=185 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rounds`
--

CREATE TABLE IF NOT EXISTS `rounds` (
  `id` int(11) NOT NULL auto_increment,
  `number` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `signups`
--

CREATE TABLE IF NOT EXISTS `signups` (
  `id` int(11) NOT NULL auto_increment,
  `tournament_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL auto_increment,
  `leader_id` int(11) NOT NULL,
  `team_type` varchar(13) default NULL,
  `name` varchar(100) NOT NULL,
  `logo_name` varchar(100) default 'default',
  `logo_size` int(13) default NULL,
  `logo_type` varchar(100) default NULL,
  `date_created` datetime NOT NULL,
  `elo` int(11) NOT NULL default '1000',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teamtournaments`
--

CREATE TABLE IF NOT EXISTS `teamtournaments` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `typeField` varchar(50) NOT NULL,
  `typeAlias` int(11) NOT NULL,
  `team_type` varchar(50) NOT NULL,
  `currend_round` int(11) default NULL,
  `ranked` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `threads`
--

CREATE TABLE IF NOT EXISTS `threads` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `date_modified` datetime NOT NULL,
  `original_poster_id` int(11) NOT NULL,
  `last_poster_id` int(11) NOT NULL,
  `icon` varchar(200) default 'default',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tournaments`
--

CREATE TABLE IF NOT EXISTS `tournaments` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `typeField` varchar(20) NOT NULL,
  `typeAlias` int(11) NOT NULL,
  `current_round` int(11) default NULL,
  `ranked` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `lastlogin` datetime default NULL,
  `name` varchar(100) default NULL,
  `email` varchar(200) default NULL,
  `username` varchar(50) default NULL,
  `password` varchar(42) default NULL,
  `bnetaccount` varchar(50) NOT NULL,
  `bnetcode` int(3) NOT NULL,
  `race` varchar(20) NOT NULL,
  `admin` tinyint(1) NOT NULL default '0',
  `elo` int(11) NOT NULL default '1000',
  `division` varchar(50) default NULL,
  `subscribe_own_comments` tinyint(1) NOT NULL default '1',
  `subscribe_own_posts` tinyint(1) NOT NULL default '1',
  `subscribe_tournaments` tinyint(1) NOT NULL default '1',
  `avatar_name` varchar(100) NOT NULL default 'default',
  `avatar_type` varchar(100) default NULL,
  `avatar_size` int(11) default NULL,
  `email_subscriptions` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users_teams`
--

CREATE TABLE IF NOT EXISTS `users_teams` (
  `id` int(11) NOT NULL auto_increment,
  `team_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users_tournaments`
--

CREATE TABLE IF NOT EXISTS `users_tournaments` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=191 ;
