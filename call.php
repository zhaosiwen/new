<?php
define('LOG_FIFLES', '/usr/local/nginx/html/new/log/*.log');
require __DIR__ . '/Application/Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__);

$freq = function ($line)
{
    $ip = $this->getIp($line);
    if ($ip) {
        echo '.';
$this->frequency[$ip] = isset($this->frequency[$ip]) ? $this->frequency[$ip] + 1 : 1;
    }
};

$files = glob(LOG_FIFLES);
foreach ($files as $filename) {
    $access = new \Application\Web\Access($filename);
    foreach ($access->fileIteratorByLine() as $line) {
        $freq->call($access, $line);
    }
}

arsort($access->frequency);
var_dump($access->frequency);
foreach ($access->frequency as $key => $value) {
    printf('%16s : %6d' . PHP_EOL, $key, $value);
}