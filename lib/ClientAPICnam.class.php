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

class ClientAPICnam {

	private $api_key;
	private $base_url;
	private $access_token;

	public function __construct($api_key, $base_url, $access_token){
		$this->api_key = $api_key;
		$this->base_url = $base_url;
        $this->access_token = $access_token;
	}

    private function getHeaders(){
        $curlWrapper = new CurlWrapper();
        $curlWrapper->addHeader("X-Api-Key", $this->api_key);
        $curlWrapper->addHeader("Authorization", "Bearer $this->access_token");
        return $curlWrapper;
    }

    private function getRessourceURL($ressource){
	    $url = $this->base_url . $ressource;
        return $url;
    }

    public function getMe(){
        $curlWrapper = $this->getHeaders();

        $result = $curlWrapper->get($this->getRessourceURL("me"));

        return json_decode($result, true);
    }

    public function getBeneficiaires(){
        $curlWrapper = $this->getHeaders();
        $result = $curlWrapper->get($this->getRessourceURL("me/beneficiaires"));

        return json_decode($result, true);
    }

    public function getBeneficiairesNir($nir){
        $curlWrapper = $this->getHeaders();

        $curlWrapper->addHeader("nir", $nir);

        $result = $curlWrapper->get($this->getRessourceURL(""));

        return json_decode($result, true);
    }

    public function getBeneficiairesNirCaisse($nir){
        $curlWrapper = $this->getHeaders();
        $curlWrapper->addHeader("nir", $nir);

        $result = $curlWrapper->get($this->getRessourceURL("caisse"));

        return json_decode($result, true);
    }

    public function getBeneficiairesNirContrats($nir){

        $curlWrapper = $this->getHeaders();

        $curlWrapper->addHeader("nir", $nir);

        $result = $curlWrapper->get($this->getRessourceURL("contrats"));

        return json_decode($result, true);
    }

    public function getBeneficiairesNirExonerations($nir){

        $curlWrapper = $this->getHeaders();

        $curlWrapper->addHeader("nir", $nir);

        $result = $curlWrapper->get($this->getRessourceURL("exonerations"));

        return json_decode($result, true);
    }

    public function getBeneficiairesNirMedecinTraitant($nir){

        $curlWrapper = $this->getHeaders();

        $curlWrapper->addHeader("nir", $nir);

        $result = $curlWrapper->get($this->getRessourceURL("medecin-traitant"));

        return json_decode($result, true);
    }
}
