/* Suppression des procédures */
delete from mysql.proc where db='commerce' and type = 'procedure';

use commerce;

delimiter $$

/************** PRODUITS **************/

create procedure get_produit (IN ref int)
begin
	SELECT * FROM produit WHERE id_produit = ref;
end $$

create procedure add_produit (IN desi varchar(64),
       		 	      IN descri text,
			      IN qte int unsigned, 
			      IN prx float,
			      IN pht varchar(255),
			      IN EV boolean)
begin
	insert into produit(designation, descriptif, quantite, prix, photo, enVente) values (desi, descri, qte, prx, pht, EV);
end $$

/* Met tout le produit à jour */
create procedure update_produit (IN ref int,
       		 		 IN desi varchar(64),
       		 		 IN descri text,
			      	 IN qte int unsigned, 
			      	 IN prx float,
			      	 IN pht varchar(255),
			      	 IN EV boolean)
begin
	update produit set designation = desi,
	       	       	   descriptif = descri,
		       	   quantite = qte,
		       	   prix = prx,
		       	   photo = pht,
		       	   enVente = EV
		       where id_produit = ref;
end $$

/* Retire qte de la quantite de produit restant */
create procedure update_produit_quantite (IN ref int, 
       		 		  IN qte int)
begin 
      update produit set quantite = quantite - qte where id_produit = ref;
end $$

/* Met uniquement le prix du produit à jour */
create procedure update_produit_prix (IN ref int, 
       		 	      IN PU int)
begin 
      update produit set prix = PU where id_produit = ref;
end $$

/* Met en vente ou retire de la vente le produit */
create procedure update_produit_status (IN ref int)
begin
	update produit set enVente = not enVente where id_produit = ref;
end $$

create procedure delete_produit (IN ref int)
begin
	delete from produit where id_produit = ref;
end $$

/************** CATALOGUES **************/

create procedure get_catalogue (IN ref int)
begin
	select * from catalogue where id_catalogue = ref;
end $$

/* Retourne l'ensemble des produits référencés par un catalogue */
create procedure get_produit_from_catalogue (IN ref int)
begin
	select * from catalogue natural join reference
		      		natural join produit
		 where id_catalogue = ref;
end $$

create procedure create_catalogue (IN name varchar(64))
begin
	insert into catalogue(nom, dateMAJ) values (name, now());
end $$

/* Met à jour le nom d'un catalogue */
create procedure update_catalogue (IN id int, 
       		 		   IN name varchar(64))
begin
	update catalogue set nom = name, 
	       		     dateMAJ = now
			 where id_catalogue = id;
end $$


create procedure delete_catalogue (IN id int)
begin
	delete from catalogue where id_catalogue = id;
end $$

/* Ajoute un produit au catalogue */
create procedure add_to_catalogue (IN id_catalog int, 
       		 		   IN id_prod int)
begin
	insert into reference (id_produit, id_catalogue) values (id_prod, id_catalog);
	update catalogue set dateMAJ = now();
end $$

/* Retire un produit du catalogue */
create procedure delete_from_catalogue (IN id_catalog int, 
		       		        IN id_prod int)
begin
	delete from reference where id_catalogue = id_catalog
	       	    	      and id_produit = id_prod;
	update catalogue set dateMAJ = now();
end $$

/************** MEMBRES, ADMINS & VILLES **************/

create procedure add_ville (IN nom_ville varchar(64),
       		 	    IN CP_ville int unsigned)
begin
	insert into ville(nom, CP) values (nom_ville, CP_ville);
end $$

create procedure update_ville (IN ref int, 
       		 	       IN nom_ville varchar(64),
			       IN CP_ville int unsigned)
begin
	update ville set nom = nom_ville, 
	       	     	 CP = CP_ville
		     where id_ville = ref;
end $$

create procedure delete_ville (IN ref int)
begin
	delete from ville where id_ville = ref;
end $$

create procedure create_membre (IN nom_membre varchar(64), 
       		 	        IN prenom_membre varchar(64), 
				IN adresse_membre varchar(64),
				IN mail_membre varchar(64),
				IN tel_membre varchar(10),
				IN mdp_membre varchar(20),
				IN id_ville_membre int)
begin
	insert into membre(nom, prenom, adresse, mail, tel, mdp, id_ville) 
	       	    values(nom_membre, 
		    	   prenom_membre, 
			   adresse_membre, 
			   mail_membre, 
			   tel_membre, 
			   mdp_membre, 
			   id_ville_membre);
end $$

create procedure update_membre (IN ref int,
				IN nom_membre varchar(64), 
       		 	        IN prenom_membre varchar(64), 
				IN adresse_membre varchar(64),
				IN mail_membre varchar(64),
				IN tel_membre varchar(10),
				IN mdp_membre varchar(20),
				IN id_ville_membre int)
begin
	update membre set nom = nom_membre, 
	       	      	  prenom = prenom_membre, 
			  adresse = adresse_membre,
			  mail = mail_membre, 
			  tel = tel_membre, 
			  mdp = mdp_membre, 
			  id_ville = id_ville_membre
		      where id_membre = ref;
end $$

create procedure delete_membre (IN ref int)
begin
	delete from membre where id_membre = ref;
	delete from panier where id_membre = ref;
	delete from commande where id_membre = ref;
end $$

/*create_admin
update_admin
delete admin
update_droits_admin*/
/************** PANIERS **************/

/************** COMMANDES **************/

/************** AVIS **************/

/************** REDUCTIONS & PROMOS **************/
delimiter ;
