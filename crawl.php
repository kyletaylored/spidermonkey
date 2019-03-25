#!/usr/bin/php
<?php

// Archiving all pages in Web Archive (just in case).

require_once __DIR__ . '/vendor/autoload.php';

$baseurl = "http://web.archive.org/save/https://www.lever.co";
$count = 0;

if (php_sapi_name() == 'cli' && empty($argv[1])) {
  dd("Pass a file name as an argument. \n\n ./index.php filename.csv");
}

$input = $argv[1];
$old = new ParseCsv\Csv($input);

print "Processing CSV..." . PHP_EOL;
foreach ($old->data as $row) {
  // Define a timeout of 2.5 seconds
  $options = array(
    'timeout' => 10
  );

  // Throw in try/catch
  try {
    $request = Requests::get($baseurl . $row['Page'], [], $options);
    print "Saved page: " . $row['Page'] . PHP_EOL;
  } catch (Exception $e) {
    var_dump($e);
  }
  $count++;
}
