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

INSERT IGNORE INTO `app_youngsters_microsponsors` (`id`, `name`, `is_blocked`) VALUES
(1, 'Max Mustermann', 0),
(109, '', 1);

-- --------------------------------------------------------

INSERT IGNORE INTO `b2n61_banners` (`id`, `name`, `state`, `params`) VALUES
(1, 'Wohnungsgenossenschaft Herne-Süd eG', 1, '{"imageurl":"images\\/banners\\/whs.jpg","width":"","height":"","alt":""}');

-- --------------------------------------------------------

INSERT IGNORE INTO `b2n61_categories` (`id`, `extension`, `title`, `published`, `level`) VALUES
(1, 'com_hockeymanager_schedule', 'Oberliga-Nord', 1, 2),
(2, 'com_hockeymanager_table', 'Oberliga-Nord 2019/20', 1, 2);

-- --------------------------------------------------------

INSERT IGNORE INTO `b2n61_hockeymanager_clubs` (`id`, `name`, `logo`, `state`) VALUES
(1, 'Herner EV', 'herner-ev_v2.png', 1),
(2, 'EC Bad Nauheim', 'ec-bad-nauheim_v1.png', 1),
(3, 'Tilburg Trappers', 'tilburg-trappers_v1.png', 1),
(4, 'TecArt Black Dragons', 'black-dragons-erfurt_v1.png', 1),
(5, 'Crocodiles Hamburg', 'crocodiles-hamburg_v1.png', 1),
(6, 'EG Diez-Limburg', 'eg-diez-limburg_v1.png', 1),
(7, 'Hammer Eisbären', 'hammer-eisbaeren_v1.png', 1),
(8, 'Hannover Indians', 'hannover-indians_v1.png', 1),
(9, 'Hannover Scorpions', 'hannover-scorpions_v1.png', 1),
(10, 'Herforder EV', 'herforder-ev_v1.png', 1),
(11, 'EXA Icefighters Leipzig', 'icefighters-leipzig_v1.png', 1),
(12, 'Krefelder EV 81', 'krefelder-ev-81_v1.png', 1),
(13, 'Rostock Piranhas', 'rostock-piranhas_v1.png', 1),
(14, 'Saale Bulls Halle', 'saale-bulls-halle_v1.png', 1);


-- --------------------------------------------------------

INSERT IGNORE INTO `b2n61_hockeymanager_schedule` (`id`, `state`, `catid`, `gamedate`, `gametime`, `hometeam`, `awayteam`, `homescore`, `awayscore`) VALUES
(1, 1, 1, '2019-12-22', '08:00', 1, 2, 0, 0),
(2, 1, 1, '2099-12-22', '20:00', 1, 2, 0, 0);

-- --------------------------------------------------------

INSERT IGNORE INTO `b2n61_hockeymanager_table` (`id`, `club_id`, `games_won`, `games_won_overtime`, `games_won_penalty`, `games_draw`, `games_lost_penalty`, `games_lost_overtime`, `games_lost`, `goals_for`, `goals_against`, `points`, `catid`, `state`) VALUES
(1, 1, 1, 0, 0, 0, 0, 0, 0, 3, 2, 3, 2, 1);
