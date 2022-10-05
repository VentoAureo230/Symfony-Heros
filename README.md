# Hero Manager - Site de création d'héros

🚀 Créez des héros, des classes et des compétences pour constituer une équipe légendaire !. 🚀

# Statut : En cours de dévellopement (09/22)

## Features

 - Création/Modification/Suppression de héros :feelsgood:
 - Création/Modification/Suppression de classe :trident:
 - Création/Modification/Suppression de compétence de classe :shield:
 - Création de compte utilisateur :partying_face:

## Getting Started

Ce dépôt permet de générer des héros / classes / compétences qui ont des attributs.

Ces instructions vous permettrons de faire tourner le projet sur votre machine en local.

## :warning: Requirements :warning:

 - PhP 8.1+
 - [Wamp](https://www.wampserver.com/) avec une base de donnée MySQL 4.9+

## Before We Get Started

Composer est obligatoire pour pouvoir gérer les dépendances dans Symfony en PhP. Il s'occupe des installations et mises à jour. [Composer Install](https://getcomposer.org/).

Pour obtenir une copie de ce projet, ouvrez votre terminal et entrer :

```
git clone https://github.com/VentoAureo230/Symfony-Heros
```
Et maintenant vous pouvez utiliser le projet en local.

## Execution :runner:

Pour exécuter le projet ouvrez votre terminal dans le dossier du projet.

1. Changez les coordonnés du .env.test pour faire correspondre à vos identifiants MySQL, puis enlevez le .test de l'extension. Wamp doit être allumé.

2. Créez la base de donnée :

```
php bin/console doctrine:database:create
```

3. Exécuter les migrations précédentes (optionnel) :

```
php bin/console doctrine:migrations:migrate
```
4. Démarrer le serveur Symfony :

```
symfony server:start
```
Utilisez `symfony server:stop` pour arrêter le serveur

5. Le site est accessible sur l'url 127.0.0.1/

6. Enjoy !

## Authors

Moi ~~sans l'aide de son prof en plus, vraiment trop fort ce mec...~~

## To Do List

- Afficher les capacités des héros en fonctions de leur classe :warning:
- Créer des équipes pour les utilisateurs
- Débuger les boutons de modifications de mot de passe et info de l'utilisateur
- Améliorer la personnalisation des héros (armes, armures, etc...)
- Permettre l'ajout d'image pour un héros (ou permettre le choix parmis une liste d'avatar disponible)
- Améliorer le design du site

### Notes

This code is for educational use only.



