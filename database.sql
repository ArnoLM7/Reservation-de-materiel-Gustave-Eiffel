create database if not exists reservation;
use reservation;
drop TABLE if EXISTS user;
drop TABLE if EXISTS reservation;
drop TABLE if EXISTS material;

create table user(
                     id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                     email varchar(50),
                     firstname varchar(50),
                     lastname varchar(50),
                     birth_date Date,
                     password varchar(255),
                     is_admin int DEFAULT 0
);

create table material(
                         id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                         name varchar(50),
                         type varchar(50),
                         reference varchar(50),
                         description text(2000)
);

create table reservation(
                            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                            id_material int,
                            begin_date Date,
                            end_date Date,
                            status varchar(50),
                            FOREIGN KEY (id_material) REFERENCES material(id)
);