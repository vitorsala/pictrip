CREATE TABLE user(
	user_id INT NOT NULL AUTO_INCREMENT,
    user_name VARCHAR(30) NOT NULL,
    user_surname VARCHAR(30) NOT NULL,
    user_mail VARCHAR(30) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_sex CHAR(1) NOT NULL,
    user_avatar VARCHAR(255),
    user_birthday DATE NOT NULL,
    user_registred DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id),
    UNIQUE (user_mail)
);