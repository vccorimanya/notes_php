DROP SCHEMA IF EXISTS notes;
CREATE SCHEMA notes;
USE notes;

--Table structure for table `pendents`

CREATE TABLE pendents (
  pendents_id SMALLINT NOT NULL AUTO_INCREMENT,
  title VARCHAR(128) NOT NULL,
  content TEXT NOT NULL,
  added_date DATETIME NOT NULL,
  deadline DATETIME NOT NULL,
  priority VARCHAR(10),
  state BOOLEAN NOT NULL DEFAULT TRUE,
  PRIMARY KEY (pendents_id)
);

INSERT INTO pendents VALUES('test','test','2021-11-19','2021-11-22','urgente');

--Table structure for table `users`

CREATE TABLE users (
  user_id SMALLINT NOT NULL AUTO_INCREMENT,
  user_name VARCHAR(45) NOT NULL,
  password VARCHAR(200) NOT NULL,
  pendents_id SMALLINT NULL,
  PRIMARY KEY (user_id),
  CONSTRAINT fk_user_pendents FOREIGN KEY (pendents_id) REFERENCES pendents (pendents_id) ON DELETE RESTRICT ON UPDATE CASCADE
);


INSERT INTO users VALUES(1,'test','test',1);
