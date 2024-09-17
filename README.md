# Brif6 : Extension du Système de Gestion Bancaire


**1. Contexte **

Dans le cadre de son engagement continu à offrir des services bancaires innovants et à rester à la pointe de la technologie, CIH Banque a décidé d'élargir les fonctionnalités de son système de gestion existant. Ce cahier des charges étend le projet initial de gestion bancaire pour inclure la gestion des utilisateurs, des rôles, des banques, des agences, des distributeurs et des adresses. L'objectif est d'enrichir l'expérience des étudiants en informatique en intégrant de nouvelles fonctionnalités et en étendant les opérations CRUD.

​

2. Nouvelles Fonctionnalités

​

Gestion des Utilisateurs

​

Ajout d'un utilisateur avec les informations suivantes : id, username, password, confirmPassword.

Mise à jour des informations d'un utilisateur.

Suppression d'un utilisateur.

Affichage

​

Gestion des Roles

​

Ajout d'un rôle avec les informations suivantes : id, name.

Mise à jour des informations d'un rôle.

Suppression d'un rôle.

Affichage

​

Authentification

​

by username et password

​

Gestion des Banques

​

Ajout d'une banque avec les informations suivantes : id, nom, logo.

Mise à jour des informations d'une banque.

Suppression d'une banque.

Affichage

​

Gestion des Agences

​

Ajout d'une agence avec les informations suivantes : id, longitude, latitude, adresse.

Mise à jour des informations d'une agence.

Suppression d'une agence.

Afficahge

​

Gestion des Distributeurs

​

Ajout d'un distributeur avec les informations suivantes : id, longitude, latitude, adresse.

Mise à jour des informations d'un distributeur.

Suppression d'un distributeur.

Afficahge

​

Gestion des Adresses

​

Ajout d'une adresse avec les informations suivantes : id, ville, quartier, rue, codePostal, email, téléphone.

Mise à jour des informations d'une adresse.

Suppression d'une adresse.

Affichage

​

3.Relations et Associations

​

Un client est associé à une adresse.

Une banque peut avoir une liste d'agences et de distributeurs associés.

Un utilisateur peut avoir un ou plusieurs roles , un Role peut etre assigné à un ou plusieurs users

​

Style : un framework de CSS

​

4. Modélisation et UML

​

Utilisation de la modélisation UML pour créer des diagrammes de classe, de cas d'utilisation et de séquence, reflétant les nouvelles entités et leurs relations.

établir le diagramme de cas d'utilisation, le diagramme de séquence, le diagramme de cas de transition et le diagramme de classe

​

Important et Bonus :

=>les mots de passes ne doivent pas etre stockés en clair dans la DB ( cryptés)

=>Essayer d'utiliser ON DELETE CASCADE pour la suppression d'un élément et toute ses éléments associés

=>Vous pouvez utiliser la POO

=>Vous pouvez utiliser le pattern MVC

=> Vous pouvez utiliser les jointures

