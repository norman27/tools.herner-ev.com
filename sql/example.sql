INSERT IGNORE INTO `app_screens` (`id`, `name`, `screen_type`, `config`, `active`, `last_change`) VALUES
(1, 'Spielstand', 'livegame', 'a:0:{}', 1, '1970-01-01 12:00:00'),
(2, 'Zwischenstände', 'othergames', 'a:0:{}', 0, '1970-01-01 12:00:00'),
(3, 'Spielplan', 'schedule', 'a:0:{}', 0, '1970-01-01 12:00:00'),
(4, 'Tabelle', 'table', 'a:0:{}', 0, '1970-01-01 12:00:00'),
(5, 'Zuschauerzahl', 'attendance', 'a:0:{}', 0, '1970-01-01 12:00:00'),
(6, 'Bilder', 'images', 'a:0:{}', 0, '2019-12-26 18:27:08'),
(7, 'Grüße', 'content', 'a:0:{}', 0, '1970-01-01 12:00:00'),
(8, 'Starting Six', 'six', 'a:0:{}', 0, '1970-01-01 12:00:00'),
(9, 'Teamvergleich', 'compare', 'a:0:{}', 0, '1970-01-01 12:00:00'),
(10, 'Puckwerfen', 'lottery', 'a:0:{}', 0, '1970-01-01 12:00:00');

-- --------------------------------------------------------

INSERT IGNORE INTO `app_users` (`id`, `username`, `password`, `email`, `is_active`, `roles`) VALUES
(1, 'admin', '$2y$13$EwKijfdKqsl6.6otpT.MU.CzytLAxm09TzpkBqkVeJHzEFRdYxEPC', 'admin@herner-ev.com', 1, 'a:2:{i:0;s:10:\"ROLE_ADMIN\";i:1;s:11:\"ROLE_SCREEN\";}');

-- --------------------------------------------------------

INSERT IGNORE INTO `b2n61_categories` (`id`, `extension`, `title`, `published`, `level`) VALUES
(1, 'com_hockeymanager_schedule', 'Oberliga-Nord', 1, 2),
(2, 'com_hockeymanager_table', 'Oberliga-Nord 2019/20', 1, 2);

-- --------------------------------------------------------

INSERT IGNORE INTO `b2n61_hockeymanager_clubs` (`id`, `name`, `logo`, `state`) VALUES
(1, 'Herner EV', 'herner-ev.png', 1),
(2, 'EC Bad Nauheim', 'ec-bad-nauheim.png', 1);

-- --------------------------------------------------------

INSERT IGNORE INTO `b2n61_hockeymanager_schedule` (`id`, `state`, `catid`, `gamedate`, `gametime`, `hometeam`, `awayteam`, `homescore`, `awayscore`) VALUES
(1, 1, 1, '2019-12-22', '08:00', 1, 2, 0, 0);

-- --------------------------------------------------------

INSERT IGNORE INTO `b2n61_hockeymanager_table` (`id`, `club_id`, `games_won`, `games_won_overtime`, `games_won_penalty`, `games_draw`, `games_lost_penalty`, `games_lost_overtime`, `games_lost`, `goals_for`, `goals_against`, `points`, `catid`, `state`) VALUES
(1, 1, 1, 0, 0, 0, 0, 0, 0, 3, 2, 3, 2, 1);
