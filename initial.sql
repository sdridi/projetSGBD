use commerce;

insert into ville (nom, CP)
       	    values ('Bordeaux', 33000),
	    	   ('Pessac', 33600),
		   ('Gradignan', 33170),
		   ('Talence', 33400);

insert into membre (nom, prenom, adresse, mail, tel, mdp, id_ville)
       	    values ('Rivero', 'Arnaud', '10 rue Lucie Aubrac', 'arivero@enseirb-matmeca.fr', 0631086391, '123456', 2),
	    	   ('Lo', 'Oumar', '24 cours de la Marne', 'oulo@enseirb-matmeca.fr',0654128564, 'oulo', 1),
		   ('Dridi', 'Sami', '2 avenue Jean Babin', 'sdridi@enseirb-matmeca.fr', 0564812359, '5drid1', 2);

insert into produit (designation, descriptif, quantite, prix, photo, enVente)
       	    values ('Produit 1', 'Description du produit 1', 500, 20, null, true),
	    	   ('Produit 2', 'Description du produit 2', 12, 599, null, false),
		   ('Produit 3', null, 50000, 1.5, 'Adresse de la photo du produit 3', true);

insert into catalogue (nom, dateMAJ) 
       	    values ('Premier catalogue', '2014-12-12'),
	    	   ('Second catalogue', '2014-11-25');

insert into reference (id_catalogue, id_produit)
       	    values (1, 1),
	    	   (1, 3),
		   (2, 2),
		   (2, 3);

insert into panier (id_membre, id_produit, quantite)
       	    values (1, 2, 1), 
	    	   (1, 1, 20),
		   (2, 3, 100);

insert into commande (dateValidation, dateLivraison, adrLivraison, fraisDePort, id_ville, id_membre)
       	    values (2014-11-17, 2014-11-24, null, 0, null, 1), 
	    	   (2014-12-04, 2014-12-07, null, 0, null, 1), 
	    	   (2014-12-01, 2014-12-03, '1 rue du docteur Albert Schweitzer', 5, 4, 3);

insert into contenir (id_commande, id_produit, quantite, PUCommande)
       	    values (1, 1, 1, 25),
	    	   (1, 3, 200, 1.5)
		   (1, 2, 1, 659), 
		   (2, 3, 500, 1.5), 
		   (3, 1, 1, 20);

insert into avis (id_membre, id_produit, note, commentaire, dateAvis)
       	    values (1, 2, 5, 'Très bon produit', 2014-12-13), 
	    	   (3, 1, 3, null, 2014-12-07);
