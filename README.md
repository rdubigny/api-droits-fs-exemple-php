# api-droits-fs-exemple-php
Application exemple d'appel à l'API des droits en tant que fournisseur de service France Connect.

Cette application est une adaptation du code source de l'application d'exemple fournisseur de données php publiée par France Connect (https://github.com/france-connect/fs_exemple_php).

Elle permet d'enchainer la cinématique d'authentification France Connect avec l'appel de l'API des droits.

Cet exemple est distribué dans l’espoir que ce sera utile, mais SANS AUCUNE GARANTIE; sans même la garantie implicite de QUALITÉ MARCHANDE ou ADAPTATION À UN USAGE PARTICULIER. Voir la Licence publique générale GNU pour plus de détails.

Attention à l'utilisation de mt_rand dans FranceConnect.class.php, qu'il faudrait remplacer par un appel à la fonction random_bytes pour plus de sécurité.

License : GPLv3

## Installation pour tester l'API des droits de l'Assurance Maladie

1. Obtenir un `client_id` et `secret_id` auprès de France Connect (https://partenaires.franceconnect.gouv.fr/monprojet/fournisseurs-services/nouveau)

2. Renseigner vos `client_id`, `client_secret` et `url_callback` dans `LocalSettings.php`

   `url_callback` correspond à l'URL sur lequel vous déployez l'exemple, suivi de `callback.php`

   Par exemple, si vous déployez dans https://127.0.0.1/api-droits-fs-exemple-php, l'url de callback doit être https://127.0.0.1/api-droits-fs-exemple-php/callback.php

3. Ajouter cette URL de callback dans FranceConnect (https://partenaires.franceconnect.gouv.fr/login)

4. Ajouter le scope `droits_assurance_maladie` dans `authentication.php` pour la demande de consentement.

5. Obtenir une `api-key` et l'url de l'API de test auprès de la Cnam dans le cadre du conventionnement

6. Renseigner vos `api_cnam_api_key`, `api_cnam_base_url` dans `LocalSettings.php`

## Configuration de l'application

Le fichier `LocalSettings.php` utilise les variables d'environnement docker suivantes pour les appels vers France Connect et vers l'API des droits.
```
FRANCECONNECT_BASE_URL: https://fcp.integ01.dev-franceconnect.fr/api/v1/
FRANCECONNECT_CLIENT_ID: Fourni par France Connect
FRANCECONNECT_CLIENT_SECRET: Fourni par France Connect
FRANCECONNECT_URL_CALLBACK: Configuré via France Connect
API_CNAM_BASE_URL: Communiqué par la Cnam
API_CNAM_API_KEY: Communiqué par la Cnam
```
