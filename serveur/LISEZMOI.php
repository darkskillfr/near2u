<?php
/*
pastouche\env.php
	d�finit dans la cst ENV si on est sur le serveur "SERVER" ou en local "LOCAL"	
db.php
	contient les fonctions permettant d'acc�der � une bdd
db_users.php
	constantes pour la table utilisateur
db_users_local.php
	constantes pour la table utilisateur en si on est en local
db_users_server.php
	constantes pour la table utilisateur en si on est en servuer
entree_json.php
	point d'entr�e des requ�tes en json
entree_post.php
	point d'entr�e des reque^tes en post
requete.php
	Fonctions g�rant les requ�tes
inscription.php
	inscription d'un nouvel utilisateur

db_maintenance\
	pour maintenir la synchronisation de la structure de la bdd entre serveur et local
	id�e :
	- on modifie la structure en local (phpmyadmin)
	- appel de extract.php en local -> cr�e un fichier schema.php
	- upload de schema.php
	- appel de update_db.php sur le serveur

	Il y a un syst�me de versioning. Mais l� extract incr�mente la version � chaque fois sans v�rifier qu'il y a des changements











*/
