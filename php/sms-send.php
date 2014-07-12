<?
/*
 * LigFlat API
 * sms-send.php
 * Send a text message to one or more destinations
 */

if (!defined('__ROOT__')) {
	define('__ROOT__', dirname(__FILE__));
}

require_once(__ROOT__ . "/common/functions.php");


$numberTo = "03499783472";
$message = "Send Test SMS " . rand(1, 9999);
$tokenSmsSend = generateToken();

$responseSms = sendSms($tokenSmsSend["id"], $numberTo, $message);

$tokenSmsBalance = generateToken();
$responseBalance = inquireBalance($tokenSmsBalance["username"], $tokenSmsBalance["id"]);

echo "SMS Status  -----> " . $responseSms["status"] . "(" . $responseSms["message"] . ") \n";
echo "Balance Account -> " . $responseBalance["account"] . "\n";

foreach ($responseBalance["services"] as $key => $service) {
	echo "\tService: " . $key . "\n";

	foreach ($service as $key => $value) {
		echo "\t\t" . $key . " = " . $value . "\n"; 
	}

	echo "\n";
}

echo "\n";

?>