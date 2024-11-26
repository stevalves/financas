CREATE DATABASE financas;

USE financas;

CREATE TABLE category (
   id INT NOT NULL AUTO_INCREMENT,
   name VARCHAR(50) NOT NULL,
   PRIMARY KEY (id)
);

INSERT INTO category (name)
VALUES 
 ('Trabalho'),
 ('Alimentação'),
 ('Lazer'),
 ('Transporte');

CREATE TABLE month (
   id INT NOT NULL AUTO_INCREMENT,
   month VARCHAR(50) NOT NULL,
   year INT NOT NULL,
   PRIMARY KEY (id)
);

INSERT INTO month (month, year)
VALUES 
 ('Novembro', 2024),
 ('Dezembro', 2023),
 ('Janeiro', 2024);

CREATE TABLE transaction (
   id INT NOT NULL AUTO_INCREMENT,
   type VARCHAR(10) NOT NULL,
   description VARCHAR(255),
   value DECIMAL(9,2) NOT NULL,
   created_at DATE NOT NULL,
   category_id INT NOT NULL,
   month_id INT NOT NULL,
   FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE,
   FOREIGN KEY (month_id) REFERENCES month (id) ON DELETE CASCADE,
   PRIMARY KEY (id)
);

INSERT INTO transaction (type, description, value, created_at, category_id, month_id)
VALUES 
 ('Entrada', "Salário", 990.00, '2024-11-04', 1, 1),
 ('Saída', 'Passeio no parque', 203.99, '2024-11-07', 3, 1),
 ('Saída', 'Ônibus da escola', 199.99, '2024-11-11', 4, 1);