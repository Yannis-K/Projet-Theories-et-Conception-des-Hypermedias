CREATE TABLE `user` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
);

CREATE TABLE `user_movie_relation` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `movie_id` int NOT NULL,
  `rating` tinyint,
  `favourite` tinyint(1) NOT NULL DEFAULT "0",
  `rating_timestamp` datetime
);

CREATE TABLE `movie` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255),
  `movie_is_from_API` tinyint(1) NOT NULL DEFAULT "0"
);

CREATE TABLE `API_ref` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `url` varchar(255),
  `label` varchar(50)
);

CREATE TABLE `user_recommendation_form_logs` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `user_humor` enum,
  `user_location_lat` DECIMAL(10, 8),
  `user_location_long` DECIMAL(11, 8),
  `user_location_weather_label` enum,
  `user_location_weather_temperature` int,
  `form_submission_date` datetime
);

CREATE TABLE `user_recommendation_history` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `form_log_id` int NOT NULL,
  `movie_id` int NOT NULL
);

ALTER TABLE `user_movie_relation` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `user_movie_relation` ADD FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`);

ALTER TABLE `user_recommendation_form_logs` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `user_recommendation_history` ADD FOREIGN KEY (`form_log_id`) REFERENCES `user_recommendation_form_logs` (`id`);

ALTER TABLE `user_recommendation_history` ADD FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`);
