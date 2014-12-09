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

delimiter ;