drop table if exists raw_data;
CREATE TABLE `raw_data` (
  `season_year` int(11) NOT NULL,
  `game_string` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `game_date` datetime NOT NULL,
  `game_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `visitor` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `home` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `visiting_team_final_runs` int(11) NOT NULL,
  `home_team_final_runs` int(11) NOT NULL,
  `inning` int(11) NOT NULL,
  `side` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batter_id` int(10) unsigned NOT NULL,
  `batter` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batter_hand` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pitcher_id` int(10) unsigned NOT NULL,
  `pitcher` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pitcher_hand` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `catcher_id` int(11) NOT NULL,
  `catcher` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `umpire_id` int(11) NOT NULL,
  `umpire` varchar(255)  CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `times_faced` int(11) NOT NULL,
  `batter_pos` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `balls` smallint(6) NOT NULL,
  `strikes` smallint(6) NOT NULL,
  `outs` smallint(6) NOT NULL,
  `man_on_first` varchar(255) NOT NULL,
  `man_on_second` varchar(255) NOT NULL,
  `man_on_third` varchar(255) NOT NULL,
  `end_man_on_first` varchar(255) NOT NULL,
  `end_man_on_second` varchar(255) NOT NULL,
  `end_man_on_third` varchar(255) NOT NULL,
  `visiting_team_current_runs` int(11) NOT NULL,
  `home_team_current_runs` int(11) NOT NULL,
  `pitch_result` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pitch_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `release_velocity` decimal(5,2) NOT NULL,
  `spin_rate` decimal(7,3) NOT NULL,
  `spin_direction` decimal(7,4) NOT NULL,
  `px` decimal(7,4) NOT NULL,
  `pz` decimal(6,4) NOT NULL,
  `szt` decimal(6,4) NOT NULL,
  `szb` decimal(6,4) NOT NULL,
  `x0` decimal(6,4) NOT NULL,
  `y0` int(11) NOT NULL,
  `z0` decimal(6,4) NOT NULL,
  `vx0` decimal(6,4) NOT NULL,
  `vy0` decimal(7,4) NOT NULL,
  `vz0` decimal(6,4) NOT NULL,
  `ax` decimal(7,4) NOT NULL,
  `ay` decimal(6,4) NOT NULL,
  `az` decimal(6,4) NOT NULL,
  `prob_called_strike` decimal(6,5) NOT NULL,
  `pa_result` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `runs_home` int(11) NULL,
  `batted_ball_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `batted_ball_angle` decimal(5,3) NULL,
  `batted_ball_distance` decimal(6,3) NULL,
  `atbat_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `processed_utc` int(10) DEFAULT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2154574 DEFAULT CHARSET=latin1;

LOAD DATA LOCAL INFILE 'C:\\Users\\Cory\\Downloads\\trumedia\\2014.csv' INTO TABLE trumedia2017.raw_data FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\n';
LOAD DATA LOCAL INFILE 'C:\\Users\\Cory\\Downloads\\trumedia\\2015.csv' INTO TABLE trumedia2017.raw_data FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\n';
LOAD DATA LOCAL INFILE 'C:\\Users\\Cory\\Downloads\\trumedia\\2016.csv' INTO TABLE trumedia2017.raw_data FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\n';

delete from raw_data where season_year = 0; #removes header rows