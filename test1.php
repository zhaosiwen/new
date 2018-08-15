<?php
use Application\Log\Logger;

require __DIR__ . '/Application/Autoload/Loader.php';
\Application\Autoload\Loader::init(__DIR__);

$params = [
    'host' => 'localhost',
    'user' => 'cook',
    'pwd' => 'book',
    'db'=> 'php7cookbook'
];

try {
    $dsn = sprintf('mysql:charset=utf8;host=%s;dbname=%s',$params['host'],$params['db']);
    $opts = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $pdo = new PDO($dsn, $params['user'], $params['pwd'],$opts);
    $sql = 'select * from customer ' . 'where balance > :min and balance < :max '. ' order by id desc' . ' limit 20';
    $stmt = $pdo->prepare($sql);
   $stmt->execute(array('min'=>400, 'max'=>1000));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        printf('%4d  | %20s  | %5s  |   %8.2f'.PHP_EOL, $row['id'], $row['name'], $row['level'], $row['balance']);
    }
} catch (PDOException $e) {
    $log = new \Application\Log\Logger();
    $log->error($e->getMessage());
} catch (Throwable $e) {
    $log = new \Application\Log\Logger();
    $log->error($e->getMessage());
}