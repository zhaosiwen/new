<?php
define('MASSIVE_FILE', '/usr/local/nginx/html/new/log/2018-08-14.log');
require 'vendor/autoload.php';
try {
    $largeFile = new Application\Interator\LargeFile(MASSIVE_FILE);
    $iterator = $largeFile->getIterator('ByLine');
    
    $words = 0;
    foreach ($iterator as $line) {
        $words += str_word_count($line);
    }
    echo str_repeat('-',52) . PHP_EOL;
    printf('%-40s : %8d\n', 'Total Words', $words);
    printf('%-40s : %8d\n', 'Average Words Per Line', ($words / $iterator->getReturn()));
    echo str_repeat('-', 52) . PHP_EOL;
} catch (Throwable $e) {
    echo $e->getMessage();
}

