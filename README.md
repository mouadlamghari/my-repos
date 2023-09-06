
Notre application clinique est une solution complète et conviviale conçue pour
répondre aux besoins spécifiques des cliniques médicales modernes. Il simplifie la
gestion des dossiers des patients en fournissant une plate-forme centralisée qui
permet aux cliniques de gérer efficacement leur flux de travail quotidien. Grâce à
notre application, les cliniques peuvent créer des rendez-vous, enregistrer en toute
sécurité les données des patients, planifier des consultations et suivre les
informations médicales de manière transparente. Simplifiez la facturation, la
prescription électronique et bien plus encore. De plus, notre interface conviviale rend
l'application accessible à tout le personnel de la clinique, des administrateurs aux
médecins en passant par le personnel de soutien. En fournissant une solution
intégrée complète



## Installer Les packages necessaire

```bash
composer install
```

```bash
npm install
```


## Creer Le fichier de configuration .env

```bash
cp .env.example .env
```


## Générer le clé secret de l'application

```bash
php artisan key generate
```



## Executer les migration et les seeders

```bash
php artisan migrate

php artisan db:seed --class=RolePermissions

php artisan db:seed --class=RolePermissions

php artisan db:seed --class=AdminSeeder

```

## Lancement de projet

Pour Demarrer le serveur

```bash
php artisan serve
```

Pour laravel breeze

```bash
npm run dev
```

## Le compte admin

```
Email : admin@admin.com
Password : 12345678
```

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
