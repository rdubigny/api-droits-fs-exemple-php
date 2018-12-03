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

require_once("init.php");

/* Initialisation du client france connect */
$client_FranceConnect = new ClientFranceConnect(
    $france_connect_base_url,
    $france_connect_client_id,
    $france_connect_client_secret,
    $france_connect_url_login_callback,
    $france_connect_url_logout_callback);

/* Ajout du scope pour le consentement de l'utilisateur */
$scopes_consentement_utilisateur = array("droits_assurance_maladie");

/* Redirection vers la mire de login France Connect */
$client_FranceConnect->authenticationRedirect($scopes_consentement_utilisateur);