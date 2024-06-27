# Symfony Movie API

Ce projet est une API backend développée avec Symfony. L'API permet de gérer des entités `Movie` et `Director` avec des fonctionnalités CRUD. Le frontend se trouve dans le dépôt [react-movieapp](https://github.com/Arro38/react-movieapp) et est déployé sur [ce site](https://react-movieapp.formaterz.fr/). 

## Fonctionnalités

- CRUD (Créer, Lire, Mettre à jour, Supprimer) pour les entités `Movie` et `Director`.
- Relations entre les entités `Movie` et `Director`.

## Technologies Utilisées

- **Symfony** : Framework PHP .
- **Doctrine ORM** : Utilisé pour gérer la base de données et les entités.

## Installation et Lancement

### Prérequis

- PHP 8.3
- Composer
- Serveur web comme Apache ou Nginx
- Base de données MySQL

### Étapes

1. Clonez le dépôt du backend.
   ```bash
   git clone https://github.com/Arro38/symfony_movie_app.git
   ```
2. Installez les dépendances.
   ```bash
   cd symfony_movie_app
   composer install
   ```
3. Configurez les paramètres de la base de données dans le fichier `.env`.
```bash
APP_ENV=dev
APP_SECRET=2341a402438a7446123555e581ffed5e1
DATABASE_URL="mysql://username:password@localhost:3306/database?serverVersion=8.0.32&charset=utf8mb4"
CORS_ALLOW_ORIGIN='^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$'
```

4. Créez la base de données , appliquez les migrations et charger les fixtures.
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   php bin/console d:f:l 
   ```
5. Lancez le serveur de développement.
   ```bash
   symfony server:start
   ```

L'API est maintenant accessible sur `http://localhost:8000`.



## Frontend

Le frontend pour cette API est développé avec React.js et est disponible [ici](https://github.com/Arro38/react-movieapp). Vous pouvez voir l'application en ligne [ici](https://react-movieapp.formaterz.fr/).


## License

Ce projet est sous licence MIT. Voir le fichier LICENSE pour plus de détails.