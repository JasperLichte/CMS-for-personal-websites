SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


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
  `type` enum('int','string','bool','') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `settings` (`name`, `value`, `type`) VALUES
('CREATOR_NAME', 'Jasper Lichte', 'string'),
('CREATOR_EMAIL', 'jasper@lichte.info', 'string'),
('CREATOR_GITHUB_URL', 'https://github.com/JasperLichte', 'string'),
('APP_NAME', 'Jasper Lichte', 'string'),
('BG_ANIMATION', '0', 'bool'),
('COLOR_ANIMATION', '0', 'bool'),
('COLOR_ANIMATION_DELAY', '20000', 'int'),
('PRODUCTION', '0', 'bool'),
('VERSION', '0.1.0', 'string'),
('DEFAULT_LANGUAGE', 'en', 'string'),
('REPO_URL', 'https://github.com/JasperLichte/personal-website', 'string');


ALTER TABLE `home_sections`
  ADD PRIMARY KEY (`section_name`);

ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `settings`
  ADD PRIMARY KEY (`name`);


ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
