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
DELIMITER //
CREATE PROCEDURE AddUser(IN name VARCHAR(50), IN username VARCHAR(50), IN password VARCHAR(50), IN email VARCHAR(50))
  BEGIN
    INSERT INTO Millenial.Users(Name, username, password, email)  VALUES (name,username,password,email);
  END //
DELIMITER ;


-- Use this query when user logs in to compare password
-- think about encrypting
SELECT password from Millenial.Users WHERE username = "";

-- when the user forgets the password send email
-- update the password based off of email
UPDATE Millenial.Users SET password = "temp" WHERE email = "email";
UPDATE Millenial.Users SET forgot_password = 1 WHERE email = "email";

DELIMITER //
CREATE PROCEDURE forgotPassword(IN _email VARCHAR(50))
  BEGIN
    UPDATE Millenial.Users SET password = "temp" WHERE email = _email;
	UPDATE Millenial.Users SET forgot_password = 1 WHERE email = _email;
  END //
DELIMITER ;


-- when the user forgets the username send email
-- update the username and password based off of email
UPDATE Millenial.Users SET username = "temp", password = "temp" WHERE email = "email";
UPDATE Millenial.Users SET forgot_username = 1 WHERE email = "email";

DELIMITER //
CREATE PROCEDURE forgotPassword(IN _email VARCHAR(50))
  BEGIN
    UPDATE Millenial.Users SET username = "temp", password = "temp" WHERE email = _email;
	UPDATE Millenial.Users SET forgot_username = 1 WHERE email = _email;
  END //
DELIMITER ;


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


CREATE TABLE Millenial.Bet
(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    creator_user_id INT(11) NOT NULL,
    description LONGTEXT,
    open TINYINT(1) DEFAULT 0,
    has_bets TINYINT(1) DEFAULT 0,
    created_at TINYINT(1),
    updated_at TINYINT(1)
);

CREATE TABLE Millenial.Bet_User
(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    bet_id INT(11) NOT NULL,
    bet_amount INT(11) NOT NULL,
    created_at TINYINT(1),
    updated_at TINYINT(1)
);

CREATE TABLE Millenial.Bet_Source
(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    bet_id INT(11) NOT NULL,
    source_id INT(11) NOT NULL,
    created_at TINYINT(1),
    updated_at TINYINT(1)
);

CREATE TABLE Millenial.Bank
(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(256) NOT NULL,
    created_at TINYINT(1),
    updated_at TINYINT(1)
);

DELIMITER //
CREATE PROCEDURE AddBank(IN bank_name VARCHAR(256))
  BEGIN
    INSERT INTO Millenial.Bank (name, created_at) 
    VALUES (bank_name, NOW())
    ON DUPLICATE UPDATE update_at=VALUES(created_at);
  END //
DELIMITER ;

CREATE TABLE Millenial.User_Bank
(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    bank_id INT(11) NOT NULL,
    acount_number INT(11) NOT NULL,
    created_at TINYINT(1),
    updated_at TINYINT(1)
);

DELIMITER //
CREATE PROCEDURE AddUserBank(IN user_id INT(11), IN bank_id INT(11))
  BEGIN
    INSERT INTO Millenial.User_Bank (user_id, bank_id, created_at) 
    VALUES (user_id, bank_id, NOW())
    ON DUPLICATE UPDATE update_at=VALUES(created_at);
  END //
DELIMITER ;

CREATE TABLE Millenial.User_Account
(
    id INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    account_balance INT(11) NOT NULL,
    created_at TINYINT(1),
    updated_at TINYINT(1)
);

DELIMITER //
CREATE PROCEDURE AddUserAccount(IN user_id INT(11), IN account_balance INT(11))
  BEGIN
    INSERT INTO Millenial.User_Account (user_id, account_balance, created_at) 
    VALUES (user_id, account_balance, NOW())
    ON DUPLICATE UPDATE update_at=VALUES(created_at);
  END //
DELIMITER ;