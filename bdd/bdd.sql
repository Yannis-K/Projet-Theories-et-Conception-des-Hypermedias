CREATE TABLE `user` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `genre` tinyint NOT NULL,
  `password` varchar(255) NOT NULL
);

CREATE TABLE `user_movie_relation` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `movie_api_id` int NOT NULL,
  `rating` int,
  `favourite` tinyint NOT NULL DEFAULT "0",
  `Foreign` user_id
);

CREATE TABLE `user_form_logs` (
  `log_id` int PRIMARY KEY AUTO_INCREMENT,
  `submission_date` datetime NOT NULL,
  `humor` enum,
  `location` varchar(255),
  `weather` varchar(255)
);

ALTER TABLE `user_movie_relation` ADD FOREIGN KEY (`Foreign`) REFERENCES `user` (`id`);
