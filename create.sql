-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- Хост: localhost
-- Время создания: Май 25 2010 г., 00:07
-- Версия сервера: 5.0.45
-- Версия PHP: 5.2.4
-- 
-- БД: `jeka`
-- 
DROP DATABASE `jeka`;
CREATE DATABASE `jeka` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE jeka;

-- --------------------------------------------------------

-- 
-- Структура таблицы `character`
-- 

CREATE TABLE `character` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `user_id` int(7) unsigned NOT NULL,
  `profession` int(2) NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL,
  `parent` int(5) NOT NULL,
  `lvl` tinyint(3) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Дамп данных таблицы `character`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `clans`
-- 

CREATE TABLE `clans` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `cl_id` int(2) unsigned NOT NULL,
  `clan_lvl` int(2) unsigned NOT NULL,
  `server` varchar(32) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`cl_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- 
-- Дамп данных таблицы `clans`
-- 

INSERT INTO `clans` VALUES (5, 'fir', 1, 2, NULL);
INSERT INTO `clans` VALUES (6, 'dd', 6, 4, NULL);
INSERT INTO `clans` VALUES (7, 'sdfsdf', 9, 3, NULL);
INSERT INTO `clans` VALUES (8, 't34', 11, 8, NULL);
INSERT INTO `clans` VALUES (9, '454', 14, 4, NULL);
INSERT INTO `clans` VALUES (12, 'fallens', 5, 8, '0');
INSERT INTO `clans` VALUES (14, 'fl', 4, 5, '0');
INSERT INTO `clans` VALUES (15, 'test', 8, 7, '0');
INSERT INTO `clans` VALUES (17, 'FallenS', 18, 5, 'Ramsheart');
INSERT INTO `clans` VALUES (18, 'ded', 19, 7, 'servak x7');

-- --------------------------------------------------------

-- 
-- Структура таблицы `mail_confirm`
-- 

CREATE TABLE `mail_confirm` (
  `user_id` int(7) unsigned NOT NULL,
  `mail_hash` varchar(32) NOT NULL,
  `day` int(2) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Дамп данных таблицы `mail_confirm`
-- 

INSERT INTO `mail_confirm` VALUES (15, 'bd6487e78f78fe8cd77fddafc2c1536b', 3);
INSERT INTO `mail_confirm` VALUES (13, '273a82701f48e35a38088abb6027f022', 3);

-- --------------------------------------------------------

-- 
-- Структура таблицы `notifications`
-- 

CREATE TABLE `notifications` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `user_id` int(5) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `describe` varchar(255) NOT NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

-- 
-- Дамп данных таблицы `notifications`
-- 

INSERT INTO `notifications` VALUES (2, 2, 'Welcome', 'Your was register in our site', '2010-01-30 06:39:37');
INSERT INTO `notifications` VALUES (3, 3, 'Welcome', 'Your was register in our site', '2010-01-30 07:12:39');
INSERT INTO `notifications` VALUES (4, 4, 'Welcome', 'Your was register in our site', '2010-01-30 08:00:33');
INSERT INTO `notifications` VALUES (5, 4, 'Mail Confirm', 'Yor mail was validated', '2010-01-30 08:02:00');
INSERT INTO `notifications` VALUES (6, 4, 'Profile', 'Yor profile was updated', '2010-01-30 08:05:05');
INSERT INTO `notifications` VALUES (7, 1, 'Profile', 'Yor profile was updated', '2010-02-01 21:23:43');
INSERT INTO `notifications` VALUES (8, 1, 'Profile', 'Yor profile was updated', '2010-02-01 22:06:07');
INSERT INTO `notifications` VALUES (9, 5, 'Welcome', 'Your was register in our site', '2010-02-02 12:56:19');
INSERT INTO `notifications` VALUES (10, 5, 'Profile', 'Yor profile was updated', '2010-02-02 12:57:00');
INSERT INTO `notifications` VALUES (11, 5, 'Mail Confirm', 'Yor mail was validated', '2010-02-02 12:58:08');
INSERT INTO `notifications` VALUES (12, 6, 'Welcome', 'Your was register in our site', '2010-02-02 19:08:25');
INSERT INTO `notifications` VALUES (13, 6, 'Profile', 'Yor profile was updated', '2010-02-02 19:08:54');
INSERT INTO `notifications` VALUES (14, 6, 'Mail Confirm', 'Yor mail was validated', '2010-02-02 19:09:18');
INSERT INTO `notifications` VALUES (15, 7, 'Welcome', 'Your was register in our site', '2010-02-03 16:35:28');
INSERT INTO `notifications` VALUES (16, 8, 'Welcome', 'Your was register in our site', '2010-02-03 16:44:48');
INSERT INTO `notifications` VALUES (17, 8, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 16:45:27');
INSERT INTO `notifications` VALUES (18, 9, 'Welcome', 'Your was register in our site', '2010-02-03 16:49:42');
INSERT INTO `notifications` VALUES (19, 9, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 16:51:06');
INSERT INTO `notifications` VALUES (20, 10, 'Welcome', 'Your was register in our site', '2010-02-03 16:57:28');
INSERT INTO `notifications` VALUES (21, 10, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 16:57:49');
INSERT INTO `notifications` VALUES (22, 10, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 17:00:30');
INSERT INTO `notifications` VALUES (23, 10, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 17:02:24');
INSERT INTO `notifications` VALUES (24, 10, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 17:05:23');
INSERT INTO `notifications` VALUES (25, 10, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 17:07:40');
INSERT INTO `notifications` VALUES (26, 10, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 17:11:49');
INSERT INTO `notifications` VALUES (27, 10, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 17:13:23');
INSERT INTO `notifications` VALUES (28, 10, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 17:14:21');
INSERT INTO `notifications` VALUES (29, 10, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 17:15:30');
INSERT INTO `notifications` VALUES (30, 10, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 17:19:13');
INSERT INTO `notifications` VALUES (31, 10, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 17:21:16');
INSERT INTO `notifications` VALUES (32, 10, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 17:22:22');
INSERT INTO `notifications` VALUES (33, 10, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 17:23:05');
INSERT INTO `notifications` VALUES (34, 11, 'Welcome', 'Your was register in our site', '2010-02-03 17:24:27');
INSERT INTO `notifications` VALUES (35, 11, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 17:24:45');
INSERT INTO `notifications` VALUES (36, 12, 'Welcome', 'Your was register in our site', '2010-02-03 19:22:37');
INSERT INTO `notifications` VALUES (37, 12, 'Profile', 'Yor profile was updated', '2010-02-03 19:22:49');
INSERT INTO `notifications` VALUES (38, 12, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 19:23:10');
INSERT INTO `notifications` VALUES (39, 13, 'Welcome', 'Your was register in our site', '2010-02-03 19:27:55');
INSERT INTO `notifications` VALUES (40, 14, 'Welcome', 'Your was register in our site', '2010-02-03 19:30:12');
INSERT INTO `notifications` VALUES (41, 14, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 19:30:28');
INSERT INTO `notifications` VALUES (42, 14, 'Profile', 'Yor profile was updated', '2010-02-03 19:30:45');
INSERT INTO `notifications` VALUES (43, 14, 'Password reset', 'Yor password was reseted', '2010-02-03 19:31:47');
INSERT INTO `notifications` VALUES (44, 14, 'Password reset', 'Yor password was reseted', '2010-02-03 19:49:19');
INSERT INTO `notifications` VALUES (45, 15, 'Welcome', 'Your was register in our site', '2010-02-03 19:54:43');
INSERT INTO `notifications` VALUES (46, 16, 'Welcome', 'Your was register in our site', '2010-02-03 19:58:31');
INSERT INTO `notifications` VALUES (47, 16, 'Password reset', 'Yor password was reseted', '2010-02-03 20:07:25');
INSERT INTO `notifications` VALUES (48, 16, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 20:08:28');
INSERT INTO `notifications` VALUES (49, 17, 'Welcome', 'Your was register in our site', '2010-02-03 20:10:18');
INSERT INTO `notifications` VALUES (50, 17, 'Mail Confirm', 'Yor mail was validated', '2010-02-03 20:10:38');
INSERT INTO `notifications` VALUES (51, 6, 'Password reset', 'Yor password was reseted', '2010-02-03 20:40:56');
INSERT INTO `notifications` VALUES (52, 1, 'Profile', 'Yor profile was updated', '2010-02-03 21:11:48');
INSERT INTO `notifications` VALUES (53, 1, 'Profile', 'Yor profile was updated', '2010-02-03 21:12:42');
INSERT INTO `notifications` VALUES (54, 1, 'Profile', 'Yor profile was updated', '2010-02-03 21:13:41');
INSERT INTO `notifications` VALUES (55, 8, 'Clan created', 'Yor successful created clan - test', '2010-02-04 17:20:34');
INSERT INTO `notifications` VALUES (56, 18, 'Welcome', 'Your was register in our site', '2010-02-04 18:13:08');
INSERT INTO `notifications` VALUES (57, 18, 'Mail Confirm', 'Yor mail was validated', '2010-02-04 18:13:29');
INSERT INTO `notifications` VALUES (58, 18, 'Profile', 'Yor profile was updated', '2010-02-04 18:26:19');
INSERT INTO `notifications` VALUES (59, 18, 'Clan created', 'Yor successful created clan - Ramseart x5', '2010-02-04 18:27:22');
INSERT INTO `notifications` VALUES (60, 18, 'Clan created', 'Yor successful created clan - FallenS', '2010-02-04 18:30:32');
INSERT INTO `notifications` VALUES (61, 19, 'Welcome', 'Your was register in our site', '2010-02-04 18:46:53');
INSERT INTO `notifications` VALUES (62, 19, 'Mail Confirm', 'Yor mail was validated', '2010-02-04 18:47:09');
INSERT INTO `notifications` VALUES (63, 19, 'Clan created', 'Yor successful created clan - ded', '2010-02-04 18:47:39');
INSERT INTO `notifications` VALUES (64, 1, 'Clan join request', 'Yor request to join clan', '2010-02-04 21:22:34');
INSERT INTO `notifications` VALUES (65, 1, 'Clan join request', 'Yor request to join clan', '2010-02-04 21:23:31');
INSERT INTO `notifications` VALUES (66, 1, 'Clan join request', 'Yor request to join clan', '2010-02-04 21:26:07');
INSERT INTO `notifications` VALUES (67, 1, 'Clan join request', 'Yor request to join clan', '2010-02-04 21:28:05');
INSERT INTO `notifications` VALUES (68, 1, 'Clan join request', 'Yor request to join clan', '2010-02-04 21:30:55');
INSERT INTO `notifications` VALUES (69, 1, 'Clan join request', 'Yor request to join clan', '2010-02-04 21:32:03');
INSERT INTO `notifications` VALUES (70, 10, 'Clan join request', 'Yor request to join clan', '2010-02-04 21:34:42');
INSERT INTO `notifications` VALUES (71, 1, 'Clan join request', 'Yor request to join clan', '2010-02-04 22:17:16');

-- --------------------------------------------------------

-- 
-- Структура таблицы `professions`
-- 

CREATE TABLE `professions` (
  `id` int(3) unsigned NOT NULL auto_increment,
  `rass` enum('hum','elf','delf','orc','dwarf','kam') default NULL,
  `class` enum('fig','mys') default NULL,
  `prof_name` varchar(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

-- 
-- Дамп данных таблицы `professions`
-- 

INSERT INTO `professions` VALUES (1, 'hum', 'fig', 'warlord');
INSERT INTO `professions` VALUES (2, 'hum', 'fig', 'gladiator');
INSERT INTO `professions` VALUES (3, 'hum', 'fig', 'Paladin');
INSERT INTO `professions` VALUES (4, 'hum', 'fig', 'Dark Avenger');
INSERT INTO `professions` VALUES (5, 'hum', 'fig', 'Treasure Hunter');
INSERT INTO `professions` VALUES (6, 'hum', 'fig', 'Hawkeye');
INSERT INTO `professions` VALUES (7, 'hum', 'fig', 'Dreadnought');
INSERT INTO `professions` VALUES (8, 'hum', 'fig', 'Duelist');
INSERT INTO `professions` VALUES (9, 'hum', 'fig', 'Phoneix Knight');
INSERT INTO `professions` VALUES (10, 'hum', 'fig', 'Hell Knight');
INSERT INTO `professions` VALUES (11, 'hum', 'fig', 'Adventurer');
INSERT INTO `professions` VALUES (12, 'hum', 'fig', 'Sagittarius');
INSERT INTO `professions` VALUES (13, 'hum', 'mys', 'Sorcerer');
INSERT INTO `professions` VALUES (14, 'hum', 'mys', 'Necromancer');
INSERT INTO `professions` VALUES (15, 'hum', 'mys', 'Warlock');
INSERT INTO `professions` VALUES (16, 'hum', 'mys', 'Bishop');
INSERT INTO `professions` VALUES (17, 'hum', 'mys', 'Prophet');
INSERT INTO `professions` VALUES (18, 'hum', 'mys', 'Archemage');
INSERT INTO `professions` VALUES (19, 'hum', 'mys', 'Soultaker');
INSERT INTO `professions` VALUES (20, 'hum', 'mys', 'Arcana Lord');
INSERT INTO `professions` VALUES (21, 'hum', 'mys', 'Cardinal');
INSERT INTO `professions` VALUES (22, 'hum', 'mys', 'Hierophant');
INSERT INTO `professions` VALUES (23, 'elf', 'fig', 'Temple Knight');
INSERT INTO `professions` VALUES (24, 'elf', 'fig', 'Sword Singer');
INSERT INTO `professions` VALUES (25, 'elf', 'fig', 'Plainswalker');
INSERT INTO `professions` VALUES (26, 'elf', 'fig', 'Silver Ranger');
INSERT INTO `professions` VALUES (27, 'elf', 'fig', 'Evas Templar');
INSERT INTO `professions` VALUES (28, 'elf', 'fig', 'Sword Muse');
INSERT INTO `professions` VALUES (29, 'elf', 'fig', 'Wind Rider');
INSERT INTO `professions` VALUES (30, 'elf', 'fig', 'Moonlightsentinel');
INSERT INTO `professions` VALUES (31, 'elf', 'mys', 'Spellsinger');
INSERT INTO `professions` VALUES (32, 'elf', 'mys', 'Elemental Summoner');
INSERT INTO `professions` VALUES (33, 'elf', 'mys', 'Elven Elder');
INSERT INTO `professions` VALUES (34, 'elf', 'mys', 'Mystic Muse');
INSERT INTO `professions` VALUES (35, 'elf', 'mys', 'Elemental Master');
INSERT INTO `professions` VALUES (36, 'elf', 'mys', 'Evas Seint');
INSERT INTO `professions` VALUES (37, 'delf', 'fig', 'Shillien Knight');
INSERT INTO `professions` VALUES (38, 'delf', 'fig', 'Blade Dancer');
INSERT INTO `professions` VALUES (39, 'delf', 'fig', 'Abyss Walker');
INSERT INTO `professions` VALUES (40, 'delf', 'fig', 'Phantom Ranger');
INSERT INTO `professions` VALUES (41, 'delf', 'fig', 'Shillien Templar');
INSERT INTO `professions` VALUES (42, 'delf', 'fig', 'Spectral Dancer');
INSERT INTO `professions` VALUES (43, 'delf', 'fig', 'Ghost Hunter');
INSERT INTO `professions` VALUES (44, 'delf', 'fig', 'Ghost Sentinel');
INSERT INTO `professions` VALUES (45, 'delf', 'mys', 'Phantom Summoner');
INSERT INTO `professions` VALUES (46, 'delf', 'mys', 'Spellhowler');
INSERT INTO `professions` VALUES (47, 'delf', 'mys', 'Shillien Elder');
INSERT INTO `professions` VALUES (48, 'delf', 'mys', 'Storm Screamer');
INSERT INTO `professions` VALUES (49, 'delf', 'mys', 'Spectral Master');
INSERT INTO `professions` VALUES (50, 'delf', 'mys', 'Shillien Saint');
INSERT INTO `professions` VALUES (51, 'orc', 'fig', 'Destroyer');
INSERT INTO `professions` VALUES (52, 'orc', 'fig', 'Tyrant');
INSERT INTO `professions` VALUES (53, 'orc', 'fig', 'Titan');
INSERT INTO `professions` VALUES (54, 'orc', 'fig', 'Grand Khavatari');
INSERT INTO `professions` VALUES (55, 'orc', 'mys', 'Overlord');
INSERT INTO `professions` VALUES (56, 'orc', 'mys', 'Warcryer');
INSERT INTO `professions` VALUES (57, 'orc', 'mys', 'Dominator');
INSERT INTO `professions` VALUES (58, 'orc', 'mys', 'Doomcrayer');
INSERT INTO `professions` VALUES (59, 'dwarf', 'fig', 'Bounty Hunter');
INSERT INTO `professions` VALUES (60, 'dwarf', 'fig', 'Fortune Seeker');
INSERT INTO `professions` VALUES (61, 'dwarf', 'fig', 'Warsmith');
INSERT INTO `professions` VALUES (62, 'dwarf', 'fig', 'Maestro');
INSERT INTO `professions` VALUES (63, 'kam', 'fig', 'Berserker');
INSERT INTO `professions` VALUES (64, 'kam', 'fig', 'Doombringer');
INSERT INTO `professions` VALUES (65, 'kam', 'fig', 'Inspector');
INSERT INTO `professions` VALUES (66, 'kam', 'fig', 'Judicator');
INSERT INTO `professions` VALUES (67, 'kam', 'fig', 'Soul Breaker');
INSERT INTO `professions` VALUES (68, 'kam', 'fig', 'Soul Hound');
INSERT INTO `professions` VALUES (69, 'kam', 'mys', 'Inspector');
INSERT INTO `professions` VALUES (70, 'kam', 'mys', 'Judicator');
INSERT INTO `professions` VALUES (71, 'kam', 'mys', 'Arbalester');
INSERT INTO `professions` VALUES (72, 'kam', 'mys', 'Trickster');
INSERT INTO `professions` VALUES (73, 'kam', 'mys', 'Soul Breaker');
INSERT INTO `professions` VALUES (74, 'kam', 'mys', 'Soul Hound');

-- --------------------------------------------------------

-- 
-- Структура таблицы `request`
-- 

CREATE TABLE `request` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `user_id` int(7) unsigned NOT NULL,
  `clan_id` int(4) unsigned default NULL,
  `date` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `resume_id` int(3) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- 
-- Дамп данных таблицы `request`
-- 


-- --------------------------------------------------------

-- 
-- Структура таблицы `users`
-- 

CREATE TABLE `users` (
  `id` int(7) unsigned NOT NULL auto_increment,
  `username` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(15) default NULL,
  `last_name` varchar(20) default NULL,
  `user_role` enum('no_active','user','clan_member','clan_master','admin') default 'no_active',
  `password` varchar(32) NOT NULL,
  `clan_id` int(4) unsigned default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- 
-- Дамп данных таблицы `users`
-- 

INSERT INTO `users` VALUES (1, 'login', 'test@test.com', 'jeka2', 'sidelnikov', 'user', 'e10adc3949ba59abbe56e057f20f883e', 0);
INSERT INTO `users` VALUES (2, 'login2', 'test@te2st.com', NULL, NULL, 'no_active', 'e10adc3949ba59abbe56e057f20f883e', NULL);
INSERT INTO `users` VALUES (4, 'MirkiLL', 'to.MegBeg@gmail.com', 'jeka', 'sidelnikov', 'clan_master', 'e10adc3949ba59abbe56e057f20f883e', 14);
INSERT INTO `users` VALUES (5, 'fk1', 'test@tedst.com', 'kiril', 'dyrko', 'clan_master', 'e10adc3949ba59abbe56e057f20f883e', 12);
INSERT INTO `users` VALUES (19, 'fed', 'tesdt@test.com', NULL, NULL, 'clan_master', 'e10adc3949ba59abbe56e057f20f883e', 18);
INSERT INTO `users` VALUES (6, 'jk14', 'test@tesdst.com', 'E', 'S', 'clan_master', 'e8a03cac7fd448713ceaf3290bf00f66', 15);
INSERT INTO `users` VALUES (7, 'logindg', 'test@testgg.com', NULL, NULL, 'no_active', 'e10adc3949ba59abbe56e057f20f883e', NULL);
INSERT INTO `users` VALUES (8, 'alogin', 'atest@test.com', NULL, NULL, 'clan_master', 'e10adc3949ba59abbe56e057f20f883e', 15);
INSERT INTO `users` VALUES (9, 'andj', 'andj@test.com', NULL, NULL, 'clan_master', 'e10adc3949ba59abbe56e057f20f883e', 7);
INSERT INTO `users` VALUES (10, 'p23', 'tedddst@test.com', NULL, NULL, 'user', 'e10adc3949ba59abbe56e057f20f883e', NULL);
INSERT INTO `users` VALUES (11, 't34', 'tessdft@test.com', NULL, NULL, 'clan_master', 'e10adc3949ba59abbe56e057f20f883e', 8);
INSERT INTO `users` VALUES (12, 'pwd', 'pwd@test.com', 'pwd', 'test', 'user', 'e10adc3949ba59abbe56e057f20f883e', NULL);
INSERT INTO `users` VALUES (13, '123', '123t@test.com', NULL, NULL, 'no_active', 'e10adc3949ba59abbe56e057f20f883e', NULL);
INSERT INTO `users` VALUES (14, '454', '454@test.com', '454', '454', 'clan_master', 'c92a1b0c4e2562c7361e746ad838586f', 9);
INSERT INTO `users` VALUES (15, 'loginsdf', 'test@tesdfst.com', NULL, NULL, 'no_active', 'e10adc3949ba59abbe56e057f20f883e', NULL);
INSERT INTO `users` VALUES (16, 'logssin', 'tessst@test.com', NULL, NULL, 'user', '21fc080391d776ba8910a2d4f8bafced', NULL);
INSERT INTO `users` VALUES (17, 'logddin', 'test@teddst.com', NULL, NULL, 'user', 'e10adc3949ba59abbe56e057f20f883e', NULL);
INSERT INTO `users` VALUES (18, 'jeka', 'sid@mail.ru', 'sidelnikov', 'evgeniy', 'user', 'e10adc3949ba59abbe56e057f20f883e', 17);
        