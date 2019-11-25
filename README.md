# api-droits-fs-exemple-php

Application exemple d'appel à l'API des droits en tant que fournisseur de service France Connect.

Cette application est une adaptation du code source de l'application d'exemple fournisseur de données php publiée par France Connect (https://github.com/france-connect/fs_exemple_php).

Elle permet d'enchainer la cinématique d'authentification France Connect avec l'appel de l'API des droits.

Cet exemple est distribué dans l’espoir que ce sera utile, mais SANS AUCUNE GARANTIE; sans même la garantie implicite de QUALITÉ MARCHANDE ou ADAPTATION À UN USAGE PARTICULIER. Voir la Licence publique générale GNU pour plus de détails.

Attention à l'utilisation de mt_rand dans FranceConnect.class.php, qu'il faudrait remplacer par un appel à la fonction random_bytes pour plus de sécurité.

License : GPLv3

## Démo

Vous pouvez tester cette application en cliquant sur le lien suivant :

* http://fc-fc.1d35.starter-us-east-1.openshiftapps.com

## Installation

1. Obtenir un `client_id` et `secret_id` auprès de France Connect (https://partenaires.franceconnect.gouv.fr/monprojet/fournisseurs-services/nouveau)

2. Renseigner vos `client_id`, `client_secret` dans `settings/LocalSettings.php`

3. Renseigner `url_login_callback` dans `settings/LocalSettings.php`

   `url_login_callback` correspond à l'URL sur lequel vous déployez l'exemple, suivi de `callback.php`

   Par exemple, si vous déployez dans https://127.0.0.1/api-droits-fs-exemple-php, l'url de callback doit être https://127.0.0.1/api-droits-fs-exemple-php/callback.php

4. Renseigner `url_logout_callback` dans `settings/LocalSettings.php`

   `url_logout_callback` correspond à l'URL sur lequel vous déployez l'exemple, suivi de `logout-ok.php`

   Par exemple, si vous déployez dans https://127.0.0.1/api-droits-fs-exemple-php, l'url de callback doit être https://127.0.0.1/api-droits-fs-exemple-php/logout-ok.php

5. Ajouter les URL de callback et de logout dans FranceConnect (https://partenaires.franceconnect.gouv.fr/login)

6. Ajouter le scope `droits_assurance_maladie` dans `authentication.php` pour la demande de consentement.

7. Obtenir une `api-key` et l'url de l'API de test auprès de la Cnam dans le cadre du conventionnement

8. Renseigner vos `api_cnam_api_key`, `api_cnam_base_url` dans `settings/LocalSettings.php`

## Configuration de l'application

Le fichier `settings/LocalSettings.php` utilise les variables d'environnement docker suivantes pour les appels vers France Connect et vers l'API des droits.
```
FRANCECONNECT_BASE_URL: https://fcp.integ01.dev-franceconnect.fr/api/v1/
FRANCECONNECT_CLIENT_ID: Fourni par France Connect
FRANCECONNECT_CLIENT_SECRET: Fourni par France Connect
FRANCECONNECT_URL_LOGIN_CALLBACK: Configuré via France Connect
FRANCECONNECT_URL_LOGOUT_CALLBACK: Configuré via France Connect
API_CNAM_BASE_URL: Communiqué par la Cnam
API_CNAM_API_KEY: Communiqué par la Cnam
```
Vous pouvez valoriser directement les variables php sans utiliser Docker si vous le souhaitez.

## Lancer le serveur avec Docker

Vous pouvez lancer le serveur en une ligne de commande avec [Docker](https://docs.docker.com/install/) :

```
docker run --rm --name app -d -p 8080:80 \
  -v "$PWD":/var/www/app/ \
  -e FRANCECONNECT_BASE_URL='https://fcp.integ01.dev-franceconnect.fr/api/v1/' \
  -e FRANCECONNECT_CLIENT_ID='211286433e39cce01db448d80181bdfd005554b19cd51b3fe7943f6b3b86ab6e' \
  -e FRANCECONNECT_CLIENT_SECRET='2791a731e6a59f56b6b4dd0d08c9b1f593b5f3658b9fd731cb24248e2669af4b' \
  -e FRANCECONNECT_URL_LOGIN_CALLBACK='http://localhost:8080/callback.php' \
  romeoz/docker-apache-php
```

Votre application est disponible via : http://localhost:8080 .

Pour stopper le serveur :

```
docker stop app
```

## Tester l'application avec vos données de test

1. Ajouter un utilisateur de test France Connect (https://fip1.integ01.dev-franceconnect.fr/user/create)

2. Accéder à l'application de test et cliquer sur le bouton France Connect pour accéder à la page protégée

3. Visualiser les données de test de l'API des Droits dans la page protégée
