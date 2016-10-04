CREATE DATABASE Millenial;

CREATE TABLE Millenial.Users
(
    User_ID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    profile_picture_path VARCHAR(50),
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



CREATE TABLE Millenial.UserBanking
(
    ID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    User_ID INT(11) NOT NULL,
    Debit_ID INT(11),
    Credit_ID INT(11),
    bank_ID INT(11),
    has_debit TINYINT(1) DEFAULT 0,
    has_credit TINYINT(1) DEFAULT 0,
    has_bank TINYINT(1) DEFAULT 0
);

CREATE TABLE Millenial.Debit
(
    ID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Number INT(11) NOT NULL,
    bank VARCHAR(50) NOT NULL
);

CREATE TABLE Millenial.Credit
(
    ID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Number INT(11) NOT NULL,
    Company VARCHAR(50) NOT NULL,
    security_number VARCHAR(50) NOT NULL,
    expiration_date DATE NOT NULL
);

CREATE TABLE Millenial.Bank
(
    ID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Account_Number INT(11) NOT NULL,
    Routing_Number INT(11) NOT NULL,
    name VARCHAR(50) NOT NULL,
);

-- stored procedures for those tables
DELIMITER //
CREATE PROCEDURE AddDebit(IN number INT(11), IN bank VARCHAR(50))
  BEGIN
    INSERT INTO Millenial.Debit (Number, bank) VALUES (number,bank);
  END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE AddCredit(IN number INT(11), IN bank VARCHAR(50), IN security_number VARCHAR(50), IN expiration_date DATE)
  BEGIN
    INSERT INTO Millenial.Credit (Number, company, security_number, expiration_date) VALUES (number,bank, security_number, expiration_date);
  END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE AddBank(IN Account_Number INT(11), IN Routing_Number INT(11), IN name VARCHAR(50))
  BEGIN
    INSERT INTO Millenial.Bank (Account_Number, Routing_Number, name) VALUES (Account_Number, Routing_Number, name);
  END //
DELIMITER ;



CREATE TABLE Millenial.NotificationsUsers
(
    ID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    User_ID INT(11) NOT NULL,
    comment_reply TINYINT(1) DEFAULT 1,
    comment_like TINYINT(1) DEFAULT 1,
    bet_closes TINYINT(1) DEFAULT 1,
    bet_outcome TINYINT(1) DEFAULT 1,
    bet_available TINYINT(1) DEFAULT 1,
    placing_bet TINYINT(1) DEFAULT 1,
    receiving_message TINYINT(1) DEFAULT 1
);

CREATE TABLE Millenial.NotificationTypesUsers
(
    ID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    User_ID INT(11) NOT NULL,
    email TINYINT(1) DEFAULT 1,
    insite TINYINT(1) DEFAULT 1,
    push_phone TINYINT(1) DEFAULT 0,
    push_desktop TINYINT(1) DEFAULT 1
);

-- stored procedures for those tables
DELIMITER //
CREATE PROCEDURE AddNotificationsUsers(IN userid INT(11), IN comment_reply TINYINT(1), IN comment_like TINYINT(1), IN bet_closes TINYINT(1), IN bet_outcome TINYINT(1), IN bet_available TINYINT(1), IN placing_bet TINYINT(1), IN receiving_message TINYINT(1))
  BEGIN
    INSERT INTO Millenial.NotificationsUsers (User_ID, comment_reply, comment_like, bet_closes, bet_outcome, bet_available, placing_bet, receiving_message) 
    VALUES (userid, comment_reply, comment_like, bet_closes, bet_outcome, bet_available, placing_bet, receiving_message);
  END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE AddNotificationTypesUsers(IN userid INT(11), IN email TINYINT(1), IN insite TINYINT(1), IN push_phone TINYINT(1), IN push_desktop TINYINT(1))
  BEGIN
    INSERT INTO Millenial.NotificationTypesUsers (User_ID, email, insite, push_phone, push_desktop) 
    VALUES (userid, email, insite, push_phone, push_desktop);
  END //
DELIMITER ;

