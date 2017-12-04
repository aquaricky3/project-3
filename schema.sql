-- MySQL dump 10.11
--
-- to install this database, from a terminal, type:
-- mysql -u USERNAME -p -h SERVERNAME schema < schema.sql
--
-- Host: localhost    Database: cheapomail
-- ------------------------------------------------------
-- Server version   5.0.45-log

DROP DATABASE IF EXISTS cheapomail;
CREATE DATABASE cheapomail;
USE cheapomail;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id int(10) NOT NULL auto_increment,
  firstname char(20) NOT NULL,
  lastname char(20) NOT NULL,
  username char(20) NOT NULL UNIQUE,
  password char(20) NOT NULL UNIQUE,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Messages;
CREATE TABLE Messages (
  id int(10) NOT NULL auto_increment,
  receipient_ids int NOT NULL UNIQUE,
  sender_id int NOT NULL,
  subject char(35) NOT NULL default '',
  body char(200) NOT NULL default '',
  date_sent TIMESTAMP,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Messages_read;
CREATE TABLE Messages_read (
  id int(10) NOT NULL auto_increment,
  message_id int NOT NULL,
  reader_id int NOT NULL,
  date_read DATE NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO users VALUES ('1', 'Ricardo', 'Miller', 'admin', 'password123');
