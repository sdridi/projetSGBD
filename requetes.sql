/* Suppression des procédures */
delete from mysql.proc where db='commerce' and type = 'procedure';

use commerce;

delimiter $$

/************** PRODUITS **************/

create procedure get_produit (IN ref int)
begin
	SELECT * FROM produit WHERE id_produit = ref;
end $$

create procedure is_produit_en_vente(IN ref int)
begin
	select enVente from produit where id_produit = ref;
end $$

create procedure search_produit(IN desi varchar(64))
begin
	SELECT id_produit from produit where designation like concat('%', desi, '%');
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
create procedure get_ville (IN ref int)
begin
	select * from ville where id_ville = ref;
end $$

create procedure get_id_ville (IN nom_ville varchar(64), 
       		 	       IN CP_ville int)
begin
	select id_ville from ville where nom = nom_ville and CP = CP_ville;
end $$

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

create procedure get_membre (IN ref int)
begin
	select nom, prenom, adresse, mail, tel, id_ville from membre where id_membre = ref;
end $$

/* Vérifie que le membre a fourni un couple (mail, mdp) valide 
   Si le couple est valide, l'identifiant du membre est retourné
   sinon 0 est retourné */
create procedure check_mdp_membre (IN mail_membre varchar(64), 
       		 		   IN mdp_membre varchar (20))
begin
	select if (exists(select id_membre from membre where mail = mail_membre
	       	  		 	   	       and mdp = mdp_membre),
		   id_membre, 0) as isValid
	       from membre where mail = mail_membre;
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

create procedure update_membre_mdp (IN ref int, 
       		 		    IN mdp_membre varchar(64))
begin
	update membre set mdp = mdp_membre where id_membre = ref;
end $$

create procedure delete_membre (IN ref int)
begin
	delete from membre where id_membre = ref;
	delete from panier where id_membre = ref;
	delete from commande where id_membre = ref;
end $$

create procedure get_admin (IN ref int)
begin
	select username, droits, mail from admin where id_admin = ref;
end $$

/* Vérifie que l'admin a fourni un couple (username, mdp) valide 
   Si le couple est valide, l'identifiant de l'admin est retourné
   sinon 0 est retourné */
create procedure check_admin_mdp (IN username_admin varchar(64), 
       		 		  IN mdp_admin varchar(64))
begin 
      	select if (exists(select id_admin from admin where username = username_admin
	       	  		 	   	       and mdp = mdp_admin),
		   id_admin, 0) as isValid
	       from admin where username = username_admin;
end $$

create procedure create_admin (IN username_admin varchar(64), 
       		 	       IN droits_admin tinyint, 
			       IN mdp_admin varchar(64), 
			       IN mail_admin varchar(64))
begin
	insert into admin(username, droits, mdp, mail) values (username_admin,
	       	    		    	    	       	       droits_admin,
							       mdp_admin, 
							       mail_admin);
end $$

create procedure update_admin (IN ref int, 
       		 	       IN username_admin varchar(64), 
       		 	       IN droits_admin tinyint, 
			       IN mdp_admin varchar(64), 
			       IN mail_admin varchar(64))
begin
	update admin set username = username_admin, 
	       	     	 droits = droits_admin, 
			 mdp = mdp_admin,
			 mail = mail_admin
		     where id_admin = ref;
end $$

create procedure delete_admin (IN ref int)
begin
	delete from admin where id_admin = ref;
end $$

create procedure update_droits_admin (IN ref int, 
       		 		      IN droits_admin tinyint)
begin
	update admin set droits = droits_admin where id_admin = ref;
end $$

/************** PANIERS **************/
create procedure get_panier(IN ref_membre int)
begin
	select * from panier natural join produit where id_membre = ref_membre;
end $$

/* Ajoute un article au panier */
create procedure add_to_panier (IN ref_membre int, 
       		 		IN ref_produit int, 
				IN qte int unsigned)
begin
	insert into panier(id_membre, id_produit, quantite) values (ref_membre, ref_produit, qte);
end $$

/* Retire un article du panier */
create procedure delete_from_panier (IN ref_membre int, 
       		 		     IN ref_produit int)
begin
	delete from panier where id_membre = ref_membre and id_produit = ref_produit;
end $$

/* Modifie la quantité achetée d'un article */
create procedure update_quantite_panier (IN ref_membre int, 
       		 			 IN ref_produit int, 
					 IN qte int unsigned)
begin
	update panier set quantite = qte where id_membre = ref_membre and id_produit = ref_produit;
end $$

/* Vide le panier d'un client */
create procedure empty_panier (IN ref_membre int)
begin
	delete from panier where id_membre = ref_membre;
end $$

/************** COMMANDES **************/
create procedure get_commande (IN ref_commande int)
begin
	select * from commande where id_commande = ref_commande;
end $$

/* Retourne l'ensemble des produits concernés par une commande, 
   ainsi que l'identifiant des promos s'y appliquant lors de la commande */
create procedure get_commande_produits_promos (IN ref_commande int, 
       		 			       IN date_commande date)
begin
	select id_produit, id_promo_produit as id_promo, 'PRODUIT' as type
	from concerne_promo_produit natural join promo_produit
	     			    natural join reduction
	where date_debut < date_commande and date_fin > date_commande
	union
	select id_produit, id_promo_catalogue as id_promo, 'CATALOGUE' as type
	from produit_promo_catalogue
	where date_debut < date_commande and date_fin > date_commande;
end $$

/* Retourne le prix unitaire des articles d'une commande lorsque celle-ci a été validée
   ainsi que la quantité d'article acheté */
create procedure get_commande_produits_PU_quantite (IN ref_commande int)
begin
	select id_produit, quantite, PUCommande
	from contenir
	where id_commande = ref_commande;
end $$

/* Retourne l'ensemble des commande d'un membre */
create procedure get_commandes (IN ref_membre int)
begin
	select id_commande
	from commande
	where id_membre = ref_membre;
end $$

/* Met à jour toutes les quantités de produit après la validation d'une commande

   /!\ PROCEDURE UTILISEE UNIQUEMENT PAR validate_commande, 
       ET NON PAS PAR L'UTILISATEUR DE LA BASE DE DONNEE*/
create procedure update_quantite_commande (IN ref_commande int, 
       		 			   IN ref_membre int )
begin
	/* Fonctionnement : 
	   On crée un curseur sur une requete récupérant tous les
	   produits et leurs quantités dansa le panier du membre. 
	   Tant que le curseur pointe sur un produit, il met à jour
	   les quantités de ce dernier dans produits, grace à une
	   boucle faire...tant que. 
	   Une fois qu'il a fini, le curseur est fermé*/

	declare done int default 0; /* condition d'arret */
	declare id_prod int; /* variable stockant l'id du produit */
	declare qte int; /* variable stockant la quantité du produit acheté */
	declare cur cursor for select id_produit, quantite from panier where id_membre = ref_membre; /* curseur servant à la boucle for */
	declare continue handler for not found set done = 1; /* handler passant la condition d'arret à 1 quand tous les produits ont été traités*/

	open cur;

	repeat
		fetch cur into id_prod, qte; /*stockage de la ligne dans id_prod et qte*/
		if not done then /*vérification que done != 1 , dans le cas où le panier est vide*/
		   call update_produit_quantite(id_prod, qte); /*Mise à jour de la quantité de produit*/
		end if;
	until done end repeat; /* fin de la boucle faire... tant que*/

	close cur;
end $$

/* Valide la commande d'un membre à partir de son panier 
   La mise à jour des quantités n'est pas gérée et doit 
   etre faite dans le code se servant de la base de donnée*/
create procedure validate_commande (IN ref_membre int, 
       		 		    IN dateLivr date, 
				    IN adrLivr varchar(64), 
				    IN fdp int unsigned, 
				    IN id_ville_membre int, 
				    IN id_bon int)
begin
	/*Creation de la commande*/
	insert into commande(dateValidation, dateLivraison, adrLivraison, fraisDePort, id_ville, id_membre)
	       	    values (now(), dateLivr, adrLivr, fdp, id_ville_membre, ref_membre);
	
	/*Transfert du panier vers la commande*/
	insert into contenir(id_commande, id_produit, quantite, PUCommande)
	       	    select LAST_INSERT_ID(), id_produit, quantite, prix 
		    from panier natural join produit
		    where id_membre = ref_membre;

	/* Mise à jour des quantités */
	call update_quantite_commande(LAST_INSERT_ID(), ref_membre);

	/*Vidage du panier*/
	call empty_panier(ref_membre);

	/* Application du bon de reduction */
	if (id_bon_reduction <> null) then
	   update bon_reduction set id_commande = LAST_INSERT_ID() where id_bon_reduction = id_bon;
	end if;
end $$

/************** AVIS **************/
create procedure get_avis (IN ref_produit int)
begin
	select note, commentaire, dateAvis, nom, prenom
	from avis natural join membre
	where id_produit = ref_produit;
end $$

create procedure add_avis (IN ref_produit int, 
       		 	   IN ref_membre int, 
			   IN note_avis tinyint unsigned, 
			   IN commentaire_avis text)
begin
	insert into avis(id_produit, id_membre, note, commentaire, dateAvis)
	       	    values (ref_produit, ref_membre, note_avis, commentaire_avis, now());
end $$

create procedure delete_avis (IN ref_produit int, 
       		 	      IN ref_membre int)
begin
	delete from avis where id_produit = ref_produit and id_membre = ref_membre;
end $$

/************** REDUCTIONS & PROMOS **************/
create procedure get_promo_produit (IN ref_promo int)
begin
	select * 
	from promo_produit left join reduction on promo_produit.id_promo_produit = id_reduction
	where id_promo_produit = ref_promo;
end $$

create procedure get_promo_catalogue (IN ref_promo int)
begin
	select * 
	from promo_catalogue left join reduction on promo_catalogue.id_promo_catalogue = id_reduction
	where id_promo_catalogue = ref_promo;
end $$

create procedure get_bon_reduction (IN ref_bon int)
begin
	select * 
	from bon_reduction left join reduction on bon_reduction.id_bon_reduction = id_reduction
	where id_bon_reduction = ref_bon;
end $$

create procedure create_reduction (IN date_debut_promo date, 
       		 		   IN date_fin_promo date, 
			       	   IN montant_promo float, 
				   IN seuil_promo float, 
				   IN type_promo tinyint unsigned)
begin 
	insert into reduction(date_debut, date_fin, montant, seuil, type)
	       	    values(date_debut_promo, date_fin_promo, montant_promo, seuil_promo, type_promo);      
end $$

create procedure create_promo_produit (IN date_debut_promo date, 
       		 		       IN date_fin_promo date, 
				       IN montant_promo float, 
				       IN seuil_promo float, 
				       IN type_promo tinyint unsigned, 
				       IN ref_produit int)
begin
	call create_reduction(date_debut_promo, date_fin_promo, montant_promo, seuil_promo, type_promo);
	insert into promo_produit(id_promo_produit) values(LAST_INSERT_ID());
	insert into concerne_promo_produit(id_promo_produit, id_produit)
	       	    values (LAST_INSERT_ID(), ref_produit);
end $$

create procedure create_promo_catalogue (IN date_debut_promo date, 
       		 		       IN date_fin_promo date, 
				       IN montant_promo float, 
				       IN seuil_promo float, 
				       IN type_promo tinyint unsigned, 
				       IN ref_catalogue int)
begin
	call create_reduction(date_debut_promo, date_fin_promo, montant_promo, seuil_promo, type_promo);
	insert into promo_catalogue(id_promo_catalogue) values(LAST_INSERT_ID());
	insert into concerne_promo_catalogue(id_promo_catalogue, id_catalogue)
	       	    values (LAST_INSERT_ID(), ref_catalogue);
end $$

create procedure create_bon_reduction (IN date_debut_bon date, 
       		 		       IN date_fin_bon date, 
				       IN montant_bon float, 
				       IN seuil_bon float, 
				       IN type_bon tinyint unsigned)
begin
	call create_reduction(date_debut_bon, date_fin_bon, montant_bon, seuil_bon, type_bon);
	insert into bon_reduction(id_bon_reduction) values(LAST_INSERT_ID());
end $$
/*
create_promo
*/
delimiter ;
