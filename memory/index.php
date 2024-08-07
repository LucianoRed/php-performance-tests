<?php

$largeArray = [];

for ($i = 0; $i < 10000000; $i++) {
    $largeArray[] = md5($i);
}

echo "Created an array with " . count($largeArray) . " elements.\n";
