<?
/*
 * LigFlat API
 * functions.php
 * Send a text message to one or more destinations
 */

if (!defined('__ROOT__')) {
	define('__ROOT__', dirname(dirname(__FILE__)));
}

require_once(__ROOT__ . "/lib/rest-client/rest-curl-client.php");

/* 
 * Generate a Token to Consume 
 * if do you want change your credentials, please take a look at
 * $LIGFLAT_API_EXAMPLE_HOME/php/config/credentials.ini
 */
function generateToken() {
	$credentials = getCredentials();

	$http = new RestCurlClient();

	$params = array(
			"username" => $credentials["account"],
			"password" => $credentials["password"],
			"domain" => $credentials["domain"]
		);

	$response = $http->post("https://api.ligflat.com.br/talkalot/interfaces/rest/token/create", $params, getCurlOptions());
	$response = json_decode($response, true);

	return $response;
}

/*
 * Send a SMS
 */
function sendSms($tokenId, $to, $message) {
	$http = new RestCurlClient();

	$params = array(
			"tokenId" => $tokenId,
			"to" => $to,
			"message" => $message
		);

	$response = $http->post("https://api.ligflat.com.br/talkalot/interfaces/rest/sms/send", $params, getCurlOptions());
	$response = json_decode($response, true);

	return $response;	
}

function inquireBalance($account, $tokenId) {
	$http = new RestCurlClient();

	$params = array(
			"tokenId" => $tokenId,
		);

	$response = $http->post("https://api.ligflat.com.br/talkalot/interfaces/rest/balance/inquire/" . $account, $params, getCurlOptions());
	$response = json_decode($response, true);

	return $response;	
}

/*
 * Get Credentials from ini File 
 */
function getCredentials() {
	return parse_ini_file(__ROOT__ . "/config/credentials.ini");
}

/* 
 * Define default curl options 
 */
function getCurlOptions() {
	return array(
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSLVERSION => 3
		);
}

?>