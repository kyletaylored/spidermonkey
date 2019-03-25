#!/usr/bin/php
<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/spidermonkey.php';


//if (php_sapi_name() == 'cli' && empty($argv[1])) {
//  dd("Pass a file name as an argument. \n\n ./index.php filename.csv");
//}

// Default offset
$offset = (!empty($argv[1]) && is_numeric($argv[1])) ? $argv[1] : 0;

// Create spidermonkey
$spider = new Spidermonkey();

// Fetch pages
// $page_type = (!empty($argv[2]) && is_string($argv[2])) ? $argv[2] : 'page';

$pages = json_decode($spider->getPages($offset));
$csvArr = [];

// Process each page
$count = 0;
foreach ($pages->objects as $page) {
    // Cast to array for simplicity.
    $page = (array) $page;
    $page_keys = $spider->cleanKeys($page);
    $request = $spider->fetchPage($page_keys['url']);
    if (isset($request->status_code) && $request->status_code !== 200) {
        // Skip processing
        continue;
    }
    $page_keys['body'] = $spider->getBody($request->body);
    $csvArr[] = $page_keys;
    print("$count. Processing: " . $page_keys['title'] . PHP_EOL);
    $count++;
    // Limit loop for debugging
//    if ($count > 0) {
//        break;
//    }
}

$spider->flattener->setArrayData($csvArr);
$spider->flattener->writeCsv("sitepages_offset_" . $offset);
print ('Processing complete.' . PHP_EOL);