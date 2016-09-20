CREATE DATABASE Millenial;

CREATE TABLE Millenial.Users
(
    User_ID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    forgot_username TINYINT(1) DEFAULT 0,
    forgot_password TINYINT(1) DEFAULT 0
);
CREATE UNIQUE INDEX Users_email_uindex ON Millenial.Users (email);

-- when user registers
INSERT INTO Millenial.Users(Name, username, password, email)  VALUES ("name","username","password","email");

-- Use this query when user logs in to compare password
-- think about encrypting
SELECT password from Millenial.Users WHERE username = "";

-- when the user forgets the password send email
-- update the password based off of email
UPDATE Millenial.Users SET password = "temp" WHERE email = "email";
UPDATE Millenial.Users SET forgot_password = 1 WHERE email = "email";

-- when the user forgets the username send email
-- update the username and password based off of email
UPDATE Millenial.Users SET username = "temp", password = "temp" WHERE email = "email";
UPDATE Millenial.Users SET forgot_username = 1 WHERE email = "email";

