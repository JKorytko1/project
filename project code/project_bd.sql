-- phpMyAdmin SQL Dump
-- version 4.0.3
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Вер 17 2013 р., 21:49
-- Версія сервера: 5.5.25
-- Версія PHP: 5.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База даних: `bd`
--
CREATE DATABASE IF NOT EXISTS `bd` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bd`;

-- --------------------------------------------------------

--
-- Структура таблиці `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `group_module_id` int(10) DEFAULT NULL,
  `student_id` int(10) DEFAULT NULL,
  `grade_first` char(1) DEFAULT NULL,
  `grade_second` char(1) DEFAULT NULL,
  KEY `grades_fk1` (`group_module_id`),
  KEY `grades_fk2` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(10) NOT NULL AUTO_INCREMENT,
  `group_name` text,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп даних таблиці `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`) VALUES
(1, 'И-20б'),
(2, 'И-20а'),
(3, 'И-21а'),
(4, 'И-21б'),
(5, 'И-22а'),
(6, 'И-22б'),
(7, 'И-23а'),
(8, 'И-23б');

-- --------------------------------------------------------

--
-- Структура таблиці `groups_modules`
--

CREATE TABLE IF NOT EXISTS `groups_modules` (
  `group_module_id` int(10) NOT NULL AUTO_INCREMENT,
  `group_id` int(10) DEFAULT NULL,
  `module_id` int(10) DEFAULT NULL,
  `dead_line` date DEFAULT NULL,
  PRIMARY KEY (`group_module_id`),
  KEY `groups_modules_fk1` (`group_id`),
  KEY `groups_modules_fk2` (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `group_subjects`
--

CREATE TABLE IF NOT EXISTS `group_subjects` (
  `group_id` int(10) DEFAULT NULL,
  `subject_id` int(10) DEFAULT NULL,
  KEY `group_subjects_fk1` (`group_id`),
  KEY `group_subjects_fk2` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `lectors`
--

CREATE TABLE IF NOT EXISTS `lectors` (
  `lector_id` int(10) NOT NULL AUTO_INCREMENT,
  `lector_name` text,
  `lector_position` text,
  `lector_email` text,
  `lector_login` tinytext,
  `lector_password` tinytext,
  PRIMARY KEY (`lector_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп даних таблиці `lectors`
--

INSERT INTO `lectors` (`lector_id`, `lector_name`, `lector_position`, `lector_email`, `lector_login`, `lector_password`) VALUES
(1, 'Корытко Юлия Николаевна', 'Кандидат технических наук', 'juliakorytko@gmail.com', 'julia_korytko', ''),
(2, 'Асютин Алексей Дмитриевич', 'Асистент', 'sutok85@gmail.com', 'AAsutin', ''),
(3, 'Некрасова Мария Владимирона', 'Старший преподаватель', '', 'MNekrasova', ''),
(4, 'Бреславский Дмитрий Васильевич', 'Доктор технических наук, декан факультета', 'brdm@kpi.kharkov.ua', 'brdm', '');

-- --------------------------------------------------------

--
-- Структура таблиці `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `module_id` int(10) NOT NULL AUTO_INCREMENT,
  `module_name` text,
  `subject_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`module_id`),
  KEY `modules_fk1` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(10) NOT NULL AUTO_INCREMENT,
  `student_name` text,
  `student_notes` text,
  `student_email` text,
  `group_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  KEY `students_fk1` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп даних таблиці `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `student_notes`, `student_email`, `group_id`) VALUES
(1, 'Ваколюк Яков Владимирович', 'Профорг группы', 'y.vakolyuk@profkom-khpi.org', 1),
(2, 'Дачко Оксана Анатольевна', NULL, NULL, 1),
(3, 'Лемишенко Олег Александрович', 'Староста группы', NULL, 1),
(4, 'Рожовецкий Евгений Олегович', NULL, NULL, 1),
(5, 'Снопов Дмитрий Евгеньевич', NULL, NULL, 1),
(6, 'Сирик Максим Владимирович', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subject_id` int(10) NOT NULL AUTO_INCREMENT,
  `subject_title` text,
  `subject_credits` int(11) DEFAULT NULL,
  `lector_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`subject_id`),
  KEY `subjects_fk1` (`lector_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп даних таблиці `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_title`, `subject_credits`, `lector_id`) VALUES
(1, 'Теория программирования', NULL, 1),
(2, 'Программирование', NULL, 4),
(3, 'Теория вероятностей', NULL, 3),
(4, 'Теория кодирования', NULL, 3);

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_fk1` FOREIGN KEY (`group_module_id`) REFERENCES `groups_modules` (`group_module_id`),
  ADD CONSTRAINT `grades_fk2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Обмеження зовнішнього ключа таблиці `groups_modules`
--
ALTER TABLE `groups_modules`
  ADD CONSTRAINT `groups_modules_fk1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `groups_modules_fk2` FOREIGN KEY (`module_id`) REFERENCES `modules` (`module_id`);

--
-- Обмеження зовнішнього ключа таблиці `group_subjects`
--
ALTER TABLE `group_subjects`
  ADD CONSTRAINT `group_subjects_fk1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `group_subjects_fk2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Обмеження зовнішнього ключа таблиці `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_fk1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Обмеження зовнішнього ключа таблиці `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_fk1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`);

--
-- Обмеження зовнішнього ключа таблиці `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_fk1` FOREIGN KEY (`lector_id`) REFERENCES `lectors` (`lector_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
