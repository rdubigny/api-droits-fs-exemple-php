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

class ClientFranceConnect {
	
	const OPENID_SESSION_TOKEN = "open_id_session_token";
	const OPENID_SESSION_NONCE = "open_id_session_nonce";
	
	private $base_url;
	private $client_id;
	private $client_secret;
	private $url_login_callback;
    private $url_logout_callback;
	
	public function __construct($base_url, $client_id, $client_secret, $url_login_callback, $url_logout_callback){
		$this->base_url = $base_url;
		$this->client_id = $client_id;
		$this->client_secret = $client_secret;
		$this->url_login_callback = $url_login_callback;
        $this->url_logout_callback = $url_logout_callback;
	}
	
	public function authenticationRedirect($sup_scope = array()){
		$_SESSION[self::OPENID_SESSION_TOKEN] = $this->getRandomToken();
		$state = "token={$_SESSION[self::OPENID_SESSION_TOKEN]}";
		
		$_SESSION[self::OPENID_SESSION_NONCE] = $this->getRandomToken();
		
		$scope = "openid%20profile%20".implode("%20",$sup_scope);
		
		$info=array("response_type"=>'code',
					"client_id"=> $this->client_id,
					"scope"=>$scope,
					"redirect_uri"=>$this->url_login_callback,
					"state"=>urlencode($state),
					"nonce"=>$_SESSION[self::OPENID_SESSION_NONCE]
		);
		
		$url = $this->getURLforService("authorize");
		foreach($info as $key=>$value){
			$url.=$key."=".$value."&";
		}

		header("Location: $url");
	}
	
	public function callback(){
		$error = $this->recupGET('error');
		if ($error){
			//TODO France Connect rappelle ce callback si jamais il y a une erreur lor de l'appel à la vérif de token...
			throw new Exception("Erreur : $error");
		}
		
		$state = $this->recupGET('state');
		$this->verifToken($state);
		
		$code =$this->recupGET('code');
        $result_array = $this->getAccessToken($code);
		$access_token = $result_array['access_token'];
				
		$user_info['userinfo'] = $this->getInfoFromFI($access_token);
		$user_info['access_token'] = $access_token;
        $user_info['full_access_token'] = $result_array;
		return $user_info;
	}
	
	private function verifToken($state){
		
		$state = urldecode($state);
		
		$state_array = array();
		parse_str($state, $state_array);
		
		$token = $state_array['token'];
		
		if ($token != $_SESSION[self::OPENID_SESSION_TOKEN]){
			throw new Exception("Le token ne correspond pas");
		}
		return true;
	}
	
	public function checktoken($access_token){
		$curlWrapper = new CurlWrapper();
		//$curlWrapper->setServerCertificate(__DIR__."/../certificates.pem");
		
		$post_data = array(
				"token" => $access_token,
		);
		
		$curlWrapper->setPostDataUrlEncode($post_data);
		$checktoken_url = $this->getURLforService("checktoken");
		
		//error_log(print_r($curlWrapper, TRUE), 3, __DIR__."/../debug.log");
		
		$result = $curlWrapper->get($checktoken_url);
		/*if ($curlWrapper->getHTTPCode() != 200){
			if (! $result){
				throw new Exception($curlWrapper->getLastError());
			} 
			$checktoken_result_array = json_decode($result,true);
			throw new Exception($checktoken_result_array['error']);
		}*/
		
		$checktoken_result_array = json_decode($result,true);

		return $checktoken_result_array;	
	}
	
	private function getAccessToken($code){
		$curlWrapper = new CurlWrapper();
		//$curlWrapper->setServerCertificate(__DIR__."/../certificates.pem");
		
		$post_data = array(
				"grant_type" =>"authorization_code",
				"code" => $code,
				"redirect_uri" => $this->url_login_callback,
				"client_id"=>$this->client_id,
				"client_secret"=>$this->client_secret
		);
		
		$curlWrapper->setPostDataUrlEncode($post_data);
		$token_url = $this->getURLforService("token");
		
		//error_log(print_r($curlWrapper, TRUE), 3, __DIR__."/../debug.log");
		
		$result = $curlWrapper->get($token_url);
		if ($curlWrapper->getHTTPCode() != 200){
			if (! $result){
				throw new Exception($curlWrapper->getLastError());
			} 
			$result_array = json_decode($result,true);
			throw new Exception($result_array['error']);
		}
		
		$result_array = json_decode($result,true);
		
		$id_token = $result_array['id_token'];
		
		$all_part = explode(".",$id_token);
		$header = json_decode(base64_decode($all_part[0]),true);
		$payload = json_decode(base64_decode($all_part[1]),true);
		
		if ($payload['nonce'] != $_SESSION[self::OPENID_SESSION_NONCE]){
			throw new Exception("La nonce ne correspond pas");
		}
		
		require_once(__DIR__."/../ext/Akita_JOSE/JWS.php");
		$jws = Akita_JOSE_JWS::load($id_token, true);
		$verify = $jws->verify($this->client_secret);
		if (! $verify){
			throw new Exception("Vérification du token : Echec");
		}
		
		unset($_SESSION[self::OPENID_SESSION_NONCE]);
		return $result_array;
	}
	
	public function getInfoFromFI($access_token){
		$curlWrapper = new CurlWrapper();
		$curlWrapper->setServerCertificate(__DIR__."/../certificates.pem");
		$curlWrapper->addHeader("Authorization", "Bearer $access_token");
		$user_info_url = $this->getURLforService("userinfo");
		$result = $curlWrapper->get($user_info_url);
		if ($curlWrapper->getHTTPCode() != 200){
			if (! $result){
				$message_erreur = $this->curlWrapper->getLastError();
			} else {
				$result_array = json_decode($result,true);
				$message_erreur = $result_array['error'];
			}
			throw new Exception("Erreur lors de la récupération des infos sur le serveur OpenID : ".$message_erreur);
		}
		
		return json_decode($result,true);
	}
	
	public function logout($id_token){
        $logout_url = $this->getURLforService("logout");
        $logout_url .= "id_token_hint=" . $id_token . "&post_logout_redirect_uri=" . $this->url_logout_callback;
		header("Location: $logout_url");
	}
	
	private function getURLforService($service){
	    return trim($this->base_url,"/")."/$service?";
	}
	
	private function getRandomToken(){
		return sha1(mt_rand(0,mt_getrandmax()));
	}

	private function recupGET($variable_name,$default=false)
    {
        if (!isset($_GET[$variable_name])) {
            return $default;
        }
        return $_GET[$variable_name];
    }
}
