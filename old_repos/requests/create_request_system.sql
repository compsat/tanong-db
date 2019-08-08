DROP DATABASE IF EXISTS request_system;
CREATE DATABASE request_system;
USE request_system;
CREATE TABLE login_t(
	id_number INT(6) NOT NULL,
	user_type VARCHAR(1) NOT NULL,
	first_name VARCHAR(15) NOT NULL,
	mi VARCHAR(1),
	last_name VARCHAR(15) NOT NULL,
	password VARCHAR(15) NOT NULL,
	PRIMARY KEY(id_number)
);

CREATE TABLE request_user_t(	
	requested_by INT(6) NOT NULL,
	lrn VARCHAR(12) NOT NULL,
	gender VARCHAR(1) NOT NULL,
	first_name VARCHAR(15) NOT NULL,
	mi VARCHAR(1),
	last_name VARCHAR(15) NOT NULL,
	school_year INT(4) NOT NULL,
	grade INT(2) NOT NULL,
	current_section VARCHAR(10),
	adviser VARCHAR(31),
	contact_number VARCHAR(15),
	PRIMARY KEY(requested_by)
);

CREATE TABLE document_t(
	document_id INT(2) NOT NULL,
	document_type VARCHAR(20) NOT NULL,
	document_desc VARCHAR(50) NOT NULL,
	document_temp BLOB, 
	PRIMARY KEY (document_id)
);

CREATE TABLE request_t(
	request_no INT(5) AUTO_INCREMENT,
	document_id INT(2) NOT NULL,
	requested_by INT(6) NOT NULL,
	id_number INT(6) NOT NULL,
	contact_number VARCHAR(30) NOT NULL,
	request_date DATE NOT NULL,
	due_date DATE NOT NULL,
	purpose VARCHAR(100) NOT NULL,
	remarks VARCHAR(100),
	status VARCHAR(1) NOT NULL,
	PRIMARY KEY (request_no),
	FOREIGN KEY (id_number) REFERENCES login_t(id_number),
	FOREIGN KEY (document_id) REFERENCES document_t(document_id),
	FOREIGN KEY (requested_by) REFERENCES request_user_t(requested_by)
);

