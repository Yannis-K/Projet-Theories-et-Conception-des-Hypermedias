CREATE TABLE user {
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    genre TINYINT(1) NOT NULL,
    password VARCHAR NOT NULL
}

CREATE TABLE user_movie_relation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    movie_api_id INT NOT NULL,
    rating INT CHECK (rating >= 0 AND rating <= 5),
    favourite TINYINT(1) NOT NULL DEFAULT 0,

    FOREIGN KEY (user_id) REFERENCES user(id)
);


CREATE TABLE user_form_logs (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    submission_date DATETIME NOT NULL,
    humor ENUM('exicited', 'happy', 'neutral', 'sad', 'very-sad'),
    location VARCHAR(255),
    weather VARCHAR(255)
);
