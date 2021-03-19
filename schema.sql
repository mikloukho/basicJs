CREATE DATABASE olympic
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE olympic;

CREATE TABLE countries (
    id int AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL UNIQUE
);

CREATE TABLE sports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL
);

CREATE TABLE sportsmans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128) NOT NULL
);

CREATE TABLE medals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(128) NOT NULL UNIQUE
);

CREATE TABLE count_medals (
    id int AUTO_INCREMENT PRIMARY KEY,
    medal_id int NOT NULL,
    country_id int default NULL,
    sport_id int NOT NULL,
    sportsman_id int NOT NULL,
    team int default NULL,
    FOREIGN KEY(country_id) REFERENCES countries(id),
    FOREIGN KEY(sport_id) REFERENCES sports(id),
    FOREIGN KEY(sportsman_id) REFERENCES sportsmans(id),
    FOREIGN KEY(medal_id) REFERENCES medals(id)
);
