<?php

use App\Kernel;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\ErrorHandler\Debug;
use Symfony\Component\HttpFoundation\Request;

require dirname(__DIR__).'/vendor/autoload.php';

(new Dotenv())->bootEnv(dirname(__DIR__).'/.env');

if ($_SERVER['APP_DEBUG']) {
    umask(0000);

    Debug::enable();
}

if ($trustedProxies = $_SERVER['TRUSTED_PROXIES'] ?? false) {
    Request::setTrustedProxies(explode(',', $trustedProxies), Request::HEADER_X_FORWARDED_ALL ^ Request::HEADER_X_FORWARDED_HOST);
}

if ($trustedHosts = $_SERVER['TRUSTED_HOSTS'] ?? false) {
    Request::setTrustedHosts([$trustedHosts]);
}

$kernel = new Kernel($_SERVER['APP_ENV'], (bool) $_SERVER['APP_DEBUG']);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);


//$link = mysqli_connect("mysql", "root", "password", null);

//if (!$link) {
  //  echo "Error: Unable to connect to MySQL." . PHP_EOL;
  //  echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
  //  echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
  //  exit;}

//echo "Success: A proper connection to MySQL was made!" . PHP_EOL. "<br/>";
//echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL. "<br/>";
//echo "MySQL Server version: ".$link->server_version;

//mysqli_close($link);