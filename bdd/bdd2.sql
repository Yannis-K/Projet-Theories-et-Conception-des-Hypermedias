CREATE TABLE `user` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
);

CREATE TABLE `user_movie_relation` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `movie_id` int NOT NULL,
  `movie_is_from_API` tinyint(1) NOT NULL DEFAULT "0",
  `rating` int,
  `favourite` tinyint(1) NOT NULL DEFAULT "0",
  `user_humor` enum,
  `user_location_lat` DECIMAL(10, 8),
  `user_location_long` DECIMAL(11, 8),
  `user_location_weather_label` enum,
  `user_location_weather_temperature` int,
  `form_submission_date` datetime,
  `rating_timestamp` datetime
);

CREATE TABLE `movie` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255)
);

CREATE TABLE `API_ref` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `url` varchar(255),
  `label` varchar(50)
);

ALTER TABLE `user_movie_relation` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `user_movie_relation` ADD FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`);

ALTER TABLE `user_movie_relation` ADD FOREIGN KEY (`movie_id`) REFERENCES `API_ref` (`id`);
