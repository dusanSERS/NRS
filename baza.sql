CREATE DATABASE izbira_smv;
USE izbira_smv;

CREATE TABLE izbira
(
	ime varchar(50) not null,
	priimek varchar(50) not null,
	razred CHAR(5) not null,
	email char(100) primary key,
	telefon char(20) UNIQUE NOT NULL,
   datum_oddaje datetime NOT NULL,
   izbira1 varchar(20) NOT NULL,
   izbira2 varchar(20) NOT NULL,
   izbira3 varchar(20) NOT NULL,
   izbira4 varchar(20) NOT NULL
);

CREATE USER 'denis_rw'@'%' IDENTIFIED BY 'test';
GRANT SELECT,INSERT ON izbira_smv.izbira TO 'denis_rw'@'%' IDENTIFIED BY 'test';
FLUSH PRIVILEGES;

CREATE USER 'denis_rw'@'localhost' IDENTIFIED BY 'test';
GRANT SELECT,INSERT ON izbira_smv.izbira TO 'denis_rw'@'localhost' IDENTIFIED BY 'test';
FLUSH PRIVILEGES;

CREATE USER 'denis_rw'@'%' IDENTIFIED BY 'test';
GRANT SELECT,INSERT ON izbira_smv.izbira TO 'denis_rw'@'localhost' IDENTIFIED BY 'test';
FLUSH PRIVILEGES;

CREATE USER 'denis_rw'@'127.0.0.1' IDENTIFIED BY 'test';
GRANT SELECT,INSERT ON izbira_smv.izbira TO 'denis_rw'@'127.0.0.1' IDENTIFIED BY 'test';
FLUSH PRIVILEGES;

DROP USER 'denis_rw'@'localhost';
DROP USER 'denis_rw'@'127.0.0.1';
DROP USER 'denis_rw'@'%';

INSERT INTO izbira VALUES ('Tanja','Ziher','3ar','d.t@gmewwail.com','03232-123-123','2024.4.10','Java','C++','Android','Linux');
SELECT USER, HOST, plugin  FROM mysql.user;