<?php
#    This file is part of the PHP example for FranceConnect and API des Droits Cnam
#
#    Copyright (C) 2015-2019 Eric Pommateau, Maxime Reyrolle, Arnaud Bétrémieux, Nicolas Krzyzanowski
#
#    This example is free software: you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation, either version 3 of the License, or
#    (at your option) any later version.
#
#    This example is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    You should have received a copy of the GNU General Public License
#    along with this example.  If not, see <http://www.gnu.org/licenses/>.

/* URL de base de l'API France Connect : https://partenaires.franceconnect.gouv.fr/fournisseur-donnees*/
//$france_connect_base_url = "https://fcp.integ01.dev-franceconnect.fr/api/v1/";
$france_connect_base_url = getenv('FRANCECONNECT_BASE_URL');

/* Client ID */
$france_connect_client_id = getenv('FRANCECONNECT_CLIENT_ID');

/* Secret ID */
$france_connect_client_secret = getenv('FRANCECONNECT_CLIENT_SECRET');

/* URL vers laquel est redirigé l'utilisateur après le login France Connect */
$france_connect_url_callback = getenv('FRANCECONNECT_URL_CALLBACK');

/* Paramètres du fournisseur de données */
$api_cnam_base_url = getenv('API_CNAM_BASE_URL');
$api_cnam_api_key = getenv('API_CNAM_API_KEY');
