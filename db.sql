CREATE DATABASE IF NOT EXISTS journal;
USE journal;

CREATE TABLE IF NOT EXISTS entries (
       id INT AUTO_INCREMENT PRIMARY KEY,
       author VARCHAR(255) NOT NULL,
       entry_datetime DATETIME NOT NULL,
       title VARCAR(255) NOT NULL,
       body TEXT NOT NULL,
       mood ENUM('Happy', 'Neutral', 'Sad') NOT NULL
);

-- Adding an example entry
INSERT INTO entries (author, entry_datetime, title, body, mood) VALUES ('Bob', NOW(), 'Test Entry', 'Hello world!', 'Happy');
