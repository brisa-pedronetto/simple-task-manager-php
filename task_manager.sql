CREATE DATABASE IF NOT EXISTS task_manager;
USE task_manager;

-- Create users table
-- DROP TABLE IF EXISTS users;
-- CREATE TABLE users(
--     ID INT NOT NULL AUTO_INCREMENT,
-- 	username VARCHAR(50) UNIQUE NOT NULL,
--     password VARCHAR(128) NOT NULL,
--     PRIMARY KEY(ID)
-- );

-- Create tasks table
CREATE TABLE IF NOT EXISTS tasks (
    ID INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    description LONGTEXT,
    priority TINYINT NOT NULL DEFAULT 1,
    created_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	due_date DATETIME NOT NULL,
    -- user_id INT NOT NULL,
    -- FOREIGN KEY (user_id) REFERENCES users(ID),
    PRIMARY KEY(ID)
);


ALTER TABLE tasks
ADD status ENUM('To Do', 'Doing', 'Done') DEFAULT 'To Do' NOT NULL;
