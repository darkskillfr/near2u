<?php
/*
pastouche\env.php
	définit dans la cst ENV si on est sur le serveur "SERVER" ou en local "LOCAL"	
db.php
	contient les fonctions permettant d'accéder à une bdd
db_users.php
	constantes pour la table utilisateur
db_users_local.php
	constantes pour la table utilisateur en si on est en local
db_users_server.php
	constantes pour la table utilisateur en si on est en servuer
entree_json.php
	point d'entrée des requêtes en json
entree_post.php
	point d'entrée des reque^tes en post
requete.php
	Fonctions gérant les requêtes
inscription.php
	inscription d'un nouvel utilisateur

db_maintenance\
	pour maintenir la synchronisation de la structure de la bdd entre serveur et local
	idée :
	- on modifie la structure en local (phpmyadmin)
	- appel de extract.php en local -> crée un fichier schema.php
	- upload de schema.php
	- appel de update_db.php sur le serveur

	Il y a un système de versioning. Mais là extract incrémente la version à chaque fois sans vérifier qu'il y a des changements











*/
