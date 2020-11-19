-- -------------------------------------------------------------
-- TablePlus 3.10.0(348)
--
-- https://tableplus.com/
--
-- Database: contacts
-- Generation Time: 2020-11-19 08:36:27.1310
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` smallint NOT NULL DEFAULT '1',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `private_contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contact_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-private_contact-contact_id` (`contact_id`),
  KEY `fk-private_contact-user_id` (`user_id`),
  CONSTRAINT `fk-private_contact-contact_id` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk-private_contact-user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` int DEFAULT NULL,
  `gender` smallint DEFAULT NULL,
  `status` smallint NOT NULL DEFAULT '1',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `contact` (`id`, `first_name`, `last_name`, `phone`, `email`, `status`, `created_at`, `updated_at`) VALUES
('1', 'Андрей', 'Высоцкий', '77012342213', 'andrey@gmail.com', '1', '1605014797', '1605014797'),
('2', 'Виктор', 'Берёзка', '77770007700', 'victor@gmail.com', '1', '1605014797', '1605014797'),
('3', 'Александр', 'Винокурченко', '77012342213', 'alex@gmail.com', '1', '1605014797', '1605014797'),
('4', 'Надежда', 'Петрова', '77074563737', 'nadezhda@gmail.com', '1', '1605014797', '1605014797'),
('5', 'Любовь', 'Голубкина', '77054321245', 'love@gmail.com', '1', '1605014797', '1605014797'),
('6', 'Илья', 'Муромец', '77712345678', 'ilya@gmail.com', '1', '1605014797', '1605014797'),
('7', 'Василиса', 'Тополь', '77075674737', 'vasilisa@gmail.com', '1', '1605014797', '1605014797'),
('8', 'Константин', 'Валерьев', '77777076757', 'konst@gmail.com', '1', '1605014797', '1605014797'),
('9', 'Виктория', 'Васильева', '77059871234', 'vika@gmail.com', '1', '1605014797', '1605014797'),
('10', 'Алексей', 'Добрый', '77777777777', 'alesha@gmail.com', '1', '1605014797', '1605014797');

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', '1604989686'),
('m201110_062213_create_user_table', '1604989688'),
('m201110_113715_create_contact_table', '1605008813'),
('m201110_120554_create_private_contact_table', '1605010092'),
('m201110_131946_insert_contacts', '1605014797');

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `email`, `dob`, `gender`, `status`, `created_at`, `updated_at`) VALUES
('1', 'test', 'p7PG7ZkBzbwojzGjayMvs-BkDw_tZp-8', '$2y$13$a84Mc35LKjTvIXxK.fvUiOO8hJTEofDvX74GNQpfYelCN8GBOBEVe', 'test@gmail.com', '950137200', '2', '1', '1604995601', '1604995601'),
('2', 'test2', '-IS7qSXh5fuutGX23whVr7d-vbPkYxqU', '$2y$13$qooaFMWbrW0r8WGQ1V6LsOFPEJtXPNQNuUsVwOU65I9A69/CdoVkC', 'qwerty@mail.ru', '960933600', '1', '1', '1605013424', '1605013424');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;