/*Remise à zéro de la base de donnée*/
drop database commerce;

create database commerce;

use commerce;

/*Creation des tables*/

create table if not exists produit(
       id_produit int primary key auto_increment,
       designation varchar(64) unique not null,
       descriptif text, 
       quantite int unsigned not null, check (quantite >= 0),
       prix float not null, check (prix >=0 ),
       photo varchar(255),
       enVente boolean not null default false);

create table if not exists catalogue(
       id_catalogue int primary key auto_increment, 
       nom varchar(64) not null unique, 
       dateMAJ date);

create table if not exists reference(
       id_catalogue int, 
       id_produit int,
       primary key(id_catalogue, id_produit),
       foreign key (id_catalogue) references catalogue(id_catalogue), 
       foreign key (id_produit) references produit(id_produit));

create table if not exists ville(
       id_ville int primary key auto_increment, 
       nom varchar(64) not null, 
       CP int unsigned not null);

create table if not exists membre(
       id_membre int primary key auto_increment, 
       nom varchar(64) not null, 
       prenom varchar(64) not null, 
       adresse varchar(64) not null, 
       mail varchar(64) not null unique, 
       tel varchar(10) not null, 
       mdp varchar(20) not null, 
       id_ville int not null, 
       foreign key (id_ville) references ville(id_ville),
       check (mail like '%@%\.%'), 
       check (char_length(tel) = 10));

create table if not exists panier(
       id_membre int, 
       id_produit int,
       quantite int unsigned not null,
       primary key(id_membre, id_produit),
       foreign key (id_membre) references membre(id_membre), 
       foreign key (id_produit) references produit(id_produit),
       check (quantite > 0));

create table if not exists commande(
       id_commande int primary key auto_increment, 
       dateValidation date not null, 
       dateLivraison date not null, 
       adrLivraison varchar(64),
       fraisDePort int unsigned not null,
       id_ville int not null,
       id_membre int not null, 
       foreign key (id_ville) references ville(id_ville),
       foreign key (id_membre) references membre(id_membre), 
       check (dateValidation <= now()),
       check (dateValidation <= dateLivraison));

create table if not exists contenir(
       id_commande int,
       id_produit int, 
       quantite int unsigned not null, 
       PUCommande int unsigned not null, 
       primary key (id_commande, id_produit), 
       foreign key (id_commande) references commande(id_commande), 
       foreign key (id_produit) references produit(id_produit));

create table if not exists avis(
       id_membre int, 
       id_produit int, 
       note tinyint unsigned not null,
       commentaire text, 
       dateAvis date not null, 
       primary key (id_membre, id_produit), 
       foreign key (id_membre) references membre(id_membre), 
       foreign key (id_produit) references produit(id_produit),
       check (note <= 5), 
       check (dateAvis <= now()));

create table if not exists reduction(
 id_reduction int primary key auto_increment,
 date_debut date not null,
 date_fin date not null,check (dateFin >= dateDebut),
 montant float not null, check (montant >= 0),
 seuil float, check (seuil >= 0),
 type tinyint unsigned not null);

create table if not exists promo_produit(
id_promo_produit int primary key,
foreign key(id_promo_produit) references reduction(id_reduction)
);

create table if not exists promo_catalogue(
id_promo_catalogue int primary key,
foreign key(id_promo_catalogue) references reduction(id_reduction)
);

create table if not exists bon_reduction(
id_bon_reduction int primary key,
id_commande int, 
foreign key(id_bon_reduction) references reduction(id_reduction),
foreign key(id_commande) references commande(id_commande)
);

create table if not exists concerne_promo_produit(
id_promo_produit int ,
id_produit int ,
primary key(id_produit,id_promo_produit),
foreign key (id_promo_produit) references promo_produit(id_promo_produit),
foreign key (id_produit) references produit(id_produit)
);

create table if not exists concerne_promo_catalogue(
id_promo_catalogue int ,
id_catalogue int ,
primary key(id_catalogue,id_promo_catalogue),
foreign key (id_promo_catalogue) references promo_catalogue(id_promo_catalogue),
foreign key (id_catalogue) references catalogue(id_catalogue)
);

/* Creation des triggers */

/* Creation des vues */

/* Creation des index */
