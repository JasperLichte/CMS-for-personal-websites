SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `color_themes` (
  `id` int(11) NOT NULL,
  `name` varchar(127) NOT NULL,
  `theme_index` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `color_themes` (`id`, `name`, `theme_index`) VALUES
(1, 'funky', 1),
(2, 'classic', 0),
(3, 'dark-green', 2);

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
(3, 'content-accent-font-color', 'rgb(100, 100, 100)'),
(3, 'footer-bg-color', 'rgba(40, 125, 43, 0.85)'),
(3, 'footer-font-color', '#eee'),
(3, 'bg-canvas-opacity', '1'),
(3, 'bg-canvas-filter', 'none'),
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
(2, 'bg-canvas-filter', 'grayscale(100%) brightness(10%)');

CREATE TABLE `home_sections` (
  `section_name` varchar(127) NOT NULL,
  `section_index` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `home_sections` (`section_name`, `section_index`) VALUES
('hello', -1),
('github-repos', 1);

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `ip` varchar(27) NOT NULL,
  `path` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `language` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `settings` (
  `name` varchar(127) NOT NULL,
  `value` varchar(255) NOT NULL,
  `type` enum('int','string','bool') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `settings` (`name`, `value`, `type`) VALUES
('CREATOR_NAME', 'Jasper Lichte', 'string'),
('CREATOR_EMAIL', 'jasper@lichte.info', 'string'),
('CREATOR_GITHUB_URL', 'https://github.com/JasperLichte', 'string'),
('APP_NAME', 'Jasper Lichte', 'string'),
('BG_ANIMATION', '0', 'bool'),
('COLOR_ANIMATION', '0', 'bool'),
('COLOR_ANIMATION_DELAY', '10000', 'int'),
('PRODUCTION', '0', 'bool'),
('VERSION', '0.1.0', 'string'),
('DEFAULT_LANGUAGE', 'en', 'string'),
('REPO_URL', 'https://github.com/JasperLichte/personal-website', 'string'),
('FAVICON_URL', 'https://www.media.lichte.info/assets/favicon.ico', 'string'),
('DEFAULT_COLOR_THEME', 'classic', 'string');


ALTER TABLE `color_themes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `color_themes_values`
  ADD PRIMARY KEY (`theme_id`,`var_name`),
  ADD UNIQUE KEY `theme_id` (`theme_id`,`var_name`);

ALTER TABLE `home_sections`
  ADD PRIMARY KEY (`section_name`);

ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `settings`
  ADD PRIMARY KEY (`name`);


ALTER TABLE `color_themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
