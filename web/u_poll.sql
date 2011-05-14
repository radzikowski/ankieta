-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 14 Maj 2011, 18:47
-- Wersja serwera: 5.1.41
-- Wersja PHP: 5.3.2-1ubuntu4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `u_poll`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `answers_stat`
--

CREATE TABLE IF NOT EXISTS `answers_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer_id` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `answer_id` (`answer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `answers_stat`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `name` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `config`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `demographic_stat`
--

CREATE TABLE IF NOT EXISTS `demographic_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(70) NOT NULL,
  `city` varchar(255) NOT NULL,
  `sex` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `demographic_stat`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `layout`
--

CREATE TABLE IF NOT EXISTS `layout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `head_image` varchar(255) NOT NULL,
  `background_image` varchar(255) NOT NULL,
  `bottom_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `layout`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(70) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `type`, `message`, `details`, `created_at`) VALUES
(1, '1383000457', 'FacebookApi', 'Problem with get ME from FB Api', 'name lookup timed out | Line:614 | Code: 6 Track: #0 /var/www/ankieta/lib/facebook.php(575): Facebook->makeRequest(''https://graph.f...'', Array)\n#1 /var/www/ankieta/lib/facebook.php(539): Facebook->_oauthRequest(''https://graph.f...'', Array)\n#2 [internal function]: Facebook->_graph(''/me'')\n#3 /var/www/ankieta/lib/facebook.php(492): call_user_func_array(Array, Array)\n#4 /var/www/ankieta/lib/filter/facebookFilter.class.php(73): Facebook->api(''/me'')\n#5 /var/www/ankieta/lib/vendor/symfony/lib/filter/sfFilterChain.class.php(53): facebookFilter->execute(Object(sfFilterChain))\n#6 /var/www/ankieta/lib/vendor/symfony/lib/filter/sfRenderingFilter.class.php(33): sfFilterChain->execute()\n#7 /var/www/ankieta/lib/vendor/symfony/lib/filter/sfFilterChain.class.php(53): sfRenderingFilter->execute(Object(sfFilterChain))\n#8 /var/www/ankieta/lib/vendor/symfony/lib/controller/sfController.class.php(238): sfFilterChain->execute()\n#9 /var/www/ankieta/lib/vendor/symfony/lib/controller/sfFrontWebController.class.php(48): sfController->forward(''poll'', ''index'')\n#10 /var/www/ankieta/lib/vendor/symfony/lib/util/sfContext.class.php(170): sfFrontWebController->dispatch()\n#11 /var/www/ankieta/web/frontend_dev.php(13): sfContext->dispatch()\n#12 {main}', '2011-05-12 12:48:49');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `poll`
--

CREATE TABLE IF NOT EXISTS `poll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `layout_id` int(11) DEFAULT NULL,
  `type` enum('check','radio','points') NOT NULL,
  `self_answers` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `layout_id` (`layout_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `poll`
--

INSERT INTO `poll` (`id`, `name`, `layout_id`, `type`, `self_answers`, `created_at`) VALUES
(1, 'ankieta', NULL, 'check', 0, '2011-05-11 00:01:33');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `poll_comment`
--

CREATE TABLE IF NOT EXISTS `poll_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `user_id` varchar(70) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `poll_comment`
--


-- --------------------------------------------------------

--
-- Struktura tabeli dla  `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `poll_id` (`poll_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `questions`
--

INSERT INTO `questions` (`id`, `poll_id`, `question`, `created_at`) VALUES
(1, 1, 'moje pytanie', '2011-05-11 00:27:23'),
(2, 1, 'drugie pytanie', '2011-05-11 18:20:18');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `questions_answers`
--

CREATE TABLE IF NOT EXISTS `questions_answers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(11) unsigned NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `questions_answers`
--

INSERT INTO `questions_answers` (`id`, `question_id`, `value`, `created_at`) VALUES
(1, 1, 'moja 1 odpowiedz', '2011-05-11 00:27:51'),
(2, 1, 'moja 2 odpowiedz', '2011-05-11 00:27:51'),
(3, 1, 'moja 3 odpowiedz', '2011-05-11 00:28:11'),
(4, 1, 'moja 4 odpowiedz', '2011-05-11 00:28:11'),
(5, 2, 'inne pytanie', '2011-05-11 18:20:37'),
(6, 2, 'kolejne inne pytanie', '2011-05-11 18:20:37');

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(70) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `friends` text NOT NULL,
  `friends_count` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `sex`, `friends`, `friends_count`, `created_at`, `is_active`) VALUES
('1383000457', 'Piotr', 'Radzikowski', 'male', '{"data":[{"name":"Tro\\u0107 Daniel","id":"704079935"},{"name":"Agnieszka Chalimoniuk","id":"1005118072"},{"name":"Krzyniu Karolek Szczepaniuk","id":"1366532670"},{"name":"Rafa\\u0142 Dymitruk","id":"1408682618"},{"name":"Rafa\\u0142 Parafiniuk","id":"1410842600"},{"name":"Pawe\\u0142 Miko\\u0142ajczuk","id":"1413392640"},{"name":"Micha\\u0142 Wawryniuk","id":"1463859441"},{"name":"Przemyslaw Chodzko","id":"1536693041"},{"name":"Sylwia Nowosz","id":"1613583211"},{"name":"Damian Petruk","id":"1784737624"},{"name":"Joanna Karpi\\u0144ska","id":"1819339221"},{"name":"Agnieszka Sawczuk","id":"1835921559"},{"name":"Micha\\u0142 Szczepanik","id":"1843968663"},{"name":"Kasia Waszczuk","id":"100000011026307"},{"name":"Adam Paluszkiewicz","id":"100000027570017"},{"name":"Marcin Ws\\u00f3\\u0142","id":"100000121650824"},{"name":"Klaudia Zie\\u0144","id":"100000173406496"},{"name":"Grzegorz Dymitruk","id":"100000287842137"},{"name":"Olga Drupaluk","id":"100000319968952"},{"name":"Tomasz \\u0141ukaszuk","id":"100000338680339"},{"name":"Krystian Da","id":"100000439435948"},{"name":"Marika Perkowska","id":"100000446770269"},{"name":"Sylwia Sok\\u00f3lska","id":"100000503269113"},{"name":"Daniel Drygiel","id":"100000511704357"},{"name":"Daniel Sw\\u00f3rski","id":"100000522401053"},{"name":"Pawe\\u0142 Max","id":"100000544285221"},{"name":"Magdalena Giersz","id":"100000566634027"},{"name":"Kinga Martyniuk","id":"100000646625730"},{"name":"Mateusz Walczuk","id":"100000673110014"},{"name":"Wojtek Borysiak","id":"100000675517017"},{"name":"Zbigniew Kulikowski","id":"100000713658368"},{"name":"Magdalena Hukaluk","id":"100000752266385"},{"name":"Renata Samociuk","id":"100000762280236"},{"name":"Natalia Bie\\u0144ko","id":"100000785393253"},{"name":"Edyta \\u0141aziuk","id":"100000790660616"},{"name":"Piotr Kamasa","id":"100000819573101"},{"name":"Karolina Chalimoniuk","id":"100000822318132"},{"name":"Micha\\u0142 Kurowski","id":"100000876103225"},{"name":"Krzysiek Bartoszczyk","id":"100000898604349"},{"name":"Katarzyna Basara","id":"100000919734069"},{"name":"Jacek Szczypek","id":"100000920717498"},{"name":"Karolina Bobzi\\u0144ski","id":"100000948442972"},{"name":"Konrad Tro\\u0107","id":"100000977945950"},{"name":"Jacek Jakubiuk","id":"100000996519234"},{"name":"Tomasz Byczyk","id":"100001056595696"},{"name":"Izabela Tymoszuk","id":"100001079337604"},{"name":"Martyna Olejniczak","id":"100001164894592"},{"name":"Konrad Junak","id":"100001167823590"},{"name":"Pawe\\u0142 Basik","id":"100001192366157"},{"name":"Kasia Si\\u0142uszyk","id":"100001224514013"},{"name":"Emil Jaszczuk","id":"100001237746971"},{"name":"J\\u00f3\\u017awik Beata","id":"100001287802484"},{"name":"Izabela Harasimiuk","id":"100001297639344"},{"name":"Ewelina Harasimiuk","id":"100001430775850"},{"name":"Krystian Martyniuk","id":"100001468692359"},{"name":"Przemys\\u0142aw Niew\\u0119g\\u0142owski","id":"100001512821055"},{"name":"Katarzyna Niew\\u0119g\\u0142owska","id":"100001603051431"},{"name":"Andrzej Jakubiuk","id":"100001625898589"},{"name":"Marcin Radzikowski","id":"100001641791064"},{"name":"Rafa\\u0142 Nowosielski","id":"100001650433474"},{"name":"Dominika Jaszczuk","id":"100001670904896"},{"name":"Damian Izdebski","id":"100001702623189"},{"name":"Emilia Harasimiuk","id":"100001711833372"},{"name":"Tomasz Marciniuk","id":"100001775954549"},{"name":"Kamil Koc","id":"100001827001359"},{"name":"Katarzyna Radomyska","id":"100001936290863"},{"name":"Justyna Chwedczuk","id":"100001975150487"},{"name":"Ewelina Chmielewska","id":"100002006786037"},{"name":"Rita Wiszniewska","id":"100002197877213"},{"name":"Justyna Radzikowska","id":"100002279250686"},{"name":"Pawe\\u0142 Stysia\\u0142","id":"100002324266056"},{"name":"Daniel Leszcz","id":"100002431170358"},{"name":"Joanna Silja\\u0144czuk","id":"100002457661636"}]}', 0, '2011-05-10 13:58:06', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `users_answers`
--

CREATE TABLE IF NOT EXISTS `users_answers` (
  `user_id` varchar(70) NOT NULL DEFAULT '',
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `answer_text` text,
  `points` smallint(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`question_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users_answers`
--


--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `demographic_stat`
--
ALTER TABLE `demographic_stat`
  ADD CONSTRAINT `demographic_stat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `poll`
--
ALTER TABLE `poll`
  ADD CONSTRAINT `poll_ibfk_1` FOREIGN KEY (`layout_id`) REFERENCES `layout` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `poll_comment`
--
ALTER TABLE `poll_comment`
  ADD CONSTRAINT `poll_comment_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `poll` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `poll_comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`poll_id`) REFERENCES `poll` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `questions_answers`
--
ALTER TABLE `questions_answers`
  ADD CONSTRAINT `questions_answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `users_answers`
--
ALTER TABLE `users_answers`
  ADD CONSTRAINT `users_answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
