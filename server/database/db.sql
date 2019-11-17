SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `bg_animations` (
  `id` int(11) NOT NULL,
  `name` varchar(127) NOT NULL,
  `animation_index` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `bg_animations` (`id`, `name`, `animation_index`) VALUES
(1, 'Rain', 1),
(2, 'Wandering Circles', 0);

CREATE TABLE `bg_animations_ip` (
  `ip` varchar(31) NOT NULL,
  `bgAnimationId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `color_themes` (
  `id` int(11) NOT NULL,
  `name` varchar(127) NOT NULL,
  `theme_index` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `color_themes` (`id`, `name`, `theme_index`) VALUES
(1, 'Funky', 2),
(2, 'Classic', 1),
(3, 'Dark green', -1),
(4, 'Vibrant', 3),
(5, 'Neon', 0);

CREATE TABLE `color_themes_ip` (
  `ip` varchar(31) NOT NULL,
  `colorThemeId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `color_themes_values` (
  `theme_id` int(11) NOT NULL,
  `var_name` varchar(127) NOT NULL,
  `value` varchar(127) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `color_themes_values` (`theme_id`, `var_name`, `value`) VALUES
(3, 'body-bg', '#222'),
(3, 'header-bg-color', 'rgba(40, 125, 43, 0.85)'),
(3, 'header-font-color', '#eee'),
(3, 'content-bg-color', 'rgba(20, 20, 20, 0.85)'),
(3, 'content-font-color', 'rgb(40, 125, 43)'),
(3, 'content-accent-font-color', 'firebrick'),
(3, 'footer-bg-color', 'rgba(40, 125, 43, 0.85)'),
(3, 'footer-font-color', '#eee'),
(3, 'bg-canvas-opacity', '1'),
(3, 'bg-canvas-filter', 'blur(20px)'),
(1, 'body-bg', '#224'),
(1, 'header-bg-color', 'rgba(255, 99, 71, 0.85)'),
(1, 'header-font-color', '#eee'),
(1, 'content-bg-color', 'rgba(200, 200, 200, 0.85)'),
(1, 'content-font-color', '#333'),
(1, 'content-accent-font-color', 'rgb(60, 60, 60)'),
(1, 'footer-bg-color', 'rgba(255, 99, 71, 0.85)'),
(1, 'footer-font-color', '#eee'),
(1, 'bg-canvas-opacity', '1'),
(1, 'bg-canvas-filter', 'contrast(7)'),
(2, 'body-bg', '#eee'),
(2, 'header-bg-color', 'rgba(40, 40, 40, 0.9)'),
(2, 'header-font-color', '#eee'),
(2, 'content-bg-color', 'rgba(255, 255, 255, 0.85)'),
(2, 'content-font-color', '#444'),
(2, 'content-accent-font-color', 'rgb(140, 140, 140)'),
(2, 'footer-bg-color', 'rgba(40, 40, 40, 0.9)'),
(2, 'footer-font-color', '#eee'),
(2, 'bg-canvas-opacity', '1'),
(2, 'bg-canvas-filter', 'grayscale(100%) brightness(10%)'),
(4, 'header-bg-color', 'goldenrod'),
(4, 'footer-bg-color', 'goldenrod'),
(4, 'body-bg', 'rgb(63, 63, 63)'),
(4, 'content-bg-color', 'rgba(200, 200, 200, 0.35)'),
(4, 'content-accent-bg-color', 'goldenrod'),
(4, 'content-font-color', '#eee'),
(4, 'content-accent-font-color', 'gold'),
(4, 'bg-canvas-filter', 'grayscale(100%) brightness(0%)'),
(5, 'bg-canvas-filter', 'blur(80px) saturate(10)'),
(5, 'body-bg', '#222'),
(5, 'content-bg-color', 'rgba(10, 10, 10, .45)'),
(5, 'content-accent-bg-color', 'rgba(255,105,180,.5)'),
(5, 'content-font-color', 'rgba(255, 255, 255, .7)'),
(5, 'header-bg-color', 'rgba(40,40,40,.9)'),
(5, 'content-accent-font-color', 'hotpink'),
(5, 'footer-bg-color', 'rgba(40,40,40,.9)'),
(5, 'bg-canvas-opacity', '.6'),
(3, 'content-accent-bg-color', 'rgba(150, 150, 150, .4)');

CREATE TABLE `home_sections` (
  `section_name` varchar(127) NOT NULL,
  `section_index` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `home_sections` (`section_name`, `section_index`) VALUES
('hello', -1),
('github-repos', 3),
('live-projects', -1),
('color-themes', 1),
('bg-animations', 2),
('about-me', 0);

CREATE TABLE `live_projects` (
  `id` int(11) NOT NULL,
  `url` varchar(127) NOT NULL,
  `description` text NOT NULL,
  `project_index` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `live_projects` (`id`, `url`, `description`, `project_index`) VALUES
(1, 'https://www.projects.lichte.info/solar-system/', '', 1),
(2, 'https://www.projects.lichte.info/news-app/', '', 0),
(3, 'https://www.projects.lichte.info/boxshadow/', '', 3),
(4, 'https://www.projects.lichte.info/number-systems/', '', 2),
(5, 'https://www.projects.lichte.info/pathfinding/', '', 4),
(6, 'https://www.projects.lichte.info/web-animation/', '', 5);

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `ip` varchar(27) NOT NULL,
  `path` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `language` varchar(5) NOT NULL,
  `referer` varchar(127) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `settings` (
  `name` varchar(127) NOT NULL,
  `value` varchar(255) NOT NULL,
  `type` enum('int','string','bool') NOT NULL,
  `send_to_client` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `settings` (`name`, `value`, `type`, `send_to_client`) VALUES
('CREATOR_NAME', 'Jasper Lichte', 'string', '0'),
('CREATOR_EMAIL', 'jasper@lichte.info', 'string', '0'),
('CREATOR_GITHUB_URL', 'https://github.com/JasperLichte', 'string', '0'),
('APP_NAME', 'Jasper Lichte', 'string', '0'),
('DEFAULT_BG_ANIMATION', '2', 'int', '0'),
('SAVE_REQUESTS', '1', 'bool', '0'),
('PRODUCTION', '0', 'bool', '1'),
('VERSION', '0.1.0', 'string', '0'),
('DEFAULT_LANGUAGE', 'en', 'string', '0'),
('REPO_URL', 'https://github.com/JasperLichte/CMS-for-personal-websites', 'string', '0'),
('FAVICON_URL', 'https://www.media.lichte.info/assets/favicon.ico', 'string', '0'),
('DEFAULT_COLOR_THEME', '5', 'int', '0');


ALTER TABLE `bg_animations`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bg_animations_ip`
  ADD PRIMARY KEY (`ip`);

ALTER TABLE `color_themes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `color_themes_ip`
  ADD PRIMARY KEY (`ip`);

ALTER TABLE `color_themes_values`
  ADD PRIMARY KEY (`theme_id`,`var_name`),
  ADD UNIQUE KEY `theme_id` (`theme_id`,`var_name`);

ALTER TABLE `home_sections`
  ADD PRIMARY KEY (`section_name`);

ALTER TABLE `live_projects`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `settings`
  ADD PRIMARY KEY (`name`);


ALTER TABLE `bg_animations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `color_themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `live_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
