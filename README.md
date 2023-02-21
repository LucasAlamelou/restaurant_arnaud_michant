# Restaurant Arnaud Michant

Pour l'ECF était 2023, le projet consiste à créer un application web pour un restaurant.

Sur ce site vous pourrez réserver une table, vous connecter, vous inscrire et parcourir les plats et menus proposés.

Du coté administrateur vous aurez accès au back-office vous pourrez alors modifier le nombre de couverts du restaurant ajouter et supprimer des images, renseigner les plats, les formules, modifier les horaires d'ouverture et les réservations.

Ce projet m'a permis de passer en revue tous les compétences de ma formation.

## Tech Stack

**Client:** HTML 5, Twig, CSS 3, Bootstrap 5, Java Script

**Server:** PHP 8, Symfony 6

## Déploiement

Héberger sur heroku [https://arnaud-michant-restaurant.herokuapp.com](https://arnaud-michant-restaurant.herokuapp.com)

## Environment Variables

Pour démarrer le projet vous devrez définir des variables d'environnement. Dans un fichier à la racine .env.local

`APP_ENV` = `dev`

`APP_SECRET` = `Ce que vous voulez ici`

Définir votre base de données en local ici un exemple en mysl
`DATABASE_URL` = `mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=8&charset=utf8mb4`

## Installation en local

Pour utiliser le projet en local vous devez avoir composer et symfony cli d'installer.
Voir la documentation pour composer [ici](https://getcomposer.org/download/).
Voir la documentation pour symfony CLI [ici](https://symfony.com/download).

```bash
  git clone https://github.com/LucasAlamelou/restaurant_arnaud_michant.git
```

```bash
  composer install
```

```bash
  php bin/console doctrine:database:create
```

```bash
  php bin/console doctrine:migrations:migrate
```

```bash
  php bin/console doctrine:fixtures:load
```

```bash
  symfony server:start
```

## Les utilisateurs du site

Après avoir réalisé les fixtures vous trouverez les identifiants et mot de passe ci-dessous.

Rôle Adminstrateur : ( vous aurez accès au back-office, créer automatiquement avec les fixtures )

```bash
  email: admin@admin.com
  mot de passe: admin1234
```

Rôle utilisateur :

```bash
  email: user@user.com
  mot de passe: admin1234
```

## Auteur

-   [@LucasAlamelou](https://www.github.com/LucasAlamelou)
