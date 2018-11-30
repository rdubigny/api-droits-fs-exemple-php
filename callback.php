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
    $france_connect_url_callback);

# Récupération de l'access token et de l'identité pivot
$callback = array();
$callback = $client_FranceConnect->callback();
$_SESSION['userinfo'] = $callback['userinfo'];
$_SESSION['access_token'] = $callback['access_token'];
$_SESSION['full_access_token'] = $callback['full_access_token'];
$access_token = $_SESSION['access_token'];

/* Initialisation du fournisseur de données */
$api_cnam = new ClientAPICnam($api_cnam_api_key, $api_cnam_base_url, $access_token);

# Vérification de l'access token depuis le fournisseur de données
# Cette vérification est effectuée côté API pour la réconciliation
# Nous faisons l'appel ici pour illustration
$_SESSION['checktoken_info'] = $client_FranceConnect->checktoken($access_token);

# Appels de l'API
$result = $api_cnam->getMe();
$_SESSION['api_cnam']['me'] = $result;

## Récupération du NIR de l'assuré pour les appels suivants
$nir = $result['nir'];

$result = $api_cnam->getBeneficiaires();
$_SESSION['api_cnam']['meBeneficiaires'] = $result;

$result = $api_cnam->getBeneficiairesNir($nir);
$_SESSION['api_cnam']['beneficiairesNir'] = $result;

$result = $api_cnam->getBeneficiairesNirCaisse($nir);
$_SESSION['api_cnam']['beneficiairesNirCaisse'] = $result;

$result = $api_cnam->getBeneficiairesNirContrats($nir);
$_SESSION['api_cnam']['beneficiairesNirContrats'] = $result;

$result = $api_cnam->getBeneficiairesNirExonerations($nir);
$_SESSION['api_cnam']['beneficiairesNirExonerations'] = $result;

$result = $api_cnam->getBeneficiairesNirMedecinTraitant($nir);
$_SESSION['api_cnam']['beneficiairesNirMedecinTraitant'] = $result;

header("Location: protected.php");