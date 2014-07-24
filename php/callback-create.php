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

$numberFrom = "03432265664";
$numberTo = "03432217779";
$token = generateToken();

$response = createCallback($token["id"], $numberFrom, $numberTo);

var_dump($response);

echo "\n";

?>