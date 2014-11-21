drop database commerce;

create database commerce;

use commerce;

create table produit(
       reference int primary key auto_increment,
       designation varchar(64) unique not null,
       descriptif text, 
       quantite int not null, check (quantite >= 0),
       prix float not null, check (prix >=0 ),
       photo varchar(255),
       enVente boolean not null default false);
