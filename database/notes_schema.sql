DROP SCHEMA IF EXISTS tasks;
CREATE SCHEMA tasks;
USE tasks;

--Table structure for table `users`


CREATE TABLE users (
  user_id SMALLINT NOT NULL AUTO_INCREMENT,
  user_name VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (user_id)
);

INSERT INTO users VALUES(1,'test','test');

--Table structure for table `pendents`
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
CREATE TABLE tasks (
  tasks_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  created_at TIMESTAMP NOT NULL,
  deadline TIMESTAMP NOT NULL,
  user_id SMALLINT NOT NULL,
  priority VARCHAR(20),
  state BOOLEAN NOT NULL DEFAULT TRUE,
  PRIMARY KEY (tasks_id),
  CONSTRAINT fk_tasks_user FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE RESTRICT ON UPDATE CASCADE
);

INSERT INTO tasks VALUES('test','test','2021-11-19','2021-11-22','urgente');


